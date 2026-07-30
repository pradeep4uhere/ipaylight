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
        Schema::create('payment_gateway_rates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('gateway_id');
            $table->string('payment_type');
            $table->decimal('rate', 8, 2);
            $table->boolean('is_active')->default(true);
            $table->enum('rate_type', ['Percentage', 'Flat'])->default('Percentage');
            $table->timestamps();
            // Define foreign key constraint
            $table->foreign('gateway_id')->references('id')->on('gateways')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_gateway_rates');
    }
};
