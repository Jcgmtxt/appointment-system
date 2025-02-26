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

    public function createUser(array $data)
    {
        return User::create($data);
    }

    public function updateUser(string $id, array $data)
    {
        $user = $this->getUserById($id);
        $user->update($data);

        return $user;
    }

    public function deleteUser(string $id)
    {
        $user = $this->getUserById($id);
        $user->delete();

        return $user;
    }

    public function advancedSearch(array $data)
    {
        $query = User::query();

        if (!empty($data['name'])) {
            $query->where('name', 'like', '%' . $data['name'] . '%');
        }

        if (!empty($data['email'])) {
            $query->where('email', 'like', '%' . $data['email'] . '%');
        }

        if (!empty($data['id'])) {
            $query->where('id', $data['id']);
        }

        return $query->get();
    }

    public function convertUserToDoctor(string $id)
    {
        $user = $this->getUserById($id);
        $user->role = 'doctor';
        $user->save();

        return $user;
    }
}



