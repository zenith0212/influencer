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
        Schema::create('join_us', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id')->unsigned();
            // $table->foreign('product_id')->references('id')->on('products');
            $table->string('name', 100)->nullable();
            $table->string('work_email')->nullable();
            $table->string('phone_no', 20)->nullable();
            $table->string('company_name', 100)->nullable();
            $table->string('company_scale', 10)->nullable();
            $table->text('how_know_topbrandmate')->nullable();
            $table->string('company_introduction')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('join_us');
    }
};
