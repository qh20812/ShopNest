<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\ShipmentJourneysLegType;

class ShipmentJourney extends Model
{
    protected $fillable = [
        'order_id',
        'leg_type',
        'shipper_id',
        'start_hub_id',
        'end_hub_id',
        'status',
    ];

    protected $casts = [
        'leg_type' => ShipmentJourneysLegType::class,
        'deleted_at' => 'datetime',
    ];

    protected $dates = [
        'deleted_at',
    ];

    use \Illuminate\Database\Eloquent\SoftDeletes;

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function shipper()
    {
        return $this->belongsTo(User::class, 'shipper_id');
    }

    public function startHub()
    {
        return $this->belongsTo(Hub::class, 'start_hub_id');
    }

    public function endHub()
    {
        return $this->belongsTo(Hub::class, 'end_hub_id');
    }
}
