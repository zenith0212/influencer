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
        Schema::create('influencers_records', function (Blueprint $table) {
            $table->id();
            $table->string('account_id',191)->nullable();
            $table->string('unique_id',191)->nullable();
            $table->string('nickname',191)->nullable();
            $table->string('signature',255)->nullable();
            $table->enum('verified',['0','1'])->default('0')->comment('Verified user on Tiktok or not');
            $table->enum('gender',['m','f','o'])->default('o')->comment('M=male,F=Female, O= Other');
            $table->string('region',20)->nullable();
            $table->string('country',50)->nullable();
            $table->string('language',191)->nullable();
            $table->string('account_url',191)->nullable();
            $table->string('link',191)->nullable();
            $table->string('media_profile',200)->nullable();
            $table->bigInteger('follower_count')->nullable();
            $table->bigInteger('following_count')->nullable();
            $table->bigInteger('like_count')->nullable();
            $table->bigInteger('post_count')->nullable();
            $table->bigInteger('average_like_count')->nullable();
            $table->bigInteger('average_comment_count')->nullable();
            $table->bigInteger('average_share_count')->nullable();
            $table->bigInteger('average_play_count')->nullable();
            $table->bigInteger('average_engagement_rate')->nullable();
            $table->bigInteger('average_enagement')->nullable();
            $table->bigInteger('amount_from')->nullable();
            $table->bigInteger('amount_to')->nullable();
            $table->string('currency',30)->nullable();
            $table->string('email',100)->nullable();
            $table->string('email_link',100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('influencers_records');
    }
};
