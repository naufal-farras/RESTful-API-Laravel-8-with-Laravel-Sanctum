<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'unauthorized'
            ], 401);
        }
        $token = $user->createToken('token-name');

        return response()->json([
            'message' => 'success',
            'user' => $user,
            'token' => $token->plainTextToken,
        ], 200);
    }
}
