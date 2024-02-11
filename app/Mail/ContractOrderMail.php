<?php

namespace App\Mail;

use App\Models\DeliveryLocation;
use App\Models\Product;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
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
    private User $seller;
    private int $quantity;
    private DeliveryLocation $buyer_delivery_location;
    private DeliveryLocation $seller_delivery_location;

    /**
     * Create a new message instance.
     */
    public function __construct(
        Product          $bought_product,
        int              $quantity,
        User             $buyer_user,
        User             $seller_user,
        DeliveryLocation $buyer_delivery_location,
        DeliveryLocation $seller_delivery_location
    )
    {
        $this->product = $bought_product;
        $this->buyer = $buyer_user;
        $this->seller = $seller_user;
        $this->quantity = $quantity;
        $this->buyer_delivery_location = $buyer_delivery_location;
        $this->seller_delivery_location = $seller_delivery_location;
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
        $this->prepareAttachmentData();

        return new Content(
            view: "mail.sale_contract",
            with: [
                "buyer" => $this->buyer,
                "product" => $this->product,
                "quantity" => $this->quantity
            ]
        );
    }

    private function prepareAttachmentData(): void
    {
        $data = [
            "today_date" => date("Y-m-d"),
            "seller_name" => $this->seller->first_name . $this->seller->last_name,
            "seller_address" => $this->seller_delivery_location->address_detail,
            "seller_postal_code" => $this->seller_delivery_location->postal_code,
            "buyer_name" => $this->buyer->first_name . $this->buyer->last_name,
            "buyer_address" => $this->buyer_delivery_location->address_detail,
            "buyer_postal_code" => $this->buyer_delivery_location->postal_code,
            "product_name" => $this->product->name,
            "product_quantity" => $this->quantity,
            "product_individual_price" => $this->product->price,
            "product_price" => $this->product->price * $this->quantity,
            "product_tva" => $this->product->tva_percentage
        ];

        $pdf = PDF::loadView("mail.sale_contract_pdf_template", $data);

        $this->attachData($pdf->output(), "sale_contract.pdf");
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
