<?php

namespace App\Enum;

enum TargetIdentifiedEnum:string
{
    case CONTAINS = "contains";
    case NOT_CONTAINS = "notContains";
    case EQUALS = "equals";
    case STARTS_WITH = "startsWith";

    public static function getValues(): array
    {
        return [
            self::CONTAINS->value,
            self::NOT_CONTAINS->value,
            self::EQUALS->value,
            self::STARTS_WITH->value,
        ];
    }
}
