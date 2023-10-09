<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RatingsAndReviews extends Model
{
    use HasFactory;

     protected $fillable = [
        'brand_id',
        'influencer_id',
        'campaign_id',
        'review_ch',
        'review_en',
        'is_type',
        'star_ratings',
        'ratings_by',
        'brand_id',
        'rating_type'
    ];
}
