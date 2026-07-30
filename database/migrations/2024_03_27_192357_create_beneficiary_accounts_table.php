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
        Schema::create('beneficiary_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('beneficiary_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('user_contact_id');
            $table->unsignedBigInteger('bank_id')->nullable();
            $table->string('beneficiary_name');
            $table->string('account_number');
            $table->string('bank_name')->nullable();
            $table->string('ifsc_code')->nullable();
            $table->enum('status', ['Active', 'Inactive'])->default('Active');
            $table->string('account_type')->nullable();
            $table->timestamps();
            // Composite unique constraint
            $table->unique(['user_id', 'user_contact_id', 'account_number'], 'unique_beneficiary_accounts');
            // Foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('user_contact_id')->references('id')->on('user_contacts')->onDelete('cascade');           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beneficiary_accounts');
    }
};
