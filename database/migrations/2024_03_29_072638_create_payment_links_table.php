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
        Schema::create('payment_links', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('gateway_id');
            $table->string('link_title');
            $table->text('description')->nullable();
            $table->decimal('max_amount', 10, 2)->nullable();
            $table->date('expiry_date');
            $table->enum('status', ['Active', 'InActive'])->default('Active');
            $table->unsignedBigInteger('user_id');
            $table->string('payment_link')->nullable();
            $table->timestamps();

            // Define foreign key constraint for gateway_id
            $table->foreign('gateway_id')->references('id')->on('gateways')->onDelete('cascade');

            // Define foreign key constraint for user_id
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_links');
    }
};
