<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\UserEventsEventType;

class UserEvent extends Model
{
    protected $fillable = [
        'user_id',
        'session_id',
        'event_type',
        'event_category',
        'event_data',
        'ip_address',
        'user_agent',
        'referrer',
        'url',
    ];

    protected $casts = [
        'event_data' => 'array',
        'event_type' => UserEventsEventType::class,
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
