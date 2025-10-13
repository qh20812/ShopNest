<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\ShipperProfilesStatus;

class ShipperProfile extends Model
{
    protected $primaryKey = 'user_id';
    public $incrementing = false;

    protected $fillable = [
        'user_id',
        'id_card_number',
        'id_card_front_url',
        'id_card_back_url',
        'driver_license_number',
        'driver_license_front_url',
        'vehicle_type',
        'license_plate',
        'status',
        'operating_area',
    ];

    protected $casts = [
        'operating_area' => 'array',
        'status' => ShipperProfilesStatus::class,
        'deleted_at' => 'datetime',
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
