<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class InfluencerScrapDetails extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'post_id',
        'influencer_record_id',
        'description',
        'music_title',
        'music_author_name',
        'link',
        'profile',
        'like_count',
        'share_count',
        'comment_count',
        'play_count',
        'hastags',
        'published_date',
        'json_response'
    ];
}
