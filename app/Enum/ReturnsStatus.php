<?php

namespace App\Enums;

enum ReturnsStatus: string
{
    case PENDING = 'pending';
    case APPROVED = 'approved';
    case REJECTED = 'rejected';
    case REFUNDED = 'refunded';
    case EXCHANGED = 'exchanged';
    case CANCELLED = 'cancelled';
}