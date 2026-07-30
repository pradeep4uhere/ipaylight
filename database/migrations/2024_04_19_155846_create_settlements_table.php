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
        Schema::create('settlements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('settlement_id')->nullable();
            $table->string('utr_number')->nullable();
            $table->string('reference_number')->nullable();
            $table->unsignedBigInteger('transaction_id');
            $table->foreign('transaction_id')->references('id')->on('transactions')->onDelete('cascade');
            $table->unsignedBigInteger('gateway_id')->nullable();
            $table->decimal('amount', 15, 2);
            $table->decimal('net_amount', 15, 2);
            $table->boolean('is_settled')->default(false);
            $table->decimal('tax', 10, 2)->nullable();
            $table->decimal('fee', 10, 2)->nullable();
            $table->timestamp('settled_at')->nullable();
            $table->dateTime('scheduled_at')->nullable(); 
            $table->enum('status', ['Created', 'Initiated', 'Processed', 'Failed',])->default('Created');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settlements');
    }
};
