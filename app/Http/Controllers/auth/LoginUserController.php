<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginUserController extends Controller
{
    public function store(UserLoginRequest $request){

        // Check email exist
        $user = User::where('email', $request->email)->first();

        // Check password
        if(!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Invalid credentials'
            ], 401);
        }

        $data['token'] = $user->createToken('auth_token')->plainTextToken;
        $data['user'] = $user;

        $response = [
            'status' => 'success',
            'message' => 'User is logged in successfully.',
            'data' => $data,
        ];

        return response()->json($response, 200);
    }
}
