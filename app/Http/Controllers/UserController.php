<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::query()->with('banks');
        $pagination = $this->pagination($users, $request);

        return $this->ok($pagination);
    }

    public function show()
    {
        $user = auth()->user();
        $user['balance'] = $user->userBalance();
        return $this->ok($user);
    }
}
