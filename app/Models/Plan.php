<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Plan extends Model
{
    use HasFactory;
 
    protected $fillable = [
        'name_en',
        'name_ch',
        'description_en',
        'description_ch',
        'amount',
        'status',
        'plan_duration',
        'features_en',
        'features_ch',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }
}
