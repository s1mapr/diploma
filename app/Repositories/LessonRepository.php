<?php

namespace App\Repositories;

use App\Models\Lesson;

class LessonRepository
{
    public function createLesson(array $data)
    {
        return Lesson::create($data);
    }
}
