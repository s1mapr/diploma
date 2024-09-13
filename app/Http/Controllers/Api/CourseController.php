<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCourseRequest;
use App\Http\Resources\CourseResource;
use App\Services\CourseService;

class CourseController extends Controller
{
    private CourseService $courseService;

    public function __construct(CourseService $courseService)
    {
        $this->courseService = $courseService;
    }

    public function createCourse(CreateCourseRequest $request)
    {
        $user = auth()->user();
        $course = $this->courseService->createCourse($user, $request->validated());

        return $this->success([
            'course' => CourseResource::make($course)
        ]);
    }
}
