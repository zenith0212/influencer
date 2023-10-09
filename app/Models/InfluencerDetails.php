<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfluencerDetails extends Model
{
    use HasFactory;

     protected $fillable = [
         'user_id',
         'verification_id',
         'social_media_link',
         'country',
         'unique_tiktok_id_en',
         'unique_tiktok_id_ch',
         'nickname_en',
         'nickname_ch',
         'verified',
         'gender',
         'media_profile_url',
         'follower_count',
         'following_count',
         'like_count',
         'average_engagement_rate',
         'average_engagement',
    ];

    public function users(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
