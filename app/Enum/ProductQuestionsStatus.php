<?php

namespace App\Enums;

enum ProductQuestionsStatus: string
{
    case PENDING = 'pending';
    case ANSWERED = 'answered';
    case REJECTED = 'rejected';
}