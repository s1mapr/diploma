<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateStudentRequest;
use App\Http\Requests\UpdateTeacherRequest;
use App\Http\Resources\ChatResource;
use App\Http\Resources\CourseResource;
use App\Http\Resources\StudentResource;
use App\Http\Resources\TeacherResource;
use App\Services\ChatService;
use App\Services\CourseService;
use App\Services\TeacherService;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    private ChatService $chatService;
    private CourseService $courseService;
    private TeacherService $teacherService;

    public function __construct(ChatService $chatService, CourseService $courseService, TeacherService $teacherService)
    {
        $this->chatService = $chatService;
        $this->courseService = $courseService;
        $this->teacherService = $teacherService;
    }

    public function getTeacherChats(Request $request)
    {
        $teacher = $request->user();

        $chats = $this->chatService->getTeacherChats($teacher);

        return $this->success([
            'chats' => ChatResource::collection($chats),
            'current_page'=> $chats->currentPage(),
            'last_page'=> $chats->lastPage(),
            'total'=> $chats->total(),
        ]);
    }

    public function getAllTeacherCourses(Request $request)
    {
        $user = $request->user();
        $courses = $this->courseService->getAllTeacherCourses($user);

        return $this->success([
            'current_page'=> $courses->currentPage(),
            'last_page'=> $courses->lastPage(),
            'total'=> $courses->total(),
            'courses' => CourseResource::collection($courses)
        ]);
    }

    public function updateTeacherData(UpdateTeacherRequest $request)
    {
        $teacher = $request->user();
        $updatedStudent = $this->teacherService->updateTeacherData($teacher, $request->all());

        return $this->success([
            'teacher' => TeacherResource::make($updatedStudent)
        ]);
    }
}
