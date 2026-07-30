<?php

namespace App\Listeners;

use App\Events\TransactionSuccessful;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\WalletTransaction;
use App\Models\Transaction;
use App\Models\Settlement;
use App\Models\User;

use App\Services\WalletService;
use App\Models\PaymentGatewayRate;
use Illuminate\Support\Facades\Log;
use App\Mail\TransactionNotification;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;
use App\Events\SettlementEvent;

class UpdateWalletBalance
{

    use InteractsWithQueue;

    protected $walletService;

    /**
     * Create the event listener.
     */
    public function __construct(WalletService $walletService)
    {
        $this->walletService = $walletService;
    }


    /**
     * Method Name: isValidTransaction()
     * this method validate the credit amount into wallet
     * if amount is not crediated then its return true else return flase
     * @param TransactionObjectRow  $transactionObj
     * @return Boolean True Or False
     */
    private function isTransactionPresent($transactionObject){
        if(!empty($transactionObject)){
            $transaction_id = $transactionObject->id; 
            $user_id = $transactionObject->user_id;
            $exists = WalletTransaction::where('sender_id',$user_id)
            ->where('transaction_id',$transaction_id)
            ->where('transaction_status','Success')
            ->where('transaction_type','Credit')
            ->exists();
            if($exists) {
                return true;
            } else {
                return false;
            }
        }else{
            return false;
        }

    }

    /**
     * Handle the event.
     */
    public function handle(TransactionSuccessful $event)
    {
        $transactionId = $event->transactionId;
        $userId = $event->userId;
        //dd($transactionId);
        $transactionObject = Transaction::find($transactionId);
        //dd($transactionObject);
        if ($transactionObject) {
            $description =  $transactionObject->description;
            $sender_id = $userId;
            $amount = $transactionObject->deposite_amount;
            $receiver_id = $sender_id; // In this case, sender and receiver are same as we don't have any information about who
            // If transaction is deposit, sender id will be null and amount will be in receiver column
            // So we need to get it from there
            if($this->isTransactionPresent($transactionObject) === false){
                if($transactionObject->payment_type=='SameDay'){
                    $settalmentRes = event(new SettlementEvent($transactionId));
                    $lastInsertedId = Settlement::where('transaction_id', $transactionId)->latest()->first();
                    if($lastInsertedId==null){
                        Log::error("Settalment Records is not created for Transaction Id-".$transactionId);
                        Log::error("Amount Not Deposited to Wallet After Successfully Transactions.");
                    }else{
                        $user = User::find($receiver_id);
                        $s = Mail::to($user)->queue(new TransactionNotification($transactionObject));
                        Log::info("Amount Deposited to Wallet After Successfully Transactions.");
                    }
                }else{
                    $settalmentRes = event(new SettlementEvent($transactionId));
                }
                //Calculate Distributor Commission Amount
                $this->updateParentUserCommissionamountBasedOnGatewayPayment($transactionObject);
                $this->updateSuperParentUserCommissionamountBasedOnGatewayPayment($transactionObject);
                $this->updateAdminCommissionAmountBasedOnGatewayPayment($transactionObject);
               
            }else{
                Log::error("Amount Already Deposited to Wallet for Transaction Id:: ".$transactionObject->id);
            }
        }
    }



    /**
     * Get Parent User Rate based on Gateway of Transaction
     * @param TransactionObject
     * @return UserCommission Object
     */
    private function updateSuperParentUserCommissionamountBasedOnGatewayPayment(Transaction $transactionObj){
        $superDistributor = [];
        $userId = $transactionObj->user_id;
        $retailer = User::find($userId);
        // Check if the agent has a parent distributor
        $distributor = $retailer->distributor;
        //Get SuperDistributor Details
        if ($distributor->parent_id > 0) {
            $distributor_user_id = $distributor->id;
            $payment_mode = strtoupper($transactionObj->method);
            $gateway_id = $transactionObj->gateway_id; 
            $distributorUserCommissionDetails = User::UserCommissionRate($distributor_user_id,$gateway_id,$payment_mode);
            $distributorRate = $distributorUserCommissionDetails['rate'];
            $superDistributor = User::find($distributor->parent_id);
        }
        
        if ($superDistributor) {
            // Calculate commission based on the difference in rates
            $transactionAmount = $transactionObj->amount;
            $agentRate = $distributorRate;
            $payment_mode = strtoupper($transactionObj->method);
            $gateway_id = $transactionObj->gateway_id;  // Assuming you have a method to retrieve the agent's commission rate
            $parent_user_id = $superDistributor->id;
            $usercommissionDetails = User::UserCommissionRate($parent_user_id,$gateway_id,$payment_mode);
            //dd($usercommissionDetails);
            if($usercommissionDetails){
                $parentUserRate = $usercommissionDetails['rate']; 
                if((float)$agentRate >= (float)$parentUserRate){
                    $commissionDifference = (float)$agentRate-(float)$parentUserRate;
                    $commissionAmount = (float)$transactionAmount * ((float)$commissionDifference/100);
                    $description = "Commission Amount";
                    $lastWalletId = $this->walletService->credit($commissionAmount, $parent_user_id, $userId,  $description, 'Success', $transactionObj->id);
                    $user = User::find($parent_user_id);
                    $s = Mail::to($user)->send(new TransactionNotification($transactionObj));
                    Log::debug("Super Parent User Commission Rate: ".$commissionDifference." and amount is: ".$commissionAmount); 
                }else{
                    Log::error("Distributor Agent's rate should not be greater than Super Distributors rate, Error in UpdateWalletBalance Listner"); 
                }
            }else{
                Log::error("Super Parent Usercommission Details Of Transactions Not Found in UpdateWalletBalance Listner."); 
            }
        }else{
            Log::error("Super Parent User Not Found for Current User Of the Transactions."); 
        }
    }




