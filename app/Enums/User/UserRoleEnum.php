<?php

namespace App\Enums\User;

enum UserRoleEnum: string
{
    case CANDIDATE = 'candidate';
    case COMPANY = 'company';
    case ADMIN = 'admin';
}
