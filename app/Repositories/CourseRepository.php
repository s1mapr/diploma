<?php

namespace App\Repositories;

use App\Models\Course;

class CourseRepository
{
    public function createCourse(array $data)
    {
        return Course::create($data);
    }
}
