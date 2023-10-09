<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrandActivityLogs extends Model
{
    use HasFactory;
    use HasFactory;
    protected $fillable = [
        'id',
        'brand_id',
        'log_name',
        'description',
        'subject_type'
    ];
}
