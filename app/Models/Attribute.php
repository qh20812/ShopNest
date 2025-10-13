<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $fillable = [
        'name',
    ];

    protected $dates = [
        'deleted_at',
    ];

    use \Illuminate\Database\Eloquent\SoftDeletes;
}
