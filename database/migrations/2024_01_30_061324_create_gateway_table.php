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
        Schema::create('gateways', function (Blueprint $table) {
            $table->id();
            $table->string('gateway_name')->unique();
            $table->string('pg_name')->unique();
            $table->string('pg_short_code')->unique();
            $table->string('pg_client_key');
            $table->string('pg_seceret_key');
            $table->string('payout_client_key');
            $table->string('payout_secerts_key');
            $table->string('gateway_active');
            $table->string('payout_active');
            $table->text('payment_type_status_and_rate');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gateway');
    }
};
