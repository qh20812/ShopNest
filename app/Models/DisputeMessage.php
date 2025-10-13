<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DisputeMessage extends Model
{
    protected $primaryKey = 'dispute_message_id';

    protected $fillable = [
        'dispute_id',
        'sender_id',
        'content',
        'attachment_url',
        'is_admin_message',
    ];

    protected $casts = [
        'is_admin_message' => 'boolean',
    ];

    protected $dates = [
        'deleted_at',
    ];

    use \Illuminate\Database\Eloquent\SoftDeletes;

    public function dispute()
    {
        return $this->belongsTo(Dispute::class);
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
}
