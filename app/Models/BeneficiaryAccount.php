<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserContact;
use App\Models\User;
use App\Models\PayoutBeneficiary;

class BeneficiaryAccount extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'beneficiary_accounts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];


    /**
     * Get the user that owns the beneficiary account.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the user contact associated with the beneficiary account.
     */
    public function userContact()
    {
        return $this->belongsTo(UserContact::class);
    }


     /**
     * Get the user contact associated with the beneficiary account.
     */
    public function MasterBank()
    {
        return $this->belongsTo(MasterBank::class, 'bank_id');
    }

    // Define the relationship with PayoutBeneficiary model
    public function payoutBeneficiaries()
    {
        return $this->hasMany(PayoutBeneficiary::class);
    }

     /**
     * Get the payout transfers for the beneficiary account.
     */
    public function payoutTransfers()
    {
        return $this->hasMany(PayoutTransfer::class, 'beneficiary_account_id');
    }



}
