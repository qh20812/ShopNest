<?php

namespace App\Enums;

enum PaymentMethodType: string
{
    case COD = 'cod';
    case BANK_TRANSFER = 'bank_transfer';
    case ONLINE_GATEWAY = 'online_gateway';
}