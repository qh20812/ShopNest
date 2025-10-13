<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\FlashSaleEventsStatus;

class FlashSaleEvent extends Model
{
    protected $fillable = [
        'name',
        'start_time',
        'end_time',
        'status',
        'description',
        'banner_image',
        'metadata',
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'metadata' => 'array',
        'status' => FlashSaleEventsStatus::class,
        'deleted_at' => 'datetime',
    ];

    protected $dates = [
        'deleted_at',
    ];

    use \Illuminate\Database\Eloquent\SoftDeletes;
}
