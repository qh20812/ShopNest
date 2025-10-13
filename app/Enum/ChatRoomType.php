<?php

namespace App\Enums;

enum ChatRoomType: string
{
    case USER_TO_USER = 'user_to_user';
    case USER_TO_SELLER = 'user_to_seller';
}