<?php

namespace App\Util;

class TypeExtract
{
    const INCOME = 1;

    const EXPENSE = 2;

    const CREDIT_CARD = 3;

    public static function cases()
    {
        return [
            self::INCOME => 'Receita',
            self::EXPENSE => 'Despesa',
            self::CREDIT_CARD => 'Cartão de crédito',
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
