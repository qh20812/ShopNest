<?php

namespace App\Enums;

enum InternationalAddressesType: string
{
    case BILLING = 'billing';
    case SHIPPING = 'shipping';
    case PICKUP = 'pickup';
    case DEFAULT = 'default';
}