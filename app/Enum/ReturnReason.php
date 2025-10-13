<?php

namespace App\Enums;

enum ReturnReason: string
{
    case DEFECTIVE_PRODUCT = 'defective_product';
    case WRONG_PRODUCT = 'wrong_product';
    case SIZE_ISSUE = 'size_issue';
    case OTHER = 'other';
}