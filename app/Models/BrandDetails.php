<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Notifications\Notifiable;


class BrandDetails extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'user_id',
        'title_ch',
        'title_en',
        'category_id ',
        'logo',
        'address_en',
        'address_ch',
        'plan_id ',
        'country',
        'work_email',
        'company_name',
        'main_business',
        'product_category',
        'company_scale',
    ];

    public function users(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
   
    public function products(){
        return $this->hasMany(Product::class,'product_id','id');
    }

     public function campaigns(){
        return $this->hasMany(Campaigns::class,'campaign_id','id');
    }
   
}
