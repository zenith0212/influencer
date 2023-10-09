<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class ProductSampleRequests extends Model
{
    use HasFactory;

       protected $fillable = [
           'id',
           'campaign_id',
           'product_id',
           'influencer_id',
           'shipment_status',
           'brand_id'
       ];

      public function influencers(): HasMany
      {
        return $this->hasMany(User::class,'id','influencer_id');
      }

      public function products(): HasMany
      {
        return $this->hasMany(Product::class,'id','product_id');
      }

      public function campaigns(): HasMany
      {
        return $this->hasMany(Campaigns::class,'id','campaign_id');
      }


}
