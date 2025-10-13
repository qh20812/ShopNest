<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPreference extends Model
{
    protected $fillable = [
        'user_id',
        'preferred_category_id',
        'preferred_brand_id',
        'min_price_range',
        'max_price_range',
    ];

    protected $casts = [
        'min_price_range' => 'float',
        'max_price_range' => 'float',
    ];

    protected $dates = [
        'deleted_at',
    ];

    use \Illuminate\Database\Eloquent\SoftDeletes;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function preferredCategory()
    {
        return $this->belongsTo(Category::class, 'preferred_category_id');
    }

    public function preferredBrand()
    {
        return $this->belongsTo(Brand::class, 'preferred_brand_id');
    }
}
