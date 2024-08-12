<?php

namespace App\Actions\Auth;

use App\DTOs\UserDTO;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class LoginAction
{
    public function run(UserDTO $userDTO): JsonResponse|array
    {
        // Check email exist
        $user = User::where('email', $userDTO->email)->first();

        // Check password
        if(!$user || !Hash::check($userDTO->password, $user->password)) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Invalid credentials'
            ], 401);
        }

        $data['token'] = $user->createToken('auth_token')->plainTextToken;
        $data['user'] = $user;

        return $data;
    }
}
