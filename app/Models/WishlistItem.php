<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WishlistItem extends Model
{
    protected $fillable = [
        'wishlist_id',
        'product_id',
        'product_variant',
        'price_when_added',
        'note',
        'priority',
        'notify_price_drop',
        'notify_back_in_stock',
        'notified_at',
    ];

    protected $casts = [
        'product_variant' => 'array',
        'price_when_added' => 'float',
        'priority' => 'integer',
        'notify_price_drop' => 'boolean',
        'notify_back_in_stock' => 'boolean',
        'notified_at' => 'datetime',
    ];

    protected $dates = [
        'deleted_at',
    ];

    use \Illuminate\Database\Eloquent\SoftDeletes;

    public function wishlist()
    {
        return $this->belongsTo(Wishlist::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
