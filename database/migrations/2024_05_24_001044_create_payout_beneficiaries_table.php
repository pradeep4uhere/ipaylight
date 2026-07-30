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
        Schema::create('payout_beneficiaries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained(); // Assuming 'user_id' references the 'users' table
            $table->foreignId('user_contact_id')->nullable()->constrained('user_contacts'); // Assuming 'contact_id' references the 'user_contacts' table
            $table->foreignId('beneficiary_account_id')->constrained('beneficiary_accounts');
            $table->string('api_contact_id')->nullable();
            $table->string('api_id')->nullable();
            $table->string('payout_name');
            $table->boolean('is_payout_beneficiary_added')->default(false);
            $table->boolean('is_beneficiary_verified')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payout_beneficiaries');
    }
};
