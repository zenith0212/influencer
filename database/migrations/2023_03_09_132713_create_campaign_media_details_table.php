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
        Schema::create('campaign_media_details', function (Blueprint $table) {
            $table->id();
            $table->integer('brand_id')->nullable()->comment('created_by');
            // $table->foreign('brand_id')->references('id')->on('brand_details');  
            $table->integer('influencer_id')->nullable()->comment('to');
            // $table->foreign('influencer_id')->references('id')->on('influencer_details');
            $table->integer('campaign_id')->nullable();
            // $table->foreign('campaign_id')->references('id')->on('campaigns');
            $table->integer('product_id')->nullable();
            // $table->foreign('product_id')->references('id')->on('products');
            $table->string('video_url')->nullable();
            $table->string('livestream_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaign_media_details');
    }
};
