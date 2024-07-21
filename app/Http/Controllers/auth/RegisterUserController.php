<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class RegisterUserController extends Controller
{
    public function store(UserRegisterRequest $request): JsonResponse
    {


        $user = User::create([
            'name' => $request->name,
            'number' => $request->number,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);


        $data['token'] = $user->createToken('auth_token')->plainTextToken;
//        $data['user'] = $user;

        return $this->ok($data);
    }
}
