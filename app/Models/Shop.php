<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\ShopsStatus;

class Shop extends Model
{
    protected $fillable = [
        'owner_id',
        'name',
        'slug',
        'description',
        'logo',
        'banner',
        'phone',
        'email',
        'website',
        'business_type',
        'tax_id',
        'business_license',
        'address',
        'city',
        'state',
        'postal_code',
        'country',
        'status',
        'is_verified',
        'commission_rate',
        'shipping_policies',
        'return_policy',
        'social_media',
        'rating',
        'total_reviews',
        'total_sales',
        'total_revenue',
        'meta_title',
        'meta_description',
        'keywords',
        'verified_at',
        'last_active_at',
    ];

    protected $casts = [
        'is_verified' => 'boolean',
        'commission_rate' => 'float',
        'shipping_policies' => 'array',
        'return_policy' => 'array',
        'social_media' => 'array',
        'rating' => 'float',
        'total_reviews' => 'integer',
        'total_sales' => 'integer',
        'total_revenue' => 'float',
        'keywords' => 'array',
        'verified_at' => 'datetime',
        'last_active_at' => 'datetime',
        'status' => ShopsStatus::class,
        'deleted_at' => 'datetime',
    ];

    protected $dates = [
        'deleted_at',
    ];

    use \Illuminate\Database\Eloquent\SoftDeletes;

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
}
