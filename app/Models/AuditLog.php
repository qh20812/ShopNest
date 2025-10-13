<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\AuditLogAction;

class AuditLog extends Model
{
    protected $fillable = [
        'user_id',
        'action',
        'details',
        'ip_address',
    ];

    protected $casts = [
        'details' => 'array',
        'action' => AuditLogAction::class,
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
