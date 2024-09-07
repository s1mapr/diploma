<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;

class UserService
{
    protected UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getUserByEmail($email)
    {
        return $this->userRepository->getUserByEmail($email);
    }

    public function createUser(array $data)
    {
        return $this->userRepository->createUser($data);
    }

    public function logout(User $user): void
    {
        $user->currentAccessToken()->delete();
    }
}
