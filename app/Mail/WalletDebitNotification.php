<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\WalletTransaction;

class WalletDebitNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $wallettransaction;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(WalletTransaction $wallettransaction)
    {
        $this->wallettransaction = $wallettransaction;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Wallet Debit Notification',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        
        return new Content(
            view: 'Emails.WalletDebitNotification', // Update with your email view path
            with: [
                'CustomerName' => $this->wallettransaction->user->name,
                'Amount' => number_format($this->wallettransaction->amount,2),
                'PaymentRemark'=>$this->wallettransaction->description,
                'Status'=>$this->wallettransaction->status,
                'DateCreated'=>date('d/m/Y H:i A', strtotime($this->wallettransaction->created_at)),
                'TransactionNumber'=>$this->wallettransaction->reference_number,
                'TransactionStatus'=>$this->wallettransaction->transaction_status,
                'OppennBalance'=>$this->wallettransaction->open_balance,
                'ReciverName'=>$this->wallettransaction->receiver->name,
                'ReciverMobile'=>$this->wallettransaction->receiver->mobile,
                'CloseBalane'=>$this->wallettransaction->close_balance
            ],
            
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
