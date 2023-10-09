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
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['card_holder_name', 'card_number', 'card_expiry_month', 'card_expiry_year', 'card_cvv']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['card_holder_name', 'card_number', 'card_expiry_month', 'card_expiry_year', 'card_cvv']);
        });
    }
};
