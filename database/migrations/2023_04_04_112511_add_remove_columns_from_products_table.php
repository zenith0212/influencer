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
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('total_sample');
            $table->dropColumn('campaign_id');
            $table->dropColumn('images');
            $table->dropColumn('plan_duration');
            $table->dropColumn('thumbnail_image');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->bigInteger('total_sample')->comment('Total no. of products')->nullable()->after('keyword_ch');
            $table->integer('campaign_id')->after('brand_id');
            $table->string('images')->nullable()->after('short_description_ch');
            $table->string('plan_duration', 100)->nullable()->comment('30 Days, 60 Days, 365 Days')->after('is_featured');
            $table->string('thumbnail_image')->nullable()->after('updated_at');
        });
    }
};
