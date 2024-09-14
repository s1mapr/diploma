<?php

namespace App\Enums;

enum CourseTypes: int
{
    use \App\Traits\EnumTrait;

    case PUBLIC = 1;
    case PRIVATE = 2;
}
