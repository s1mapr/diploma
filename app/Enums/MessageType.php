<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum MessageType: int
{
    use EnumTrait;

    case TEXT = 1;
    case MEDIA = 2;
}
