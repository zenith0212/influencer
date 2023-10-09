<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favourites extends Model
{
    use HasFactory;

    protected $fillable = [
        'influencer_id',
        'brand_id',
        'is_type',
        'is_favourite',
    ];

    public function influencers(){
        return $this->hasMany(InfluencersRecords::class, 'id', 'influencer_id');
    }
}
