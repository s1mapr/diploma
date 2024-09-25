<?php

namespace App\Repositories;

use App\Enums\LessonStatuses;
use App\Models\Lesson;

class LessonRepository
{
    public function createLesson(array $data)
    {
        return Lesson::create($data);
    }

    public function findAllLessonsOfCourse(int $id)
    {
        return Lesson::where('course_id', $id)->get();
    }

    public function findAllPublishedLessonsOfCourse(int $id)
    {
        return Lesson::where('course_id', $id)->where('status', LessonStatuses::PUBLISHED)->get();
    }
}
