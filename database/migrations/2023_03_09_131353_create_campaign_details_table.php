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
        Schema::create('campaign_details', function (Blueprint $table) {
            $table->id();
            $table->integer('brand_id')->nullable()->comment('created_by');
            // $table->foreign('brand_id')->references('id')->on('brand_details');  
            $table->integer('influencer_id')->nullable()->comment('to');
            // $table->foreign('influencer_id')->references('id')->on('influencer_details');
            $table->integer('campaign_id')->nullable();
            // $table->foreign('campaign_id')->references('id')->on('campaigns');
            $table->integer('is_interested')->comment('Intersted influencers, 1= Yes , 0= No');   
            $table->double('min_influencer_amount')->nullable()->comment('per head influencer minimum amount for a campaign');
            $table->double('max_influencer_amount')->nullable()->comment('per head influencer maximum amount for a campaign');
            $table->date('campaign_enddate')->nullable();
            $table->longText('jsonResponse_data')->nullable();
            $table->enum('payment_status',['0','1','2'])
            ->default('0')->comment('0= Escrowed,1= Paid,2= Unpaid');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaign_details');
    }
};
