<?php

namespace App\Enums;

enum TransactionTypeEnum: string
{
    case COST = 'cost';
    case INCOME = 'income';

    public static function values(): array
    {
        return [
            self::COST->value,
            self::INCOME->value,
        ];
    }
}
