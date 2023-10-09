<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Carbon\Carbon;

class Campaigns extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_en',
        'name_ch',
        'product_id',
        'brand_id',
        'min_fans',
        'max_fans',
        'amount',
        'total_influencers_required',
        'is_sample_required',
        'is_video',
        'application_start_date',
        'application_end_date',
        'campaign_is_active',
        'features_en',
        'features_ch',
        'description_en',
        'description_ch',
        'mail_comment_en',
        'mail_comment_ch',
        'terms_and_condition_ch',
        'terms_and_condition_en',
        'approached_by',
        'thumbnail_image',
        'is_requested',
        'apply_reason_en',
        'apply_reason_ch',
        'is_apply'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }

    public function scopeCampaignIsActive($query) {
        return $query->where('campaign_is_active', "1");
    }

    public function scopeCampaignIsCompleted($query) {
        return $query->where('application_end_date', "<", Carbon::today()->toDateString());
    }

    public function campaignConnectedInfluencer(): HasMany
    {
        return $this->hasMany(CampaignConnectedInfluencers::class, 'campaign_id', 'id');
    }

    public function campaignConnectedInfluencerTotalSpend(): HasMany
    {
        return $this->hasMany(CampaignConnectedInfluencers::class, 'campaign_id', 'id')->where(['payment_status' => '4', 'is_paid' => 1]);
    }

    public function campaignConnectedInfluencerRemainingSpend(): HasMany
    {
        return $this->hasMany(CampaignConnectedInfluencers::class, 'campaign_id', 'id')->where(['offer_status' => '2', 'is_paid' => 0]);
    }

    public function brands(): BelongsTo
    {
        return $this->belongsTo(BrandDetails::class, 'brand_id', 'user_id');
    }

    public function campaignProducts(): HasMany
    {
        return $this->hasMany(CampaignProducts::class, 'campaign_id', 'id');
    }

}
