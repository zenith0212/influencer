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
        Schema::create('payment_contract', function (Blueprint $table) {
            $table->id();
            $table->integer('campaign_connected_influencers_id')->unsigned();
            // $table->foreign('campaign_connected_influencers_id')->references('id')->on('campaign_connected_influencers');  
            $table->integer('campaign_id')->unsigned();
            // $table->foreign('campaign_id')->references('id')->on('campaigns');
            $table->integer('influencer_id')->unsigned();
            // $table->foreign('influencer_id')->references('id')->on('influencers_records');
            $table->integer('brand_id')->unsigned();
            // $table->foreign('brand_id')->references('id')->on('brand_details');
            $table->double('amount');
            $table->enum('payment_status',['0','1','2'])
            ->default('0')->comment('0=hold,1=In progress,2=Paid');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_contract');
    }
};
