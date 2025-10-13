<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\PromotionType;
use App\Enums\PromotionsPriority;

class Promotion extends Model
{
    protected $primaryKey = 'promotion_id';

    protected $fillable = [
        'name',
        'description',
        'type',
        'value',
        'min_order_amount',
        'max_discount_amount',
        'start_date',
        'end_date',
        'usage_limit',
        'used_count',
        'is_active',
        'priority',
        'stackable',
        'customer_eligibility',
        'geographic_restrictions',
        'product_restrictions',
        'budget_limit',
        'budget_used',
        'daily_usage_limit',
        'daily_usage_count',
        'per_customer_limit',
        'first_time_customer_only',
        'minimum_cart_value',
        'maximum_discount_amount',
        'time_restrictions',
        'auto_apply_condition',
        'terms_and_conditions',
        'last_used_at',
    ];

    protected $casts = [
        'type' => PromotionType::class,
        'value' => 'float',
        'min_order_amount' => 'float',
        'max_discount_amount' => 'float',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'usage_limit' => 'integer',
        'used_count' => 'integer',
        'is_active' => 'boolean',
        'priority' => PromotionsPriority::class,
        'stackable' => 'boolean',
        'customer_eligibility' => 'array',
        'geographic_restrictions' => 'array',
        'product_restrictions' => 'array',
        'budget_limit' => 'float',
        'budget_used' => 'float',
        'daily_usage_limit' => 'integer',
        'daily_usage_count' => 'integer',
        'per_customer_limit' => 'integer',
        'first_time_customer_only' => 'boolean',
        'minimum_cart_value' => 'float',
        'maximum_discount_amount' => 'float',
        'time_restrictions' => 'array',
        'auto_apply_condition' => 'array',
        'terms_and_conditions' => 'array',
        'last_used_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    protected $dates = [
        'deleted_at',
    ];

    use \Illuminate\Database\Eloquent\SoftDeletes;
}
