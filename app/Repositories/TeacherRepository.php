<?php

namespace App\Repositories;

use App\Models\Teacher;

class TeacherRepository
{
    public function getTeacherByEmail(string $email)
    {
        return Teacher::where('email', $email)->first();
    }
}
