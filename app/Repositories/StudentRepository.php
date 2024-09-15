<?php

namespace App\Repositories;

use App\Models\Student;

class StudentRepository
{
    public function getStudentByEmail(string $email)
    {
        return Student::where('email', $email)->first();
    }

    public function createStudent(array $data)
    {
        return Student::create($data);
    }
}
