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
        Schema::table('brand_activity_logs', function (Blueprint $table) {
            //
            $table->integer('brand_id')->nullable();
            // $table->foreign('brand_id')->references('user_id')->on('brand_details')->after('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('brand_activity_logs', function (Blueprint $table) {
            //
        });
    }
};
