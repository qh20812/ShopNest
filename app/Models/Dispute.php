<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\DisputesStatus;
use App\Enums\DisputeType;

class Dispute extends Model
{
    protected $primaryKey = 'dispute_id';

    protected $fillable = [
        'order_id',
        'customer_id',
        'seller_id',
        'subject',
        'description',
        'status',
        'type',
        'assigned_admin_id',
        'resolution',
        'resolved_at',
    ];

    protected $casts = [
        'type' => DisputeType::class,
        'status' => DisputesStatus::class,
        'resolved_at' => 'datetime',
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

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function assignedAdmin()
    {
        return $this->belongsTo(User::class, 'assigned_admin_id');
    }
}
