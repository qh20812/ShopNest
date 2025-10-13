<?php

namespace App\Enums;

enum PromotionStatus: string
{
    case ACTIVE = 'active';
    case EXPIRED = 'expired';
    case UPCOMING = 'upcoming';
    case CANCELLED = 'cancelled';
}