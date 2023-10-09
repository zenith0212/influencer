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
        Schema::create('brand_details', function (Blueprint $table) {
            $table->id();
            $table->string('title_en',255)->nullable();
            $table->string('title_ch',255)->nullable();
            $table->string('address_en',255)->nullable();
            $table->string('address_ch',255)->nullable();
            $table->string('logo',255)->nullable();
            $table->integer('category_id')->nullable();
            // $table->foreign('category_id')->references('id')->on('categories');
            $table->integer('user_id');
            // $table->foreign('user_id')->references('id')->on('users');
            $table->string('plan_id')->nullable();
            // $table->foreign('plan_id')->references('id')->on('plans');
            $table->string('country',255);
            $table->string('work_email')->unique();
            $table->string('company_name',255)->nullable();
            $table->string('main_business',255)->nullable();
            $table->string('product_category',255);
            $table->string('company_scale',255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brand_details');
    }
};
