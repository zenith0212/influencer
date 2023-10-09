<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class CampaignConnectedInfluencers extends Model
{
    use HasFactory;

    protected $fillable = [
       'campaign_id',
       'influencer_id',
       'is_type',
       'influencer_is_accept',
       'accept_reason_en',
       'accept_reason_ch',
       'reject_reason_en',
       'reject_reason_ch',
       'status',
       'invitation_status',
       'offer_status',
       'contract_status',
       'payment_status',
       'is_request',
       'video_url'
    ];

   public function campaigns(): BelongsTo
   {
        return $this->belongsTo(Campaigns::class, 'campaign_id', 'id')->with('brands');
   }

   public function influencer_record(): BelongsTo
   {
        return $this->belongsTo(InfluencersRecords::class, 'influencer_id', 'id');
   }

   public function ratings(): BelongsTo
   {
        return $this->belongsTo(RatingsAndReviews::class, 'id', 'influencer_id');
   }

   public function influencer_ratings(): BelongsTo
   {
        return $this->belongsTo(RatingsAndReviews::class, 'influencer_id', 'id');
   }

}
