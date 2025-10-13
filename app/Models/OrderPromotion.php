<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderPromotion extends Model
{
    protected $table = 'order_promotion';

    protected $fillable = [
        'order_id',
        'promotion_id',
        'discount_applied',
    ];

    public $timestamps = false;

    protected $primaryKey = null;
    public $incrementing = false;

    protected $casts = [
        'discount_applied' => 'float',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function promotion()
    {
        return $this->belongsTo(Promotion::class);
    }
}
