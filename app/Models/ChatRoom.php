<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\ChatRoomType;

class ChatRoom extends Model
{
    protected $primaryKey = 'chat_room_id';

    protected $fillable = [
        'room_name',
        'type',
        'is_active',
    ];

    protected $casts = [
        'type' => ChatRoomType::class,
        'is_active' => 'boolean',
        'deleted_at' => 'datetime',
    ];

    protected $dates = [
        'deleted_at',
    ];

    use \Illuminate\Database\Eloquent\SoftDeletes;
}
