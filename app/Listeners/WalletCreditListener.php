<?php

namespace App\Listeners;

use App\Events\WalletCreditEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use App\Models\Wallet;

class WalletCreditListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    public function handle(WalletCreditEvent $event)
    {
        Log::debug("You are in Credit Listener...".$event->amount);
        Log::debug("User id is ".$event->userId);
        $wallet = Wallet::where('user_id', $event->userId)->first();
        if ($wallet) {
            $wallet->amount += $event->amount;
            //dd( $wallet->amount);
            Log::debug("You are in Credit Listener after update...".json_encode($wallet));
            $wallet->save();
        }
    }
}
