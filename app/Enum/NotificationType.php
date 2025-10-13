<?php

namespace App\Enums;

enum NotificationType: string
{
    case ORDER = 'order';
    case PROMOTION = 'promotion';
    case SHIPPING = 'shipping';
    case ACCOUNT = 'account';
}