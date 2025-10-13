<?php

namespace App\Enums;

enum AnalyticsReportsType: string
{
    case REVENUE = 'revenue';
    case ORDERS = 'orders';
    case PRODUCTS = 'products';
    case USERS = 'users';
    case CUSTOM = 'custom';
}