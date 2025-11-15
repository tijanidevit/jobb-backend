<?php

namespace App\Enums;

enum VacancyStatus: string
{
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';
    case EXPIRED = 'expired';
}
