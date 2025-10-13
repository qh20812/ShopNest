<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    protected $primaryKey = 'attribute_value_id';

    protected $fillable = [
        'attribute_id',
        'value',
    ];

    protected $dates = [
        'deleted_at',
    ];

    use \Illuminate\Database\Eloquent\SoftDeletes;

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }
}
