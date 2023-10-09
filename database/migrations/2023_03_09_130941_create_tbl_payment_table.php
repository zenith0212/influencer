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
        Schema::create('tbl_payment', function (Blueprint $table) {
            $table->id();
            $table->integer('brand_id')->nullable()->comment('from');
            // $table->foreign('brand_id')->references('id')->on('brand_details');  
            $table->integer('influencer_id')->nullable()->comment('to');
            // $table->foreign('influencer_id')->references('id')->on('influencer_details'); 
            $table->double('amount')->nullable();
            $table->date('date')->nullable();
            $table->longText('jsonResponse_data')->nullable();
            $table->enum('payment_mode',['0','1'])
            ->default('0')->comment('0=CreditCard,1=DebitCard');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_payment');
    }
};
