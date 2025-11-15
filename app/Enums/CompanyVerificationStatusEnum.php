<?php

namespace App\Enums;

enum CompanyVerificationStatusEnum: string
{
    case PENDING = 'pending';
    case APPROVED = 'approved';
    case REJECTED = 'rejected';
}
