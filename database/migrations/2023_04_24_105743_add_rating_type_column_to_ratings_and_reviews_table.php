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
        Schema::table('ratings_and_reviews', function (Blueprint $table) {
            $table->string('rating_type')->comment('1=Quick reply, 2=Credibility, 3=Compliant with contract, 4=Content quality')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ratings_and_reviews', function (Blueprint $table) {
            //
        });
    }
};
