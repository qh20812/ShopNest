<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\ProductsStatus;

class Product extends Model
{
    protected $primaryKey = 'product_id';

    protected $fillable = [
        'shop_id',
        'name',
        'description',
        'category_id',
        'brand_id',
        'seller_id',
        'status',
        'is_active',
    ];

    protected $casts = [
        'name' => 'array',
        'description' => 'array',
        'is_active' => 'boolean',
        'status' => ProductsStatus::class,
        'deleted_at' => 'datetime',
    ];

    protected $dates = [
        'deleted_at',
    ];

    use \Illuminate\Database\Eloquent\SoftDeletes;

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }
}
