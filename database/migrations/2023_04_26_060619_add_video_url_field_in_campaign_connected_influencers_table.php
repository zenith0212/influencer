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
        Schema::table('campaign_connected_influencers', function (Blueprint $table) {
            //
            $table->string('video_url',500)->nullable()->after("reject_reason_ch");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('campaign_connected_influencers', function (Blueprint $table) {
            //
        });
    }
};
