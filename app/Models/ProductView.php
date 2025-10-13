<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductView extends Model
{
    protected $primaryKey = 'product_view_id';

    protected $fillable = [
        'user_id',
        'product_id',
        'view_count',
        'last_viewed',
    ];

    protected $casts = [
        'view_count' => 'integer',
        'last_viewed' => 'datetime',
    ];

    protected $dates = [
        'deleted_at',
    ];

    use \Illuminate\Database\Eloquent\SoftDeletes;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
