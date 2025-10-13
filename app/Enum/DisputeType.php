<?php

namespace App\Enums;

enum DisputeType: string
{
    case ITEM_NOT_RECEIVED = 'item_not_received';
    case ITEM_NOT_AS_DESCRIBED = 'item_not_as_described';
    case OTHER = 'other';
}