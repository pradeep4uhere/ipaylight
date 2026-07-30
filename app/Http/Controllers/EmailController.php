<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Mail\TestMail;
use App\Models\User;
use App\Models\Transaction;
use App\Mail\TransactionNotification;
use Mail;


class EmailController extends Controller
{
    

    /**
     * Send Trasncation Confirmation To User
     */
    public static function trasncationNotificationEmail($transaction_id){
        $transactionData = Transaction::with('User')->find($transaction_id);
        try {
            $s = Mail::to($transactionData->customer_email)
            ->cc(env('ADMIN_EMAIL_ADDRESS')) // Add CC email address
            ->send(new TransactionNotification($transactionData));
            \Log::info('Transaction Email sent to customer');
            // Email sent successfully
        } catch (\Exception $e) {
            // Error occurred during email sending
            \Log::error('Email sending failed: ' . $e->getMessage());
        }
    }
}
