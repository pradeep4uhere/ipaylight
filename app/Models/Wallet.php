<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\WalletTransaction;
use App\Models\Wallet;

class Wallet extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'transaction_id',
        'amount',
        'type',
        'description',
    ];


     /**
     * Get the login history entries associated with the user.
     */
    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public static function getWalletBalance($userId)
    {
        $walletBalance = '0.00';
        if(isset($userId)){
            $OldWalletBalance = Wallet::select('amount')->where('user_id',$userId)->first();
            if(!empty($OldWalletBalance)){
                $walletBalance = $OldWalletBalance['amount'];
            }
        }
        return $walletBalance;
    }



    public static function getWalletTotalAmount($userId,$type)
    {
        if($type == 'Credit'){
        // Calculate the total credit amount
        $totalAmount = WalletTransaction::where('sender_id', $userId)
            ->where('transaction_type', 'credit')
            ->sum('amount');
        }

        if($type == 'Debit'){
        // Calculate the total debit amount
        $totalAmount = WalletTransaction::where('sender_id', $userId)
            ->where('transaction_type', 'debit')
            ->sum('amount');
        }

        if($type == 'Pending'){
            // Calculate the total debit amount
            $totalAmount = WalletTransaction::where('receiver_id', $userId)
                ->where('transaction_type', 'Pending')
                ->sum('amount');
        }

        if($type == 'Reversal'){
            // Calculate the total debit amount
            $totalAmount = WalletTransaction::where('receiver_id', $userId)
                ->where('transaction_type', 'Reversal')
                ->sum('amount');
        }
        return $totalAmount;
    }
}
