<?php

namespace App\Enums;

enum VacancyStatusEnum: string
{
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';
    case EXPIRED = 'expired';



    public static function toArray(): array
    {
        return array_map(fn ($case) => $case->value, self::cases());
    }

    public static function selection(): array
    {
        return array_map(function ($case) {
            return [
                'label' => str_replace('_', ' ', ucwords(strtolower($case->value))),
                'value' => $case->value,
            ];
        }, self::cases());
    }
}
