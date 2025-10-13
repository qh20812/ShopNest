<?php

namespace App\Enums;

enum DisputesStatus: string
{
    case OPEN = 'open';
    case UNDER_REVIEW = 'under_review';
    case RESOLVED = 'resolved';
    case CLOSED = 'closed';
}