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
        Schema::create('product_images', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id')->unsigned();
            // $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->string('image', 100);
            $table->string('thumbnail_image', 100);
            $table->boolean('is_main_image')->default(false)->comment('0 - Product other images, 1 - Product main image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_images');
    }
};
