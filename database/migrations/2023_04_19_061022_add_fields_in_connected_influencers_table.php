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
            $table->enum('invitation_status',['0','1','2','3','4'])
            ->default('0')->comment('0=default,1=Invited,2=Interested,3=Accepted,4=Rejected')->after('status');
            $table->enum('offer_status',['0','1','2','3','4'])
            ->default('0')->comment('0=default,1=Sent Offer,2=Offer Accepted,3=Offer Rejected,4=Offer Negotiate,5=Resend Offer')->after('invitation_status');
            $table->enum('contract_status',['0','1','2','3','4'])
            ->default('0')->comment('0=default,1=Hired/In Progress,2=Completed By Influencer,3=Completed by brand')->after('offer_status');
            $table->enum('payment_status',['0','1','2','3','4'])
            ->default('0')->comment('0=default,1=Payment Request,2=Reject Payment By Brand,3=Resubmit Request Payment for influencer,4=Paid/Completed')->after('contract_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('connected_influencers', function (Blueprint $table) {
            //
        });
    }
};
