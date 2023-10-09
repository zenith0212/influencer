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
        Schema::create('tbl_escrow', function (Blueprint $table) {
            $table->id();
            $table->integer('brand_id')->nullable();
            // $table->foreign('brand_id')->references('id')->on('brand_details');  
            $table->integer('influencer_id')->nullable();
            // $table->foreign('influencer_id')->references('id')->on('influencer_details'); 
            $table->double('amount')->nullable();
            $table->double('commission')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_escrow');
    }
};
