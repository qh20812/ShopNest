<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\WishlistsPrivacy;

class Wishlist extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'privacy',
        'is_default',
        'items_count',
    ];

    protected $casts = [
        'is_default' => 'boolean',
        'items_count' => 'integer',
        'privacy' => WishlistsPrivacy::class,
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
