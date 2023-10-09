<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;


class InfluencersRecords extends Model
{
    use HasFactory, Notifiable;
    protected $fillable = [
        'id',
        'account_id',
        'unique_id',
        'nickname' ,
        'signature',
        'verified' ,
        'gender',
        'region' ,
        'country' ,
        'language',
        'account_url' ,
        'link' ,
        'media_profile',
        'follower_count',
        'following_count',
        'like_count',
        'post_count',
        'average_like_count' ,
        'average_comment_count' ,
        'average_share_count',
        'average_play_count',
        'average_engagement_rate',
        'average_enagement' ,
        'amount_from',
        'amount_to' ,
        'currency',
        'email',
        'email_link',
        'response_data',
        'hastags'
    ];

    public function favourites(){
        return $this->hasOne(Favourites::class, 'influencer_id', 'id')->where('is_favourite','1');
    }

    public function influencerDetails(): HasMany
    {
        return $this->hasMany(InfluencerScrapDetails::class, 'influencer_record_id', 'id');
    }
}
