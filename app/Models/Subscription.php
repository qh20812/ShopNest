<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Enums\SubscriptionStatus;

class Subscription extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'name',
        'stripe_id',
        'paypal_id',
        'gateway',
        'amount',
        'currency',
        'status',
        'trial_ends_at',
        'starts_at',
        'ends_at',
        'canceled_at',
        'metadata',
    ];

    protected $casts = [
        'amount' => 'float',
        'metadata' => 'array',
        'trial_ends_at' => 'datetime',
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
        'canceled_at' => 'datetime',
        'status' => SubscriptionStatus::class,
    ];

    protected $dates = [
        'trial_ends_at',
        'starts_at',
        'ends_at',
        'canceled_at',
        'deleted_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
