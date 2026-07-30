<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterBank extends Model
{
    use HasFactory;

    protected $fillable = [
        'bank_name',
        'ifsc_code',
        'status',
        'icon',
        'is_credit_card',
        'bank_code',
        'transfer_method_type',
    ];


    // Define the relationship with PayoutBeneficiary model
    public function BeneficiaryAccount()
    {
        return $this->hasMany(BeneficiaryAccount::class);
    }
}
