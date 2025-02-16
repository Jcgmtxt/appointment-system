<?php

namespace App\Services;

use App\Models\User;
use App\Services\Contracts\UserServiceInterface;

class UserService implements UserServiceInterface
{
    public function getAllUsers()
    {
        return User::all();
    }

    public function getUserById(string $id)
    {
        return User::findOrFail($id);
    }
}



