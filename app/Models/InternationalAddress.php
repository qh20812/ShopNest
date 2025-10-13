<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InternationalAddress extends Model
{
    protected $fillable = [
        'addressable_id',
        'addressable_type',
        'type',
        'first_name',
        'last_name',
        'company',
        'phone',
        'email',
        'address_line_1',
        'address_line_2',
        'address_line_3',
        'locality',
        'administrative_area',
        'sub_administrative_area',
        'postal_code',
        'country_code',
        'country_name',
        'latitude',
        'longitude',
        'validation_result',
        'formatted_address',
        'is_verified',
        'is_default',
        'timezone',
        'metadata',
    ];

    protected $casts = [
        'latitude' => 'float',
        'longitude' => 'float',
        'validation_result' => 'array',
        'metadata' => 'array',
        'is_verified' => 'boolean',
        'is_default' => 'boolean',
        'type' => \App\Enums\InternationalAddressesType::class,
        'deleted_at' => 'datetime',
    ];

    protected $dates = [
        'deleted_at',
    ];

    use \Illuminate\Database\Eloquent\SoftDeletes;

    public function addressable()
    {
        return $this->morphTo();
    }
}
