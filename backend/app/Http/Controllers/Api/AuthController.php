<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

// use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
  public function login(Request $request)
  {
    // TODO: Validar campos del request
    $credentials = $request->only('email', 'password');

    if (!$token = JWTAuth::attempt($credentials)) {
      // TODO: Devolver mensaje de error adecuado
      return response()->json(['error' => 'Unauthorized'], 401);
    }

    return response()->json([
      'access_token' => $token,
      'user' => Auth::user()
    ]);
  }

  public function logout()
  {
    JWTAuth::invalidate(JWTAuth::getToken());
    return response()->json(['message' => 'Successfully logged out']);
  }

  public function register(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'name' => 'required|string|max:125',
      'email' => 'required|string|email|max:125|unique:users',
      'password' => 'required|string|min:8|confirmed'
    ]);


    if ($validator->fails()) {
      $failedRules = $validator->failed();
      if (isset($failedRules['email']['Unique'])) {
          return response()->json([
              'code' => 'email_already_taken'
          ], 422);
      }
      return response()->json(['errors' => $validator->errors()], 422);
    }

    $user = User::create([
      'name' => $request->name,
      'email' => $request->email,
      'password' => Hash::make($request->password),
    ]);


    $token = JWTAuth::fromUser($user);
    //$token = auth()->login($user);

    return response()->json([
      'message' => 'Usuario registrado con éxito',
      'access_token' => $token,
      'user' => $user
    ], 201);
  }

}
