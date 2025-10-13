<?php

namespace App\Enums;

enum GatewayType: string
{
    case COD = 'cod';
    case STRIPE = 'stripe';
    case MOMO = 'momo';
    case VNPAY = 'vnpay';
    case PAYPAL = 'paypal';
}