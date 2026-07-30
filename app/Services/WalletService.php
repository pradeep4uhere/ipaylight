<?php 
// app/Services/WalletService.php

namespace App\Services;
use App\Events\WalletCreditEvent;
use App\Events\WalletDebitEvent;
use App\Models\WalletTransaction;
use Illuminate\Support\Facades\Log;
use App\Models\Wallet;
use App\Mail\WalletCreditNotification;
use App\Mail\WalletDebitNotification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;
use App\Jobs\SendWalletDebitNotification;


class WalletService
{

    public function credit($amount, $sender_id, $receiver_id, $description, $status='Pending', $transaction_id=null)
    {
        try {
        $openBalance = Wallet::getWalletBalance($sender_id);
        $transaction =  WalletTransaction::create([
            'amount' => $amount,
            'sender_id'=>$sender_id,
            'receiver_id'=>$receiver_id,
            'transaction_id'=>($transaction_id==null)?generateTransactionNumber():$transaction_id,
            'reference_number' => 'waltxn_'.generateRefernceNumber(10),
            'transaction_status'=> $status,
            'transaction_type'=>'Credit',
            'open_balance'=>$openBalance,
            'close_balance'=>$openBalance+$amount,
            'description' => $description,
        ]);
        // Dispatch the WalletCreditEvent
        event(new WalletCreditEvent($sender_id, $amount));
        // Return the created transaction
         // Log an error message
        Log::info('WalletCreditEvent Success');
        // Send email notification
        $this->sendCreditNotification($sender_id, $transaction);
        return $transaction;

        }catch (Exception $e) {
            // Handle the exception (e.g., log it, provide user feedback, etc.)
            // Log an error message
            Log::error('WalletCreditEvent Error'.json_encode($e));
            return null;
        }
        
    }

    /***
     * Send email notification for credit amount into wallet
     * @param $userId
     * @param $transaction
     */
    protected function sendCreditNotification($userId, $transaction)
    {
        $wallet = WalletTransaction::where('sender_id', $userId)
        ->where('id',$transaction->id)
        ->first();
        if ($wallet) {
            Mail::to($wallet['user']['email'])->queue(new WalletCreditNotification($wallet));
        }
    }



    public function debit($amount, $sender_id, $receiver_id, $description, $status='Pending', $transaction_id=null)
    {
       $openBalance = Wallet::getWalletBalance($sender_id);
        $transaction =   WalletTransaction::create([
            'amount' => $amount,
            'sender_id'=>$sender_id,
            'receiver_id'=>$receiver_id,
            'transaction_id'=> generateTransactionNumber(),
            'reference_number' => ($transaction_id!=null)? $transaction_id : 'waltxn_'.generateRefernceNumber(10),
            'transaction_status'=> $status,
            'transaction_type'=>'Debit',
            'open_balance'=>$openBalance,
            'close_balance'=>$openBalance-$amount,
            'description' => $description,
        ]);
        // Dispatch the WalletCreditEvent
        event(new WalletDebitEvent($sender_id, $amount));
        $this->sendDebitNotification($sender_id, $transaction);
        // Return the created transaction
        return $transaction;
        
    }



    /***
     * Send email notification for debit amount into wallet
     * @param $userId
     * @param $transaction
     */
    protected function sendDebitNotification($userId, $transaction)
    {
        $wallet = WalletTransaction::where('sender_id', $userId)
        ->where('id',$transaction->id)
        ->first();
        if ($wallet) {
            //SendWalletDebitNotification::dispatch($wallet);
            Mail::to($wallet['user']['email'])->queue(new WalletDebitNotification($wallet));
        }
    }
}
