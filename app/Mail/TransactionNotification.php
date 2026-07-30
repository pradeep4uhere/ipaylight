<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Transaction;

class TransactionNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        public Transaction $transaction,
    ) {}

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Transaction Notification',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'Emails.TransactionNotification',
            with: [
                'CustomerName' => $this->transaction->customer_name,
                'CustomerEmail' => $this->transaction->customer_email,
                'CustomerMobile'=>$this->transaction->customer_mobile,
                'Amount' => number_format($this->transaction->amount,2),
                'PaymentRemark'=>$this->transaction->description,
                'Status'=>$this->transaction->status,
                'DateCreated'=>date('d/m/Y H:i A', strtotime($this->transaction->created_at)),
                'PaymentGateway'=>$this->transaction->gateway_id,
                'SettalmentType'=>$this->transaction->payment_type,
                'TransactionNumber'=>$this->transaction->txn_id,
                'ReferenceNumber'=>$this->transaction->gateway_payment_id
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
