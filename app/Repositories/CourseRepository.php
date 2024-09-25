<?php

namespace App\Repositories;

use App\Enums\CourseStatuses;
use App\Enums\CourseTypes;
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

    public function getAllStudentCourses($studentId)
    {
        return Course::whereHas('students', function ($query) use ($studentId) {
            $query->where('student_id', $studentId);
        })->paginate(15);
    }

    public function getAllActiveCourses()
    {
        return Course::where('type', CourseTypes::PUBLIC)->where('status', CourseStatuses::ACTIVE)->paginate(15);
    }

    public function getCourseByCode(string $connection_code)
    {
        return Course::where('status', CourseStatuses::ACTIVE)->where('connection_code', $connection_code)->first();
    }
}
