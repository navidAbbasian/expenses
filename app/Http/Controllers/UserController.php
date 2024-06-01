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

    public function update(User $user, Request $request)
    {
        $request->validate([
           'name' => 'nullable|string',
           'email' => 'nullable|string|email|unique:users,email,' . $user->id,
           'number' => 'nullable|string|unique:users,number,' . $user->id,
           'password' => 'nullable|string',
        ]);

        $user->name = $request->has('name') ? $request->name : $user->name;
        $user->email = $request->has('email') ? $request->email : $user->email;
        $user->number = $request->has('number') ? $request->number : $user->number;
        $user->password = $request->has('password') ? $request->password : $user->password;

        $user->save();

        return $this->ok($user);
    }
}
