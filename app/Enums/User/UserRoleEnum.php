<?php

namespace App\Enums\User;

enum UserRoleEnum: string
{
    case CANDIDATE = 'candidate';
    case COMPANY = 'company';
    case ADMIN = 'admin';

    public static function toArray(): array
    {
        return array_values(array_map(
            fn ($case) => $case->value,
            array_filter(self::cases(), fn ($case) => $case !== self::ADMIN)
        ));
    }


    public static function selection(): array
    {
        return array_values(array_map(function ($case) {
            return [
                'label' => str_replace('_', ' ', ucwords(strtolower($case->value))),
                'value' => $case->value,
            ];
        }, array_filter(self::cases(), fn ($case) => $case !== self::ADMIN)));
    }

}
