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
        Schema::create('ratings_and_reviews', function (Blueprint $table) {
            $table->id();
            $table->string('review_en',100)->nullable();
            $table->string('review_ch',100)->nullable();
            $table->integer('influencer_id')->nullable();
            $table->integer('campaign_id')->nullable();
            // $table->foreign('campaign_id')->references('id')->on('campaigns');
            $table->integer('brand_id')->nullable();
            // $table->foreign('brand_id')->references('id')->on('brand_details');
            $table->integer('is_type')->comment('1=signup,2=scrap');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ratings_and_reviews');
    }
};
