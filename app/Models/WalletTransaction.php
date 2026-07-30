<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WalletTransaction extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];



    public static function getWalletTransactionList($userId, $count=0)
    {
        // Get All List Of Wallet in Amdin Panale
        if($count>0){
            return WalletTransaction::where('sender_id', $userId)->OrderBy('id', 'DESC')->take(10)->get();
        }else{
            return WalletTransaction::where('sender_id', $userId)->OrderBy('id', 'DESC')->get();
        }
    }



     /**
     * Method Name: Get Distributor User Object
     * Get Distributor Details based on Agent User  ID
     * @param int $agentUserID - Agent User Id
     * Returns object of distributor details if found otherwise returns false
     */
    public function User()
    {
        return $this->belongsTo(User::class, 'sender_id'); // Assuming 'parent_id' is the foreign key in the users table referencing the distributor's id
    }


       /**
     * Method Name: Get Distributor User Object
     * Get Distributor Details based on Agent User  ID
     * @param int $agentUserID - Agent User Id
     * Returns object of distributor details if found otherwise returns false
     */
    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    // Define the sender relationship
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }



    /**
     * Get total Today Amount 
     */
    public static function getTotalWalletTransaction($userId,$date='today')
    {
        // Get All List Of Wallet in Amdin Panale
        $query =  WalletTransaction::where('sender_id', $userId)
        ->where('transaction_status','Success')
        ->OrderBy('id', 'DESC');
        if($date=='today'){
            $today = date('Y-m-d');
            $query->whereDate('created_at',$today);
        }
        $totalCredit = $query->where('transaction_type', 'Credit')->sum('amount');
        $totalDebit = $query->where('transaction_type', 'Debit')->sum('amount');
        $totalCommission = $totalCredit - $totalDebit;
        return number_format($totalCommission,2);
    }



    
    /**
     * Get total Today Amount 
     */
    public static function getLastWalletTransaction($userId)
    {
        // Get All List Of Wallet in Amdin Panale
        $result =  WalletTransaction::where('sender_id', $userId)
        ->where('transaction_status','Success')
        ->where('transaction_type','Credit')
        ->OrderBy('id', 'DESC')
        ->first();
        return $result;
    }



     /**
     * Get total Today Amount 
     */
    public static function getWalletTransactionsList($userId)
    {
        $result =  WalletTransaction::where('sender_id', $userId->id)
        ->OrderBy('id', 'DESC')
        ->paginate(10);
        return $result;
    }

}
