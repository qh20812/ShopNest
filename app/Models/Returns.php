<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;
use App\Enums\ReturnReason;
use App\Enums\ReturnsStatus;
use App\Enums\ReturnType;

class Returns extends Model
{
    protected $primaryKey = 'return_id';

    protected $fillable = [
        'order_id',
        'customer_id',
        'return_number',
        'reason',
        'description',
        'status',
        'refund_amount',
        'type',
        'admin_note',
        'processed_at',
        'refunded_at',
    ];

    protected $casts = [
        'reason' => ReturnReason::class,
        'refund_amount' => 'float',
        'type' => ReturnType::class,
        'status' => ReturnsStatus::class,
        'processed_at' => 'datetime',
        'refunded_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    protected $dates = [
        'deleted_at',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }
}
