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
            $table->tinyInteger('ratings_by')->comment('1=>Brand','2=>influencer')->after('star_ratings');
            
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
