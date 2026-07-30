<?php

namespace App\Listeners;

use App\Events\WalletDebitEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Wallet;


class WalletDebitListener
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
    public function handle(WalletDebitEvent $event): void
    {
        $wallet = Wallet::where('user_id', $event->userId)->first();
        if ($wallet && $wallet->amount >= $event->amount) {
            $wallet->amount -= $event->amount;
            $wallet->save();
        }
    }
}
