<?php

namespace App\Enums;

use Exception;

enum ListTypeEnum: string
{
    case NORMAL = '1';
    case TODO = '2';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * @throws Exception
     */
    public static function getValue($name): string
    {
        $cases = self::cases();
        foreach ($cases as $case) {
            if ($case->name == strtoupper($name)) {
                return $case->value;
            }
        }
        throw new Exception(__('message.transaction_status_is_incorrect'));
    }
}
