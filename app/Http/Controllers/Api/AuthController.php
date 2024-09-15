<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\StudentResource;
use App\Services\TeacherService;
use App\Services\StudentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    private StudentService $userService;
    private TeacherService $teacherService;

    public function __construct(StudentService $userService, TeacherService $teacherService)
    {
        $this->userService = $userService;
        $this->teacherService = $teacherService;
    }

    public function studentLogin(LoginRequest $request)
    {
        $user = $this->userService->getUserByEmail($request->email);

        if (!$user) {
            return $this->error('Student not found', 401);
        }
        if (!Hash::check($request['password'], $user->password)) {
            return $this->error('Credentials not match', 401);
        }

        $token = $user->createToken('default')->plainTextToken;

        return $this->success([
            'user' => StudentResource::make($user),
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
            'user' => StudentResource::make($user),
            'token' => $token
        ]);
    }

    public function register(RegisterRequest $request)
    {
        $data = $request->validated();
        $user = $this->userService->createStudent($data);

        $token = $user->createToken('default')->plainTextToken;

        return $this->success([
            'user' => StudentResource::make($user),
            'token' => $token
        ]);
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        $this->userService->logout($user);

        return $this->successWithoutData("Student logged out successfully");
    }
}
