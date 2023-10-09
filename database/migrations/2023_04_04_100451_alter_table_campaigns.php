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
        Schema::table('campaigns', function (Blueprint $table) {
            $table->string('target_region', 20)->nullable()->after('max_price');
            $table->bigInteger('budget_for_each_influencer')->nullable()->after('total_influencers_required');
            $table->date('application_till_date')->nullable()->after('application_end_date');
            $table->string('promote')->nullable()->after('is_apply');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('campaigns', function (Blueprint $table) {
            $table->dropColumn(['target_region', 'budget_for_each_influencer', 'application_till_date', 'promote']);
        });
    }
};
