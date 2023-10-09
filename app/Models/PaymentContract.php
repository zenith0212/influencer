<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentContract extends Model
{
    use HasFactory;

    protected $table = 'payment_contract';

    protected $fillable = [
        'campaign_connected_influencers_id',
        'campaign_id',
        'influencer_id',
        'brand_id',
        'amount',
        'payment_status',
    ];
}
