<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\ProductQuestionsStatus;

class ProductQuestion extends Model
{
    protected $fillable = [
        'product_id',
        'user_id',
        'question',
        'status',
        'is_anonymous',
        'helpful_count',
        'answers_count',
        'is_featured',
        'metadata',
    ];

    protected $casts = [
        'is_anonymous' => 'boolean',
        'is_featured' => 'boolean',
        'helpful_count' => 'integer',
        'answers_count' => 'integer',
        'metadata' => 'array',
        'status' => ProductQuestionsStatus::class,
        'deleted_at' => 'datetime',
    ];

    protected $dates = [
        'deleted_at',
    ];

    use \Illuminate\Database\Eloquent\SoftDeletes;

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
