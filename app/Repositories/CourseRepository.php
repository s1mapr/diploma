<?php

namespace App\Repositories;

use App\Models\Course;

class CourseRepository
{
    public function createCourse(array $data)
    {
        return Course::create($data);
    }

    public function getAllTeacherCourses($teacherId)
    {
        return Course::where('teacher_id', $teacherId)->paginate(15);
    }
}
