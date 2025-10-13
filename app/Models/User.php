<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, \Illuminate\Database\Eloquent\SoftDeletes;

    protected $fillable = [
        'username',
        'email',
        'password',
        'provider',
        'provider_id',
        'avatar',
        'first_name',
        'last_name',
        'phone_number',
        'is_active',
        'default_address_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_active' => 'boolean',
    ];

    protected $dates = [
        'deleted_at',
    ];

    public function defaultAddress()
    {
        return $this->belongsTo(UserAddress::class, 'default_address_id');
    }
}
