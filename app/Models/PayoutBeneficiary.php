<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class PayoutBeneficiary extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'contact_id',
        'beneficiary_account_id',
        'payout_name',
        'is_payout_beneficiary_added',
        'is_beneficiary_verified',
        'api_contact_id',
        'api_id'
    ];

    // Define relationships or additional methods here

     // Define the relationship with the UserContact model
     public function userContact()
     {
         return $this->belongsTo(UserContact::class, 'contact_id');
     }
 
     // Define the relationship with the BeneficiaryAccount model
     public function beneficiaryAccount()
     {
         return $this->belongsTo(BeneficiaryAccount::class);
     }

     // Define the relationship with the UserContact model
     public function user()
     {
         return $this->belongsTo(User::class, 'user_id');
     }

     public function payoutBeneficiaries()
     {
        return $this->hasMany(PayoutBeneficiary::class);
     }
}
