<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    protected $fillable = [
        'user_id',
        'full_name',
        'phone_number',
        'street_address',
        'is_default',
        'country_id',
        'province_id',
        'district_id',
        'ward_id',
        'latitude',
        'longitude',
    ];

    protected $casts = [
        'is_default' => 'boolean',
        'latitude' => 'float',
        'longitude' => 'float',
    ];

    protected $dates = [
        'deleted_at',
    ];

    use \Illuminate\Database\Eloquent\SoftDeletes;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function province()
    {
        return $this->belongsTo(AdministrativeDivision::class, 'province_id');
    }

    public function district()
    {
        return $this->belongsTo(AdministrativeDivision::class, 'district_id');
    }

    public function ward()
    {
        return $this->belongsTo(AdministrativeDivision::class, 'ward_id');
    }
}
