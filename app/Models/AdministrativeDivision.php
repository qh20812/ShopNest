<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdministrativeDivision extends Model
{
    protected $fillable = [
        'country_id',
        'parent_id',
        'name',
        'level',
        'code',
    ];

    protected $casts = [
        'name' => 'array',
    ];

    protected $dates = [
        'deleted_at',
    ];

    use \Illuminate\Database\Eloquent\SoftDeletes;

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }
}
