<?php

namespace App\Enums;

enum CourseStatuses: int
{
    case PUBLISHED = 1;
    case DRAFT = 2;
    case ARCHIVED = 3;

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
