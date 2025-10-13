<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SearchHistory extends Model
{
    protected $fillable = [
        'user_id',
        'search_term',
        'search_count',
        'last_searched',
    ];

    protected $casts = [
        'search_count' => 'integer',
        'last_searched' => 'datetime',
    ];

    protected $dates = [
        'deleted_at',
    ];

    use \Illuminate\Database\Eloquent\SoftDeletes;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
