<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\ProductAnswersUserType;

class ProductAnswer extends Model
{
    protected $fillable = [
        'question_id',
        'user_id',
        'answer',
        'user_type',
        'is_verified',
        'is_anonymous',
        'helpful_count',
        'not_helpful_count',
        'is_best_answer',
        'metadata',
    ];

    protected $casts = [
        'is_verified' => 'boolean',
        'is_anonymous' => 'boolean',
        'is_best_answer' => 'boolean',
        'helpful_count' => 'integer',
        'not_helpful_count' => 'integer',
        'metadata' => 'array',
        'user_type' => ProductAnswersUserType::class,
        'deleted_at' => 'datetime',
    ];

    protected $dates = [
        'deleted_at',
    ];

    use \Illuminate\Database\Eloquent\SoftDeletes;

    public function question()
    {
        return $this->belongsTo(ProductQuestion::class, 'question_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
