<?php

namespace App\Enum;

enum TargetTypeEnum: string
{
    case TAG = 'tag';
    case ID = 'id';
    //бо class Class CLASS,
    //та інші комбінації великих та малих літер
    //є зарезервованими словами
    case CLASSE = 'class';
    case URL = 'url';
    case TEXT = 'text';

    public static function getValues(): array
    {
        return [
            self::TAG->value,
            self::ID->value,
            self::CLASSE->value,
            self::URL->value,
            self::TEXT->value,
        ];
    }
}
