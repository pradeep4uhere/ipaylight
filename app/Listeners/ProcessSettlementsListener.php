<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\ProcessSettlements;
use Illuminate\Support\Facades\Log;
use App\Models\Settlement;
use App\Models\SettlementSetting;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Services\WalletService;
use App\Mail\SettalmentNotification;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;
use App\Models\User;




class ProcessSettlementsListener
{
    protected $walletService;

    /**
     * Create the event listener.
     */
    public function __construct(WalletService $walletService)
    {
        $this->walletService = $walletService;
    }


    /**
     * Handle the event.
     */
    public function handle(ProcessSettlements $event): void
    {
        $todayDate = Carbon::today();
        $timeWithSeconds = $todayDate->format('H:i:s');
        $currentTime = Carbon::now()->format('H:i:s');
        $dateTime = $todayDate->toDateString() . ' ' . $currentTime;
        $query = Settlement::with(['User','Transaction'])
                ->whereDate('scheduled_at', '<=', $dateTime)
                ->where('is_settled', 0)
                ->where('status','created')
                ->orderBy('scheduled_at','DESC');
        if($query->count()){
            $result = $query->get();
            foreach($result as $item){
                $this->makeSettalmentStatusFromCreatedToProccessed($item);   
            }
        }else{
            Log::debug("No settalment Amount Found To be Settaled.".date("d M,Y | H:i:s A"));
        }
    }



    /**
     * Method: Update Settalment Status
     */
    private function makeSettalmentStatusFromCreatedToProccessed($settalment){
        DB::beginTransaction();
        try {
            $settalmentSettingDetails = SettlementSetting::where('user_id',$settalment->user_id)
            ->where('gateway_id',$settalment->gateway_id)
            ->first();
            if($settalmentSettingDetails->domestic_settlement=='Enable'){
                //dd($settalmentSettingDetails);
                $settalmentObj = Settlement::With('User')->find($settalment->id);
                $settalmentObj->status = 'Processed';
                $settalmentObj->is_settled = 1;
                $settalmentObj->settled_at = date('Y-m-d H:i:s');
                $settalmentObj->utr_number = generateRandomAlphabetString(15);
                $settalmentObj->save();
            }
            $amount = $settalmentObj->net_amount;
            $receiver_id = $settalmentObj->user_id;
            $sender_id = $settalmentObj->user_id; 
            $description = 'Settlement Amount';
            $transaction_id = $settalmentObj->transaction_id;
            $lastWalletInsertId = $this->walletService->credit($amount, $receiver_id, $sender_id,  $description,'Success', $transaction_id);
            if($lastWalletInsertId){
                $user = User::find($settalmentObj->user_id);
                Log::debug("Settalment Process done with amount credit into wallet in ProcessSettlementsListener ".date("d M,Y | H:i:s A"));
                $s = Mail::to($user)->send(new SettalmentNotification($settalmentObj));
                //Send Email For Settalment Confirmation
            }else{
                DB::rollBack();
                Log::debug("Settalment Process not proccess Settalment Of Transaction ID ".$transaction_id.' on Date - '.date("d M,Y | H:i:s A"));
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::debug("Settalment Process Amount Found To be Settaled.".date("d M,Y | H:i:s A"));
            // Handle the exception, log, or throw further
        }
    }















}
