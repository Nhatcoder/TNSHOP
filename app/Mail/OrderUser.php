<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

use Illuminate\Support\Facades\Log;

class OrderUser extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $user;
    public $dataOrder;
    public $order;
    public function __construct($user, $dataOrder, $order)
    {
        $this->user = $user;
        $this->dataOrder = $dataOrder;
        $this->order = $order;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Cảm ơn bạn đã đặt hàng trên web TN - SHOP',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'email.order_user',
            with: [
                'user' => $this->user,
                'dataOrder' => $this->dataOrder,
                'order' => $this->order,
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    
    public function attachments(): array
    {
        Log::debug("Đã gửi mail cho người dùng");
        return [];
    }
}
