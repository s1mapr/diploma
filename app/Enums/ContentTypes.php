<?php

namespace App\Enums;

enum ContentTypes: int
{
    case TEXT = 1;
    case IMAGE = 2;
    case VIDEO = 3;

    public static function toValuesArray(): array
    {
        return array_map(fn($type) => $type->value, self::cases());
    }

    public static function getFromValue(int $value): ?self
    {
        foreach (self::cases() as $case) {
            if ($value === $case->value) {
                return $case;
            }
        }
        return null;
    }
}
