<?php

namespace App\Enums;

enum CourseStatuses: int
{
    use \App\Traits\EnumTrait;

    case ACTIVE = 1;
    case DRAFT = 2;
    case ARCHIVED = 3;
}
