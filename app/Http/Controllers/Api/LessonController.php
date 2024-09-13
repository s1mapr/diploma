<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCourseRequest;
use App\Http\Requests\CreateLessonRequest;
use App\Http\Resources\LessonResource;
use App\Services\LessonService;

class LessonController extends Controller
{
    private LessonService $lessonService;

    public function __construct(LessonService $lessonService)
    {
        $this->lessonService = $lessonService;
    }

    public function createLesson(CreateLessonRequest $request)
    {
        $lesson = $this->lessonService->createLesson($request->validated());

        return $this->success([
            'lesson' => LessonResource::make($lesson)
        ]);
    }
}
