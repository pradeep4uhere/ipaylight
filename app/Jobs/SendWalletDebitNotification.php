<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\WalletCreditNotification;
use App\Mail\WalletDebitNotification;
use App\Models\WalletTransaction;
use Illuminate\Support\Facades\Mail;


class SendWalletDebitNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $walletTransaction;

     /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(WalletTransaction $walletTransaction)
    {
        $this->walletTransaction = $walletTransaction;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Fetch user email
        $userEmail = $this->walletTransaction->user->email;

        // Send the email notification
        Mail::to($userEmail)->send(new WalletDebitNotification($this->walletTransaction));
    }
}
