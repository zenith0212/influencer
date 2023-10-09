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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name_en',100)->nullable();
            $table->string('name_ch',100)->nullable();
            $table->string('keyword_en',100)->nullable();
            $table->string('keyword_ch',100)->nullable();
            $table->bigInteger('total_sample')->comment('Total no. of products')->nullable();
            $table->integer('category_id')->nullable();
            // $table->foreign('category_id')->references('id')->on('categories');
            $table->longText('description_en')->nullable();
            $table->longText('description_ch')->nullable();
            $table->string('short_description_en',255)->nullable();
            $table->string('short_description_ch',255)->nullable();
            $table->string('images')->nullable();
            $table->double('price')->nullable();
            $table->enum('is_available',['0','1'])
            ->default('0')->comment('Check for sample is available or not ,1=available ,0=not available');
            $table->enum('is_featured',['0','1'])
            ->default('0')->comment('1=featured ,0=not featured');
            $table->string('plan_duration',100)->nullable()->comment('30 Days, 60 Days, 365 Days');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
