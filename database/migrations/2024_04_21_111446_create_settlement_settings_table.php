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
        Schema::create('settlement_settings', function (Blueprint $table) {
            $table->id();
            $table->enum('domestic_settlement', ['Enable', 'Disable','Hold'])->default('Disable');
            $table->string('domestic_settlement_cycle')->default('T1');
            $table->string('domestic_settlement_time')->default('10:00');
            $table->decimal('domestic_settlement_fee', 5, 2)->default(0.05);
            $table->unsignedBigInteger('gateway_id');
            $table->unsignedBigInteger('user_id');
            $table->enum('international_settlement', ['Enable', 'Disable','Hold'])->default('Disable');
            $table->string('international_settlement_cycle')->default('T7');
            $table->string('international_settlement_time')->default('10:00');
            $table->decimal('international_settlement_fee', 5, 2)->default(0.05);
            $table->foreign('gateway_id')->references('id')->on('gateways')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settlement_settings');
    }
};
