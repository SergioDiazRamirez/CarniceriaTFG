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
}
