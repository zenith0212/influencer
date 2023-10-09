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
        Schema::create('product_tracking_details', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id')->nullable();
            // $table->foreign('product_id')->references('id')->on('products');
            $table->integer('brand_id')->nullable();
            // $table->foreign('brand_id')->references('id')->on('brand_details');
            $table->integer('influencer_id')->nullable();
            // $table->foreign('influencer_id')->references('id')->on('influencer_details');
            $table->string('tracking_number')->nullable()->comment('Randm string');
            $table->enum('status',['0','1','2','3'])
            ->default('0')->comment('1-Dispatched,2-shipped,3-Delivered,0-Cancel');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_tracking_details');
    }
};
