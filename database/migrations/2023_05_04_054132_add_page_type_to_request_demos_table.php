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
        Schema::table('request_demos', function (Blueprint $table) {
            $table->tinyInteger('page_type')->after('company_scale')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('request_demos', function (Blueprint $table) {
            $table->dropColumn('page_type');
        });
    }
};
