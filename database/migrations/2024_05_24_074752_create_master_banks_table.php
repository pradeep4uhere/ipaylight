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
        Schema::create('master_banks', function (Blueprint $table) {
            $table->id();
            $table->string('bank_name');
            $table->string('ifsc_code')->unique();
            $table->enum('status', ['Active', 'Inactive'])->default('Active');
            $table->string('icon')->nullable();
            $table->boolean('is_credit_card')->default(false);
            $table->string('bank_code')->nullable();
            $table->string('transfer_method_type')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_banks');
    }
};
