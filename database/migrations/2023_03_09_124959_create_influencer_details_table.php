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
        Schema::create('influencer_details', function (Blueprint $table) {
            $table->id();
            $table->string('verification_id',191)->nullable()->comment('Upload document and save URL of doc');
            $table->string('social_media_link')->nullable()->comment('influencer account url');
            $table->string('country',191)->nullable();
            $table->string('unique_tiktok_id_en')->nullable()->comment('unique name of titktok account');
            $table->string('unique_tiktok_id_ch')->nullable();
            $table->string('nickname_en')->nullable();
            $table->string('nickname_ch')->nullable();
            $table->enum('verified',['0','1'])->default('0')->comment('Verified user on Tiktok or not');
            $table->enum('gender',['m','f','o'])->default('o')->comment('M=male,F=Female, O= Other');
            $table->string('media_profile_url',191)->nullable();
            $table->bigInteger('follower_count')->nullable();
            $table->bigInteger('following_count')->nullable();
            $table->bigInteger('like_count')->nullable();
            $table->bigInteger('average_engagement_rate')->nullable();
            $table->bigInteger('average_engagement')->nullable();
            $table->integer('user_id')->nullable();
            // $table->foreign('user_id')->references('id')->on('users');           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('influencer_details');
    }
};
