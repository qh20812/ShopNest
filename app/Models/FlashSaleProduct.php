<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FlashSaleProduct extends Model
{
    protected $fillable = [
        'flash_sale_event_id',
        'product_variant_id',
        'flash_sale_price',
        'quantity_limit',
        'sold_count',
        'discount_percentage',
        'max_quantity_per_user',
        'metadata',
    ];

    protected $casts = [
        'flash_sale_price' => 'float',
        'quantity_limit' => 'integer',
        'sold_count' => 'integer',
        'discount_percentage' => 'float',
        'max_quantity_per_user' => 'integer',
        'metadata' => 'array',
    ];

    protected $dates = [
        'deleted_at',
    ];

    use \Illuminate\Database\Eloquent\SoftDeletes;

    public function flashSaleEvent()
    {
        return $this->belongsTo(FlashSaleEvent::class);
    }

    public function productVariant()
    {
        return $this->belongsTo(ProductVariant::class);
    }
}
