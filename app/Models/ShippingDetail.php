<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\ShippingDetailStatus;

class ShippingDetail extends Model
{
    protected $primaryKey = 'shipping_detail_id';

    protected $fillable = [
        'order_id',
        'shipping_provider',
        'tracking_number',
        'external_order_id',
        'status',
        'shipping_fee',
        'status_history',
    ];

    protected $casts = [
        'status' => ShippingDetailStatus::class,
        'shipping_fee' => 'float',
        'status_history' => 'array',
        'deleted_at' => 'datetime',
    ];

    protected $dates = [
        'deleted_at',
    ];

    use \Illuminate\Database\Eloquent\SoftDeletes;

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
