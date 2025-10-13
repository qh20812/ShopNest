<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\OrdersStatus;
use App\Enums\OrdersPaymentStatus;
use App\Enums\PaymentMethodType;

class Order extends Model
{
    protected $primaryKey = 'order_id';

    protected $fillable = [
        'customer_id',
        'order_number',
        'sub_total',
        'shipping_fee',
        'discount_amount',
        'total_amount',
        'status',
        'currency',
        'exchange_rate',
        'total_amount_base',
        'payment_method',
        'payment_status',
        'payment_transaction_id',
        'shipping_address_id',
        'notes',
        'shipped_at',
        'delivered_at',
        'shipper_id',
        'base_currency',
    ];

    protected $casts = [
        'sub_total' => 'float',
        'shipping_fee' => 'float',
        'discount_amount' => 'float',
        'total_amount' => 'float',
        'exchange_rate' => 'float',
        'total_amount_base' => 'float',
        'shipped_at' => 'datetime',
        'delivered_at' => 'datetime',
        'status' => OrdersStatus::class,
        'payment_status' => OrdersPaymentStatus::class,
        'payment_method' => PaymentMethodType::class,
        'deleted_at' => 'datetime',
    ];

    protected $dates = [
        'deleted_at',
    ];

    use \Illuminate\Database\Eloquent\SoftDeletes;

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function shipper()
    {
        return $this->belongsTo(User::class, 'shipper_id');
    }

    public function shippingAddress()
    {
        return $this->belongsTo(UserAddress::class, 'shipping_address_id');
    }
}
