<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\ChatMessageContentType;

class ChatMessage extends Model
{
    protected $primaryKey = 'chat_message_id';

    protected $fillable = [
        'chat_room_id',
        'sender_id',
        'content',
        'content_type',
        'attachment_url',
        'is_edited',
        'edited_at',
    ];

    protected $casts = [
        'content_type' => ChatMessageContentType::class,
        'is_edited' => 'boolean',
        'edited_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    protected $dates = [
        'deleted_at',
    ];

    use \Illuminate\Database\Eloquent\SoftDeletes;

    public function chatRoom()
    {
        return $this->belongsTo(ChatRoom::class);
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
}
