<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\AnalyticsReportsType;
use App\Enums\AnalyticsReportsPeriodType;
use App\Enums\AnalyticsReportsStatus;

class AnalyticsReport extends Model
{
    protected $fillable = [
        'title',
        'type',
        'period_type',
        'start_date',
        'end_date',
        'parameters',
        'result_data',
        'file_path',
        'status',
        'created_by',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'parameters' => 'array',
        'result_data' => 'array',
        'type' => AnalyticsReportsType::class,
        'period_type' => AnalyticsReportsPeriodType::class,
        'status' => AnalyticsReportsStatus::class,
        'deleted_at' => 'datetime',
    ];

    protected $dates = [
        'deleted_at',
    ];

    use \Illuminate\Database\Eloquent\SoftDeletes;

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
