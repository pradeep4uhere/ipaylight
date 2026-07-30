<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayoutTransfer extends Model
{
    use HasFactory;


    public $timestamps = true; // Enable timestamps

    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'payout_transfers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'reference_id',
        'name',
        'payout_name',
        'user_id',
        'beneficiary_account_id',
        'user_contact_id',
        'payout_beneficiary_id',
        'amount',
        'fee',
        'tax',
        'status',
        'utr_number',
        'descriptions',
        'more_details',
        'failed_reason'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'amount' => 'decimal:2',
        'fee' => 'decimal:2',
        'tax' => 'decimal:2',
    ];

    /**
     * Get the user that owns the payout transfer.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the beneficiary account associated with the payout transfer.
     */
    public function beneficiaryAccount()
    {
        return $this->belongsTo(BeneficiaryAccount::class, 'beneficiary_account_id');
    }

    /**
     * Get the user contact associated with the payout transfer.
     */
    public function userContact()
    {
        return $this->belongsTo(UserContact::class, 'user_contact_id');
    }

    /**
     * Get the payout beneficiary associated with the payout transfer.
     */
    public function payoutBeneficiary()
    {
        return $this->belongsTo(PayoutBeneficiary::class, 'payout_beneficiary_id');
    }
}
