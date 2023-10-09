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
            $table->enum('status',['0','1','2','3','4','5'])
            ->default('0')->comment('1=Interested,2=Invited,3=Intial Accept,4=Intial Reject,5=Send Offer,0=no')->after('is_type');
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
