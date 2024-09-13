<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Services\TeacherService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    private UserService $userService;
    private TeacherService $teacherService;

    public function __construct(UserService $userService, TeacherService $teacherService)
    {
        $this->userService = $userService;
        $this->teacherService = $teacherService;
    }

    public function userLogin(LoginRequest $request)
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

    public function teacherLogin(LoginRequest $request)
    {
        $user = $this->teacherService->getTeacherByEmail($request->email);

        if (!$user) {
            return $this->error('Teacher not found', 401);
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
