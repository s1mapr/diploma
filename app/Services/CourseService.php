<?php

namespace App\Services;

use App\Models\Teacher;
use App\Repositories\CourseRepository;

class CourseService
{
    private CourseRepository $courseRepository;

    public function __construct(CourseRepository $courseRepository)
    {
        $this->courseRepository = $courseRepository;
    }

    public function createCourse(Teacher $user, array $data)
    {
        $data['teacher_id'] = $user->id;

        return $this->courseRepository->createCourse($data);
    }
}
