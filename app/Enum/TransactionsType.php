<?php

namespace App\Enums;

enum TransactionsType: string
{
    case PAYMENT = 'payment';
    case REFUND = 'refund';
}