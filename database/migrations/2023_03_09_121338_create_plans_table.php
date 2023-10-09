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
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('name_en',100)->nullable();
            $table->string('name_ch',100)->nullable();
            $table->string('description_en',255)->nullable();
            $table->string('description_ch',255)->nullable();
            $table->double('amount');
            $table->enum('status',['0','1'])
            ->default('0')->comment('0=InActive,1=Active');
            $table->string('plan_duration',100)->nullable()->comment('30 Days, 60 Days, 365 Days');
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
};
