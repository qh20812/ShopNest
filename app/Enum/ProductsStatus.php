<?php

namespace App\Enums;

enum ProductsStatus: string
{
    case DRAFT = 'draft';
    case PENDING_APPROVAL = 'pending_approval';
    case PUBLISHED = 'published';
    case HIDDEN = 'hidden';
}