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
        Schema::table('users', function (Blueprint $table) {
             $table->boolean('is_mobile_verified')->default(false);
             $table->timestamp('mobile_verified_at')->nullable();
             $table->boolean('is_email_verified')->default(false);
             $table->boolean('is_kyc_completed')->default(false);
             $table->timestamp('aadhar_verified_at')->nullable();
             $table->timestamp('pan_verified_at')->nullable();
             $table->boolean('is_account_verified')->default(false);
             $table->timestamp('account_verified_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //Add columns for mobile and email verification
            $table->dropColumn([
                'is_mobile_verified', 
                'mobile_verified_at', 
                'is_email_verified', 
                'is_kyc_completed', 
                'aadhar_verified_at', 
                'pan_verified_at',
                'is_account_verified',
                'account_verified_at'
            ]);
        });
    }
};
