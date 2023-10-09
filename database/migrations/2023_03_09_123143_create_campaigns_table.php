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
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('name_en',100)->nullable();
            $table->string('name_ch',100)->nullable();
            $table->integer('product_id')->nullable();
            // $table->foreign('product_id')->references('id')->on('products');
            $table->bigInteger('min_fans')->nullable();
            $table->bigInteger('max_fans')->nullable();
            $table->double('min_price',100)->nullable();
            $table->double('max_price',100)->nullable();
            $table->bigInteger('total_influencers_required')->comment('total no. of influencer required for campaign')->nullable();
            $table->enum('is_sample_required',['0','1'])
            ->default('0')->comment('Check for sample is required or not ,1=required ,0=not required');
            $table->enum('is_video',['0','1','2'])
            ->default('0')->comment('1=yes ,0=no, 2=live streaming');
            $table->date('application_start_date')->nullable();
            $table->date('application_end_date')->nullable();
            $table->enum('influencer_is_accept',['0','1'])
            ->default('0')->comment('1=yes,0=no  accepted by influencer or not');
            $table->enum('campaign_is_active',['0','1'])
            ->default('0')->comment('1=yes,0=no campaign is active or not');
            $table->longText('mail_comment_en')->nullable();
            $table->longText('mail_comment_ch')->nullable();
            $table->longText('terms_and_condition_en')->nullable();
            $table->longText('terms_and_condition_ch')->nullable();
             $table->enum('approached_by',['0','1'])
            ->default('0')->comment('1=add,0=email');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaigns');
    }
};
