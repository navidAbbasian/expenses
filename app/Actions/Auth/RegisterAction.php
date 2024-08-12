<?php

namespace App\Actions\Auth;

use App\DTOs\UserDTO;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterAction
{
    public function run(UserDTO $userDTO): array
    {
        $user = User::create([
            'name' => $userDTO->name,
            'number' => $userDTO->number,
            'email' => $userDTO->email,
            'password' => Hash::make($userDTO->password),
        ]);


        $data['token'] = $user->createToken('auth_token')->plainTextToken;
        $data['user'] = $user;

        return $data;
    }
}
