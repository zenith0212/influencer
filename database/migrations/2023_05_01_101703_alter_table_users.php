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
            $table->string('card_holder_name')->nullable()->after('stripe_customer_id');
            $table->string('card_number', 20)->nullable()->after('card_holder_name');
            $table->string('card_expiry_month',10)->nullable()->after('card_number');
            $table->string('card_expiry_year',10)->nullable()->after('card_expiry_month');
            $table->string('card_cvv',10)->nullable()->after('card_expiry_year');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('matches', function (Blueprint $table) {
            $table->dropColumn(['card_holder_name', 'card_number', 'card_expiry_month', 'card_expiry_year', 'card_cvv']);
        });
    }
};
