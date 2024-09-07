<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function getUserByEmail(string $email)
    {
        return User::where('email', $email)->first();
    }

    public function createUser(array $data)
    {
        return User::create($data);
    }
}
