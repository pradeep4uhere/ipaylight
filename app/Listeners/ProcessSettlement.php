<?php

namespace App\Listeners;

use App\Events\SettlementEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Transaction;
use App\Models\Settlement;
use App\Models\SettlementSetting;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use App\Mail\TransactionNotification;
use Illuminate\Support\Facades\Mail;
use DateTime;



class ProcessSettlement
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(SettlementEvent $event)
    {
       $transactionId = $event->transactionId;
        try {
            $transaction = Transaction::find($transactionId);
            if (!$transaction) {
                \Log::error('Transaction not found for ID: ' . $transactionId);
                return null;
            }else{
               $settlement =  $this->createNewSettalment($transaction);
               \Log::info('Settalment Records Generated for ID: ' . $transactionId);
            }
        } catch (\Exception $e) {
            // Handle exception, log error, etc.
            \Log::error('Error creating settlement: ' . $e->getMessage());
            return null;
        }
    }


    /**
     * Create New Settalment Records After Transcations
     * @param Transaction $transactionObj
     * @return Settlement $settlementObj
     */
    protected function createNewSettalment(Transaction $transaction)
    {

       
        //Validate for this Transaction Settalment already proccesseed
        $exists = Settlement::where('transaction_id', $transaction->id)->exists();
        if($exists){
            \Log::info('Settlement record already exists for transaction_id: ' . $transaction->id);
        }else{
            //Get User Settalment Status
            $settalmentDateTime = $this->getSettalmentScheduleSetting($transaction);
            \Log::debug('Settlement Time : ' . $settalmentDateTime);
            //Create New Settalment Record
            $settlement = new Settlement();
            //dd($settlement);
            $settlement->settlement_id = $this->generateSettlementId();
            $settlement->user_id = $transaction->user_id;
            $settlement->transaction_id = $transaction->id;
            $settlement->reference_number = $transaction->txn_id;
            $settlement->amount = $transaction->amount;
            $settlement->net_amount = $transaction->deposite_amount;
            $settlement->tax = $transaction->rate_fee;
            $settlement->gateway_id = $transaction->gateway_id;
            $settlement->fee = $transaction->fee;
            $status = $this->getSettalmentStatus($transaction->user_id);
            $settlement->status = $status;
            $settlement->scheduled_at = $settalmentDateTime;
            $settlement->is_settled = ($status=='Processed')?true:false;
            
            $settlement->save();
            \Log::debug('Settlement Time : ' . json_encode($settlement));
            return $settlement->id;
        }

    }


    /**
     * Method Name: getSettalmentSetting()
     * @param Transaction Object
     * @return Settalment Object
     */
    private function getSettalmentScheduleSetting(Transaction $transaction){
        if(!$transaction->international){
            $settalmentDetails = SettlementSetting::where('user_id',$transaction->user_id)
            ->where('gateway_id',$transaction->gateway_id)
            ->first();
            if($settalmentDetails==null){
                \Log::error('Settlement Setting Not Configured For this Retailer, Created With T10 Settalment Cycle default.');
                $scheduledDate = $this->getSettlementSechduleDateTime('T10');
            }else{
                $domestic_settlement_cycle =  $settalmentDetails['domestic_settlement_cycle'];
                $domestic_settlement_time = $settalmentDetails['domestic_settlement_time'];
                if($domestic_settlement_cycle=='T0'){
                    if($transaction->payment_type == 'NextDay'){
                        $scheduledDate = $this->getSettlementSechduleDateTime('T1');
                    }elseif($transaction->payment_type == 'NextWeek'){
                        $scheduledDate = $this->getSettlementSechduleDateTime('T7');
                    }else{
                        $scheduledDateTime = new DateTime();
                        if($domestic_settlement_time==0){
                            $scheduledDateTime->modify('+' . $domestic_settlement_time + 15 . ' minutes');
                        }else{
                            $scheduledDateTime->modify('+' . $domestic_settlement_time  . ' minutes');
                        }
                        $scheduledDate = $scheduledDateTime->format('Y-m-d H:i:s');
                    }
                    //dd($scheduledDate);
                }else if($domestic_settlement_cycle!=='T0'){
                    $scheduledDate = $this->getSettlementSechduleDateTime($domestic_settlement_cycle);
                    //dd($scheduledDate);
                }else{
                    $scheduledDate = $this->getSettlementSechduleDateTime('T1');
                }
          }
        }else{
            $scheduledDate = $this->getSettlementSechduleDateTime('T10');
        }
        return $scheduledDate;
    }


    private function getSettlementSechduleDateTime($timeType,$domestic_settlement_time='10:00'){
        $scheduledDateTime = new DateTime();
        if($timeType=='T1'){
            $scheduledDateTime->modify('+1 day'); // Move to the next day
        }elseif($timeType=='T2'){
            $scheduledDateTime->modify('+2 day');
        }elseif($timeType=='T3'){
            $scheduledDateTime->modify('+3 day');
        }elseif($timeType=='T4'){
            $scheduledDateTime->modify('+4 day');
        }elseif($timeType=='T5'){
            $scheduledDateTime->modify('+5 day');
        }elseif($timeType=='T6'){
            $scheduledDateTime->modify('+6 day');
        }elseif($timeType=='T7'){
            $scheduledDateTime->modify('+7 day');
        }elseif($timeType=='T8'){
            $scheduledDateTime->modify('+8 day');
        }elseif($timeType=='T9'){
            $scheduledDateTime->modify('+9 day');
        }elseif($timeType=='T10'){
            $scheduledDateTime->modify('+10 day');
        }
        $domestic_settlement_time_parts = explode(':', $domestic_settlement_time);
        $scheduledDateTime->setTime($domestic_settlement_time_parts[0], $domestic_settlement_time_parts[1]);
        // Format the scheduled date and time
        return $scheduledDateTime->format('Y-m-d H:i:s');
    }
        


    /**
     * Method Name: getSettalmentStatus()
     * @param   : User id
     * @return string
     */
    private function getSettalmentStatus($userId){
        $user = User::find($userId);
        return "Created";
    }



    



    /**
     * Generate a unique settlement ID.
     *
     * @return string
     */
    protected function generateSettlementId(): string
    {
        return 'settle_' . Carbon::now()->timestamp  . rand(1000, 9999);
    }
}
