<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->integer('brand_id')->nullable();
            // $table->foreign('brand_id')->references('id')->on('brand_details');  
            $table->integer('influencer_id')->nullable();
            // $table->foreign('influencer_id')->references('id')->on('influencer_details');  
            $table->integer('campaign_id')->nullable();
            // $table->foreign('campaign_id')->references('id')->on('campaigns');  
            $table->integer('product_id')->nullable();
            // $table->foreign('product_id')->references('id')->on('products');  
            $table->double('brand_rating')->nullable()->comment('rating starts out of 5');
            $table->double('product_rating')->nullable()->comment('rating starts out of 5');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};
