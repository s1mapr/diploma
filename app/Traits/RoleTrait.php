<?php

namespace App\Traits;

use App\Models\Student;
use App\Models\Teacher;

trait RoleTrait
{
    public function isStudent(): bool
    {
        return $this instanceof Student;
    }

    public function isTeacher(): bool
    {
        return $this instanceof Teacher;
    }
}
