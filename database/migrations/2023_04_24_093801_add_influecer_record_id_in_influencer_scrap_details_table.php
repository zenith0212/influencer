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
        Schema::table('influencer_scrap_details', function (Blueprint $table) {
            //
            $table->integer('influencer_record_id')->unsigned();
            // $table->foreign('influencer_record_id')->references('id')->on('influencers_records'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('influencer_scrap_details', function (Blueprint $table) {
            //
        });
    }
};
