<?php

namespace App\Models;

use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Product extends Model
{
    use HasFactory;

    public const PRODUCT_UPLOAD_PATH = 'products/';

    protected $fillable = [
        'name_en',
        'name_ch',
        'keyword_en',
        'keyword_ch',
        'brand_id',
        'category_id',
        'description_en',
        'description_ch',
        'short_description_en',
        'short_description_ch',
        'price',
        'product_link',
        'total_sample',
        'is_available',
        'is_featured',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'price' => 'decimal:2',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }

    /* Relationships */
    
    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class)->where('is_main_image', false);
    }

    public function mainImage(): HasOne
    {
        return $this->HasOne(ProductImage::class)->where('is_main_image', true);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(BrandDetails::class,'brand_id','user_id');
    }

    public function campaigns(): HasMany
    {
        return $this->hasMany(Campaigns::class,'id','campaign_id');
    }

    public function sampleRequest(): HasMany
    {
        return $this->hasMany(ProductSampleRequests::class,'product_id','id');
    }

    public function campaignProducts(): HasMany
    {
        return $this->hasMany(CampaignProducts::class, 'product_id', 'id');
    }
}
