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
        Schema::create('user_commission_settings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('gateway_id');
            $table->string('payment_type');
            $table->decimal('rate', 8, 2)->default(0.00);
            $table->decimal('next_day_rate', 8, 2)->default(0.00);
            $table->decimal('next_week_rate', 8, 2)->default(0.00);
            $table->enum('rate_type', ['Percentage', 'Flat'])->default('Percentage');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_commission_settings');
    }
};
