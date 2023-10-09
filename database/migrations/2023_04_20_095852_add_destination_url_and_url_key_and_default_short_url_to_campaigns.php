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
            $table->string('destination_url')->nullable()->after('traceable_link');
            $table->string('url_key')->nullable()->after('destination_url');
            $table->string('default_short_url')->nullable()->after('url_key');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('campaigns', function (Blueprint $table) {
            $table->dropColumn(['destination_url','url_key','default_short_url']);
        });
    }
};
