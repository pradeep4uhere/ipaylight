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
            
            $table->string('agent_code')->nullable();

            $table->string('aadhar_card_number')->nullable();
            $table->string('aadhar_front_pic')->nullable();
            $table->string('aadhar_back_pic')->nullable();
            $table->boolean('is_aadhar_verify')->nullable();

            $table->char('pan_card_number',10)->nullable();
            $table->string('pan_card_pic')->nullable();
            $table->boolean('is_pan_verify')->nullable();

            $table->string('city_name')->nullable();
            $table->mediumInteger('zipcode')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
