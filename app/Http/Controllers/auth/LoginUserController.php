<?php

namespace App\Http\Controllers\auth;

use App\Actions\Auth\LoginAction;
use App\DTOs\UserDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;

class LoginUserController extends Controller
{
    public function __construct(protected LoginAction $loginAction)
    {
    }

    public function store(UserLoginRequest $request){

        $data = $this->loginAction->run(userDTO: UserDTO::fromRequest($request));

        return $this->ok($data);
    }
}
