<?php

namespace App\Enums;

enum ContentTypes: int
{
    use \App\Traits\EnumTrait;

    case TEXT = 1;
    case IMAGE = 2;
    case VIDEO = 3;
}
