<?php

namespace App\Enums;

enum OrdersStatus: string
{
    case PENDING_CONFIRMATION = 'pending_confirmation';
    case PROCESSING = 'processing';
    case PENDING_ASSIGNMENT = 'pending_assignment';
    case ASSIGNED_TO_SHIPPER = 'assigned_to_shipper';
    case DELIVERING = 'delivering';
    case DELIVERED = 'delivered';
    case COMPLETED = 'completed';
    case CANCELLED = 'cancelled';
    case RETURNED = 'returned';
}