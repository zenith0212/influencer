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
        Schema::create('request_demos', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id')->unsigned();
            // $table->foreign('category_id')->references('id')->on('categories');
            $table->string('first_name', 55)->nullable();
            $table->string('last_name', 55)->nullable();
            $table->string('country', 10)->nullable();
            $table->string('email')->nullable();
            $table->string('company_name', 100)->nullable();
            $table->string('phone_number', 20)->nullable();
            $table->string('main_bussiness', 100)->nullable();
            $table->string('company_scale', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_demos');
    }
};
