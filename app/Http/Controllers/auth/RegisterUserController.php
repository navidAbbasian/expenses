<?php

namespace App\Http\Controllers\auth;

use App\Actions\Auth\RegisterAction;
use App\DTOs\UserDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRegisterRequest;
use Illuminate\Http\JsonResponse;

class RegisterUserController extends Controller
{
    public function __construct(protected RegisterAction $registerAction)
    {
    }

    public function store(UserRegisterRequest $request): JsonResponse
    {
        $data = $this->registerAction->run(userDTO: UserDTO::fromRequest($request));

        return $this->ok($data);
    }
}
