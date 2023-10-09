<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ratings extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand_id',
        'influencer_id',
        'campaign_id',
        'product_id',
        'brand_rating',
        'product_rating',
    ];

}
