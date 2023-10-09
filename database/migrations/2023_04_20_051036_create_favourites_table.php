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
        Schema::create('favourites', function (Blueprint $table) {
            $table->id();
            $table->integer('campaign_id')->unsigned();
            // $table->foreign('campaign_id')->references('id')->on('campaigns');
            $table->integer('influencer_id')->unsigned();
            // $table->foreign('influencer_id')->references('id')->on('influencers_records');
            $table->integer('brand_id')->unsigned();
            // $table->foreign('brand_id')->references('id')->on('brand_details');
            $table->integer('is_type')->comment('1=signup,2=scrap')->nullable();
            $table->integer('is_favourite')->comment('1=yes,2=no');            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('favourites');
    }
};