     /**
     * Get Parent User Rate based on Gateway of Transaction
     * @param TransactionObject
     * @return UserCommission Object
     */
    private function updateParentUserCommissionamountBasedOnGatewayPayment(Transaction $transactionObj){
        $userId = $transactionObj->user_id;
        $retailer = User::find($userId);
        // Check if the agent has a parent distributor
        $distributor = $retailer->distributor;
        
        if ($distributor) {
            // Calculate commission based on the difference in rates
            $transactionAmount = $transactionObj->amount;
            $agentRate = $transactionObj->rate_fee;
            $payment_mode = strtoupper($transactionObj->method);
            $gateway_id = $transactionObj->gateway_id;  // Assuming you have a method to retrieve the agent's commission rate
            $parent_user_id = $distributor->id;
            $usercommissionDetails = User::UserCommissionRate($parent_user_id,$gateway_id,$payment_mode);
            //dd($usercommissionDetails);
            if($usercommissionDetails){
                $parentUserRate = $usercommissionDetails['rate'];
                if((float)$agentRate >= (float)$parentUserRate){
                    $commissionDifference = (float)$agentRate-(float)$parentUserRate;
                    $commissionAmount = (float)$transactionAmount * ((float)$commissionDifference/100);
                    $description = "Commission Amount";
                    $lastWalletId = $this->walletService->credit($commissionAmount, $parent_user_id, $userId,  $description, 'Success', $transactionObj->id);
                    $user = User::find($parent_user_id);
                    $s = Mail::to($user)->send(new TransactionNotification($transactionObj));
                    Log::debug("Parent User Commission Rate: ".$commissionDifference." and amount is: ".$commissionAmount); 
                }else{
                    Log::error("Agent's rate should not be greater than Distributors rate, Error in UpdateWalletBalance Listner"); 
                }
            }else{
                Log::error("Parent Usercommission Details Of Transactions Not Found in UpdateWalletBalance Listner."); 
            }
        }else{
            Log::error("Parent User Not Found for Current User Of the Transactions."); 
        }
    }





     /**
     * Get Admin User Rate based on Gateway of Transaction
     * @param TransactionObject
     * @return UserCommission Object
     */
    private function updateAdminCommissionAmountBasedOnGatewayPayment(Transaction $transactionObj){
            $userId = $transactionObj->user_id;
            $retailer = User::find($userId);
            $distributor = $retailer->distributor;
            if ($distributor) {
                // Calculate commission based on the difference in rates
                $transactionAmount = $transactionObj->amount;
                $payment_mode = strtoupper($transactionObj->method);
                $gateway_id = $transactionObj->gateway_id;  // Assuming you have a method to retrieve the agent's commission rate
                $parent_user_id = $distributor->id;
                if($distributor->parent_id > 0){
                    $parent_user_id = $distributor->parent_id;
                }
                
               
                $usercommissionDetails = User::UserCommissionRate($parent_user_id,$gateway_id,$payment_mode);
                if($usercommissionDetails){
                    $parentUserRate = $usercommissionDetails['rate'];
                    if($usercommissionDetails->has('Gateway')){
                        $gatewy_id = $usercommissionDetails['Gateway']['id'];
                        $PaymentGatewayRatesDetails = PaymentGatewayRate::where('gateway_id',$gatewy_id)->where('payment_type',$payment_mode)->first();
                        if($PaymentGatewayRatesDetails['payment_type']==$payment_mode){
                            $adminBaseRateCharge = $PaymentGatewayRatesDetails['rate'];
                            $adminBaseRateType = $PaymentGatewayRatesDetails['rate_type'];
                            if($adminBaseRateType=='Percentage'){
                                $adminCommissionRate = (float)$parentUserRate - (float)$adminBaseRateCharge;
                                $adminCommissionAmount = (float)$transactionAmount * ((float)$adminCommissionRate/100);
                            }else{
                                $adminCommissionAmount = (float)$parentUserRate - (float)$adminBaseRateCharge;
                            }
                            $description = "Base Commission Amount";
                            $admin_user_id = 1;
                            if($admin_user_id){
                                $lastWalletId = $this->walletService->credit($adminCommissionAmount, $admin_user_id, $parent_user_id, $description, 'Success', $transactionObj->id);
                                if($lastWalletId){
                                    $user = User::find($admin_user_id);
                                    $s = Mail::to($user)->send(new TransactionNotification($transactionObj));
                                    Log::info("Admin User Commission Rate: ".$adminCommissionRate." and amount is: ".$adminCommissionAmount); 
                                }else{
                                    Log::error("Admin User Commission Rate not updated into wallet"); 
                                }
                            }else{
                                $admin_user_id = 1;
                            }
                        }else{
                            Log::error("Admin payment_type_status_and_rate Details not found in gateway in UpdateWalletBalance Listner."); 
                        }
                    }else{
                        Log::error("Parent Gateway Not Found for Current User Of the Transactions."); 
                    }
                }else{
                    Log::error("Parent Usercommission Details Of Transactions Not Found in UpdateWalletBalance Listner."); 
                }
            }else{
                Log::error("Parent User Not Found for Current User Of the Transactions."); 
        }

    }
}
