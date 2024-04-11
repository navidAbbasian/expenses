<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show()
    {
        $user = auth()->user();
        $user['balance'] = $user->userBalance();
        return $this->ok($user);
    }
}
