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
        Schema::create('payout_transfers', function (Blueprint $table) {
            $table->id();
            $table->string('transfers_reference_id');
            $table->string('fund_account_id');
            $table->string('payout_id');
            $table->string('name');
            $table->string('payout_name');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('beneficiary_account_id');
            $table->unsignedBigInteger('user_contact_id');
            $table->unsignedBigInteger('payout_beneficiary_id');
            $table->decimal('amount', 15, 2);
            $table->decimal('fee', 15, 2)->default(0.00);
            $table->decimal('tax', 15, 2)->default(0.00);
            $table->enum('status', ['Success', 'Pending', 'Reverse', 'Cancel','Rejected'])->default('Pending');
            $table->string('utr_number')->nullable();
            $table->text('descriptions')->nullable();
            $table->text('more_details')->nullable();
            $table->text('failed_reason')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payout_transfers');
    }
};
