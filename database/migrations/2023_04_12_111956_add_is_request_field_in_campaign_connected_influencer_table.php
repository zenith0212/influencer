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
            $table->enum('is_request',['0','1'])
            ->default('0')->comment('0=interested,1=apply')->after('is_type');
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
