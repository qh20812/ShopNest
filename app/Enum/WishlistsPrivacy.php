<?php

namespace App\Enums;

enum WishlistsPrivacy: string
{
    case PRIVATE = 'private';
    case PUBLIC = 'public';
    case SHARED = 'shared';
}