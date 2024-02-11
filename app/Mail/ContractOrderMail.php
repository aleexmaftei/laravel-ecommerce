<?php

namespace App\Mail;

use App\Models\Product;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContractOrderMail extends Mailable
{
    use Queueable, SerializesModels;

    private Product $product;
    private User $buyer;
    private int $quantity;

    /**
     * Create a new message instance.
     */
    public function __construct(Product $bought_product, int $quantity, User $buyer_user)
    {
        $this->product = $bought_product;
        $this->buyer = $buyer_user;
        $this->quantity = $quantity;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Contract Order Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: "mail.sale_contract",
            with: [
                "buyer"=> $this->buyer,
                "product" => $this->product,
                "quantity" => $this->quantity
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
        return [];
    }
}
