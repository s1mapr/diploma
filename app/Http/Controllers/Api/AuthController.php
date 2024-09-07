<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function login(LoginRequest $request)
    {
        $user = $this->userService->getUserByEmail($request->email);

        if (!$user) {
            return $this->error('User not found', 401);
        }
        if (!Hash::check($request['password'], $user->password)) {
            return $this->error('Credentials not match', 401);
        }

        $token = $user->createToken('default')->plainTextToken;

        return $this->success([
            'user' => UserResource::make($user),
            'token' => $token
        ]);
    }

    public function register(RegisterRequest $request)
    {
        $data = $request->validated();
        $user = $this->userService->createUser($data);

        $token = $user->createToken('default')->plainTextToken;

        return $this->success([
            'user' => UserResource::make($user),
            'token' => $token
        ]);
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        $this->userService->logout($user);

        return $this->successWithoutData("User logged out successfully");
    }
}
