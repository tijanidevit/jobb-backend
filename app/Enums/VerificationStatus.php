<?php

namespace App\Enums;

enum VerificationStatus: string
{
    case PENDING = 'pending';
    case REVIEWED = 'reviewed';
    case INTERVIEW = 'interview';
    case OFFER_SENT = 'offer_sent';
    case HIRED = 'hired';
    case REJECTED = 'rejected';
}
