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
        Schema::create('table_product_sample_requests', function (Blueprint $table) {
            $table->id();
            $table->integer('campaign_id')->unsigned();
            // $table->foreign('campaign_id')->references('id')->on('campaigns');
            $table->integer('product_id')->unsigned();
            // $table->foreign('product_id')->references('id')->on('products');
            $table->integer('influencer_id')->unsigned();
            // $table->foreign('influencer_id')->references('id')->on('users');
            $table->integer('shipment_status')->comment('0=Default,1=requested,2=shipped,3=delivered')->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_product_sample_requests');
    }
};
