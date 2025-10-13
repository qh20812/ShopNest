<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReturnItem extends Model
{
    protected $primaryKey = 'return_item_id';

    protected $fillable = [
        'return_id',
        'variant_id',
        'quantity',
        'unit_price',
        'total_price',
        'reason',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'unit_price' => 'float',
        'total_price' => 'float',
    ];

    protected $dates = [
        'deleted_at',
    ];

    use \Illuminate\Database\Eloquent\SoftDeletes;

    public function return()
    {
        return $this->belongsTo(Returns::class, 'return_id');
    }

    public function variant()
    {
        return $this->belongsTo(ProductVariant::class, 'variant_id');
    }
}
