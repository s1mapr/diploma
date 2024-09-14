<?php

namespace App\Services;

use App\Models\Course;
use App\Repositories\LessonRepository;

class LessonService
{
    private LessonRepository $lessonRepository;

    public function __construct(LessonRepository $lessonRepository)
    {
        $this->lessonRepository = $lessonRepository;
    }

    public function createLesson(Course $course, array $data)
    {
        $data['course_id'] = $course->id;
        return $this->lessonRepository->createLesson($data);
    }
}
