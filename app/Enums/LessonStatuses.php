<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum LessonStatuses: int
{
    use EnumTrait;

    case PUBLISHED = 1;
    case DRAFT = 2;
}
