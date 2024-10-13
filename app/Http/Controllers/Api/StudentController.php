<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateStudentRequest;
use App\Http\Resources\CourseResource;
use App\Http\Resources\StudentResource;
use App\Services\CourseService;
use App\Services\StudentService;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    private CourseService $courseService;

    private StudentService $studentService;

    public function __construct(CourseService $courseService, StudentService $studentService)
    {
        $this->courseService = $courseService;
        $this->studentService = $studentService;
    }

    public function getAllStudentCourses(Request $request)
    {
        $student = $request->user();
        $courses = $this->courseService->getAllStudentCourses($student);

        return $this->success([
            'current_page' => $courses->currentPage(),
            'last_page' => $courses->lastPage(),
            'total' => $courses->total(),
            'courses' => CourseResource::collection($courses),
        ]);
    }

    public function updateStudentData(UpdateStudentRequest $request)
    {
        $student = $request->user();
        $updatedStudent = $this->studentService->updateStudentData($student, $request->all());

        return $this->success([
            'student' => StudentResource::make($updatedStudent),
        ]);
    }
}
