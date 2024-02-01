<?php

namespace App\Util;

class StatusExtract
{
    const PENDING = 1;

    const PAID = 2;

    public static function cases()
    {
        return [
            self::PENDING => 'Pendente',
            self::PAID => 'Paga',
        ];
    }

    public static function toString(int $value)
    {
        return self::cases()[$value] ?? false;
    }

    public static function toInteger(string $value)
    {
        return array_search($value, self::cases());
    }

    public static function casesString()
    {
        $cases = self::cases();
        sort($cases);

        return $cases;
    }
}
