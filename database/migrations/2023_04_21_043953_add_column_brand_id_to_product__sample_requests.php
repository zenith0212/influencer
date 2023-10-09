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
        Schema::table('product_sample_requests', function (Blueprint $table) {
            $table->integer('brand_id')->nullable();
            // $table->foreign('brand_id')->references('user_id')->on('brand_details')->after('campaign_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product__sample_requests', function (Blueprint $table) {
            //
        });
    }
};
