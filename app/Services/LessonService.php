<?php

namespace App\Services;

use App\Repositories\LessonRepository;

class LessonService
{
    private LessonRepository $lessonRepository;

    public function __construct(LessonRepository $lessonRepository)
    {
        $this->lessonRepository = $lessonRepository;
    }

    public function createLesson(array $data)
    {
        return $this->lessonRepository->createLesson($data);
    }
}
