<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShipperRating extends Model
{
    protected $fillable = [
        'order_id',
        'shipper_id',
        'customer_id',
        'rating',
        'comment',
        'criteria_ratings',
        'is_anonymous',
        'rated_at',
    ];

    protected $casts = [
        'rating' => 'integer',
        'criteria_ratings' => 'array',
        'is_anonymous' => 'boolean',
        'rated_at' => 'datetime',
    ];

    protected $dates = [
        'deleted_at',
    ];

    use \Illuminate\Database\Eloquent\SoftDeletes;

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function shipper()
    {
        return $this->belongsTo(User::class, 'shipper_id');
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }
}
