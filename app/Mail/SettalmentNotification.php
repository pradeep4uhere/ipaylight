<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Transaction;
use App\Models\Settlement;

class SettalmentNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        public Settlement $settlement,
    ) {}

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Settalment Notification',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        //dd($this->settlement);
        //dd($this->settlement->user->name);
        return new Content(
            view: 'Emails.SettalmentNotification',
            with: [
                'customername' => $this->settlement->user->name,
                'Amount' => number_format($this->settlement->net_amount,2),
                'PaymentRemark'=>$this->settlement->description,
                'Status'=>$this->settlement->status,
                'DateCreated'=>date('d/m/Y H:i A', strtotime($this->settlement->scheduled_at)),
                'SettalmentID'=>$this->settlement->settlement_id,
                'UTR'=>$this->settlement->settlement_id,
                'ReferenceNumber'=>$this->settlement->reference_number,
                'Tax'=>$this->settlement->tax,
                'Fee'=>$this->settlement->fee
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
