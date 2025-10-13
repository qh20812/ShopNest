<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $fillable = [
        'code',
        'exchange_rate',
        'is_active',
    ];

    protected $casts = [
        'exchange_rate' => 'float',
        'is_active' => 'boolean',
    ];

    protected $dates = [
        'deleted_at',
    ];

    use \Illuminate\Database\Eloquent\SoftDeletes;
}
