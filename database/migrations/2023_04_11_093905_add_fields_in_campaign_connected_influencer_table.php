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
            $table->enum('influencer_is_accept',['0','1'])
            ->default('0')->comment('1=yes,0=no  accepted by influencer or not')->after('is_type');
            $table->string('accept_reason_en')->nullable()->after('influencer_is_accept');
            $table->string('accept_reason_ch')->nullable()->after('accept_reason_en');
            $table->string('reject_reason_en')->nullable()->after('accept_reason_ch');
            $table->string('reject_reason_ch')->nullable()->after('reject_reason_en');
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
