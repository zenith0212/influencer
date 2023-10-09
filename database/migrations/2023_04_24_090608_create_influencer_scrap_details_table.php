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
        Schema::create('influencer_scrap_details', function (Blueprint $table) {
            $table->id();
            $table->string('post_id')->nullable();
            $table->longText('description',500)->nullable();
            $table->string('music_title')->nullable();
            $table->string('music_author_name')->nullable();
            $table->text('link')->nullable();
            $table->string('profile')->nullable();
            $table->bigInteger('like_count')->nullable();
            $table->bigInteger('share_count')->nullable();
            $table->bigInteger('comment_count')->nullable();
            $table->bigInteger('play_count')->nullable();
            $table->string('hastags')->nullable();
            $table->date('published_date')->nullable();
            $table->longText('json_response')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('influencer_scrap_details');
    }
};
