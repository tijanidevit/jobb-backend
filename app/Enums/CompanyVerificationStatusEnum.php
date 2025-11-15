<?php

namespace App\Enums;

enum CompanyVerificationStatusEnum: string
{
    case PENDING = 'pending';
    case APPROVED = 'approved';
    case REJECTED = 'rejected';



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
