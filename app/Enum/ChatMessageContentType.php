<?php

namespace App\Enums;

enum ChatMessageContentType: string
{
    case TEXT = 'text';
    case IMAGE = 'image';
    case FILE = 'file';
}