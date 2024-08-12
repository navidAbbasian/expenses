<?php

namespace App\DTOs;

use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;

class UserDTO extends DataTransformerObject
{
    public function __construct(
        readonly ?string $name = null,
        readonly ?string $number = null,
        readonly ?string $email = null,
        readonly ?string $password = null,
    )
    {
        parent::__construct();

    }

    public static function fromRequest(UserLoginRequest|UserRegisterRequest|UpdateUserRequest $request): static
    {
        return new static(
            name: $request->name,
            number: $request->number,
            email: $request->email,
            password: $request->password
        );
    }
}
