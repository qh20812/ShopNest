<?php

namespace App\Enums;

enum ProductAnswersUserType: string
{
    case CUSTOMER = 'customer';
    case SELLER = 'seller';
    case ADMIN = 'admin';
}