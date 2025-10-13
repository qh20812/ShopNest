<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PromotionCode extends Model
{
    protected $primaryKey = 'promotion_code_id';

    protected $fillable = [
        'promotion_id',
        'code',
        'usage_limit',
        'used_count',
        'is_active',
    ];

    protected $casts = [
        'usage_limit' => 'integer',
        'used_count' => 'integer',
        'is_active' => 'boolean',
    ];

    protected $dates = [
        'deleted_at',
    ];
    use \Illuminate\Database\Eloquent\SoftDeletes;

    public function promotion()
    {
        return $this->belongsTo(Promotion::class);
    }
}
