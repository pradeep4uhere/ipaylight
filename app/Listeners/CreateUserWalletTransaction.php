<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Registered;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateUserWalletTransaction
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
    public function handle(Registered $event): void
    {
        // Retrieve the user instance from the event
        $user = $event->user;

        // Create a wallet transaction record for the user
        Wallet::create([
            'user_id' => $user->id,
            'transaction_id' => uniqid('wtxn_'), // Generate a unique transaction ID
            'amount' => 0.00, // Set initial amount as needed
            'type' => 'credit', // Set initial type as needed
            'description' => 'Initial wallet balance', // Set initial description as needed
        ]);
    }
}
