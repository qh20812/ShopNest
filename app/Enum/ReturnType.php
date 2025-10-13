<?php

namespace App\Enums;

enum ReturnType: string
{
    case REFUND = 'refund';
    case EXCHANGE = 'exchange';
}