<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\ReviewMediaMediaType;

class ReviewMedia extends Model
{
    protected $fillable = [
        'review_id',
        'media_type',
        'file_name',
        'file_path',
        'mime_type',
        'file_size',
        'metadata',
        'display_order',
        'is_primary',
    ];

    protected $casts = [
        'file_size' => 'integer',
        'metadata' => 'array',
        'display_order' => 'integer',
        'is_primary' => 'boolean',
        'media_type' => ReviewMediaMediaType::class,
        'deleted_at' => 'datetime',
    ];

    protected $dates = [
        'deleted_at',
    ];

    use \Illuminate\Database\Eloquent\SoftDeletes;

    public function review()
    {
        return $this->belongsTo(Review::class);
    }
}
