<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Address;

class UserController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $user->load('addresses');
        return response()->json($user);
    }

    public function update(Request $request)
    {
        $user = $request->user(); 

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|max:255',
            'addresses' => 'sometimes|array',
            'addresses.*.id' => 'nullable|integer|exists:addresses,id',
            'addresses.*.full_address' => 'required|string|max:255',
            'default_address_id' => 'sometimes|integer|exists:addresses,id'
        ]);

        // Actualizar datos principales del usuario
        if (isset($validated['name'])) 
            $user->name = $validated['name'];
        if (isset($validated['email'])) 
            $user->email = $validated['email'];
        if (isset($validated['default_address_id'])) 
            $user->default_address_id = $validated['default_address_id'];
        
        $user->save();

        // Eliminar direcciones que ya no venían en la solicitud
        $existingIds = $user->addresses()->pluck('id')->toArray();
        $submittedIds = collect($validated['addresses'])->pluck('id')->filter()->toArray();
        $toDelete = array_diff($existingIds, $submittedIds);
        Address::destroy($toDelete);
        // Actualizar o crear direcciones
        if (isset($validated['addresses'])) {
            foreach ($validated['addresses'] as $addrData) {
                if (!empty($addrData['id'])) {
                    // actualizar dirección existente
                    $address = Address::find($addrData['id']);
                    $address->full_address = $addrData['full_address'];
                    $address->save();
                } else {
                    // crear nueva dirección
                    $user->addresses()->create([
                        'full_address' => $addrData['full_address']
                    ]);
                }
            }
        }

        return response()->json([
            'message' => 'Usuario actualizado correctamente',
            'user' => $user->load('addresses')
        ]);
    }

    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ], [
            'current_password.required' => 'CURRENT_PASSWORD_REQUIRED',
            'new_password.required' => 'NEW_PASSWORD_REQUIRED',
            'new_password.min' => 'PASSWORD_MIN',
            'new_password.confirmed' => 'PASSWORD_CONFIRMATION',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first() // solo primer error
            ], 422);
        }

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'message' => 'CURRENT_PASSWORD_INVALID'
            ], 400);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return response()->json([
            'message' => 'PASSWORD_CHANGED'
        ]);
    }

    public function deleteAccount()
    { // TODO: pedir confirmación de contraseña y anonimizar datos 
        $user = Auth::user();
        $user->delete();

        return response()->json(['message' => 'Cuenta eliminada']);
    }
}