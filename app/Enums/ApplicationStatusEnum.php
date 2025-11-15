<?php

namespace App\Enums;

enum ApplicationStatusEnum: string
{
    case PENDING = 'pending';
    case REVIEWED = 'reviewed';
    case INTERVIEW = 'interview';
    case OFFER_SENT = 'offer_sent';
    case HIRED = 'hired';
    case REJECTED = 'rejected';


    public static function toArray(): array
    {
        return array_values(array_map(
            fn ($case) => $case->value,
            self::cases()
        ));
    }

    public static function selection(): array
    {
        return array_values(array_map(function ($case) {
            return [
                'label' => str_replace('_', ' ', ucwords(strtolower($case->value))),
                'value' => $case->value,
            ];
        }, self::cases()));
    }
}
