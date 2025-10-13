<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\TransactionsType;
use App\Enums\TransactionStatus;
use App\Enums\GatewayType;

class Transaction extends Model
{
    protected $fillable = [
        'order_id',
        'type',
        'amount',
        'currency',
        'gateway',
        'gateway_transaction_id',
        'status',
        'refund_reason',
        'metadata',
    ];

    protected $casts = [
        'amount' => 'float',
        'metadata' => 'array',
        'type' => TransactionsType::class,
        'status' => TransactionStatus::class,
        'gateway' => GatewayType::class,
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
