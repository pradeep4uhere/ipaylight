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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('entity')->nullable();;
            $table->string('gateway_payment_id')->nullable();;
            $table->string('txn_id')->nullable(); //Portal
            $table->string('payment_ref_key')->nullable(); //Portal
            $table->string('product_info')->nullable(); //Portal
            $table->unsignedBigInteger('customer_id')->nullable(); 
            $table->unsignedBigInteger('user_id'); // Changed to unsigned integer
            $table->unsignedBigInteger('gateway_id')->nullable(); 
            $table->decimal('rate_fee', 10, 2)->default(0.00);
            $table->decimal('deposite_amount', 10, 2)->default(0.00);
            $table->enum('payment_type', ['SameDay', 'NextDay', 'NextWeek', 'OtherPayment'])->default('OtherPayment');
            $table->decimal('amount', 10, 2)->default(0.00);
            $table->string('currency')->default('INR');
            $table->string('status')->default('Pending');
            $table->string('order_id')->nullable();
            $table->string('invoice_id')->nullable();
            $table->boolean('international')->nullable();
            $table->string('method')->nullable();
            $table->string('payment_mode')->nullable();
            $table->decimal('amount_refunded', 10, 2)->default(0.00);
            $table->string('refund_status')->nullable();
            $table->boolean('captured')->nullable();
            $table->string('description')->nullable();
            $table->string('link_text')->nullable();
            $table->string('card_id')->nullable();
            $table->string('card')->nullable();
            $table->string('bank')->nullable(); // Modified to store JSON data
            $table->string('wallet')->nullable();
            $table->string('vpa')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('customer_email')->nullable();
            $table->string('customer_mobile')->nullable();
            $table->decimal('fee', 10, 2)->default(0.00);
            $table->decimal('tax', 10, 2)->default(0.00);
            $table->string('error_code')->nullable();
            $table->string('error_description')->nullable();
            $table->string('error_source')->nullable();
            $table->string('error_step')->nullable();
            $table->string('error_reason')->nullable();
            $table->string('notes')->nullable();
            $table->timestamp('created_date')->nullable();
            $table->string('more_details')->nullable();
            $table->string('ip_address')->nullable();
            $table->string('user_browser')->nullable();
            $table->string('userAgent')->nullable();
            $table->json('location')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('gateway_id')->references('id')->on('gateways');  // Assuming users table exists
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
