<?php

namespace App\Services;

use App\Repositories\TeacherRepository;

class TeacherService
{
    private TeacherRepository $teacherRepository;

    public function __construct(TeacherRepository $teacherRepository)
    {
        $this->teacherRepository = $teacherRepository;
    }

    public function getTeacherByEmail(string $email)
    {
        return $this->teacherRepository->getTeacherByEmail($email);
    }
}
