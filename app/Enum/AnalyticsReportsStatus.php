<?php

namespace App\Enums;

enum AnalyticsReportsStatus: string
{
    case PENDING = 'pending';
    case COMPLETED = 'completed';
    case FAILED = 'failed';
}