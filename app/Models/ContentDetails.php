<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContentDetails extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'title_en',
        'title_ch',
        'keyword_en',
        'keyword_ch',
        'description_en',
        'description_ch'
    ];
}
