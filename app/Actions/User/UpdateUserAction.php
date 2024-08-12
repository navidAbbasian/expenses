<?php

namespace App\Actions\User;

use App\DTOs\UserDTO;
use App\Models\User;

class UpdateUserAction
{
    public function run(UserDTO $userDTO, User $user): User
    {
        $user->name = $userDTO->name ?? $user->name;
        $user->email = $userDTO->email ?? $user->email;
        $user->number = $userDTO->number ?? $user->number;

        $user->save();
        $user->refresh();

        return $user;
    }
}


