<?php

namespace App\Enums;

enum ShippingDetailStatus: string
{
    case PENDING = 'pending';
    case SHIPPED = 'shipped';
    case IN_TRANSIT = 'in_transit';
    case DELIVERED = 'delivered';
    case FAILED = 'failed';
}