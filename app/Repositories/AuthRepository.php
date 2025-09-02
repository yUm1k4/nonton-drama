<?php

namespace App\Repositories;

use App\Interfaces\AuthRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthRepository implements AuthRepositoryInterface
{
    public function login(array $data)
    {
        if (!Auth::attempt($data)) {
            return false;
        }

        return true;
    }

    public function register(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role' => 'user',
            'profile_picture' => !empty($data['profile_picture'])
                ? $data['profile_picture']->store('profile_pictures', 'public')
                : null,
        ]);

        Auth::login($user);

        return $user;
    }

    public function logout()
    {
        Auth::logout();
    }
}
