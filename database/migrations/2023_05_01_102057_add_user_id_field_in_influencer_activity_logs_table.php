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
        Schema::table('influencer_activity_logs', function (Blueprint $table) {
            //
            $table->integer('influencer_id')->nullable();
            // $table->foreign('influencer_id')->references('user_id')->on('influencer_details')->after('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('influencer_activity_logs', function (Blueprint $table) {
            //
        });
    }
};
