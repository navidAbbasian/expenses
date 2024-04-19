<?php

namespace App\Enums;

enum TransactionTypeEnum: string
{
    case COST = 'cost';
    case INCOME = 'income';
    case CART_TO_CART = 'cart_to_cart';

    public static function values(): array
    {
        return [
            self::COST->value,
            self::INCOME->value,
            self::CART_TO_CART->value,
        ];
    }
}
