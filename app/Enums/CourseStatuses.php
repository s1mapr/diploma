<?php

namespace App\Enums;

enum CourseStatuses: int
{
    use \App\Traits\EnumTrait;

    case PUBLISHED = 1;
    case DRAFT = 2;
    case ARCHIVED = 3;
}
