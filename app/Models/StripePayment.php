<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StripePayment extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'payment_id',
        'customer_id',
        'amount',
        'currency',
        'status',
        'json_response',
        'user_id',
        'payment_token'
    ];
}
