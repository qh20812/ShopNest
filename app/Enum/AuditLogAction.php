<?php

namespace App\Enums;

enum AuditLogAction: string
{
    case LOGIN = 'login';
    case LOGOUT = 'logout';
    case UPDATE_PRODUCT = 'update_product';
    case CREATE_ORDER = 'create_order';
    case REFUND = 'refund';
    case OTHER = 'other';
}