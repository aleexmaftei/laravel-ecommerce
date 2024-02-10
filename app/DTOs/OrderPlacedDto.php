<?php

namespace App\DTOs;

use App\Http\Requests\OrderPlacedRequest;

class OrderPlacedDto
{
    public function __construct(
        public readonly int $product_id,
        public readonly int $quantity,
        public readonly int $delivery_location_id,
    )
    {

    }

    public static function create(OrderPlacedRequest $orderPlaced): OrderPlacedDto
    {
        return new self(
            product_id: $orderPlaced->validated("product_id"),
            quantity: $orderPlaced->validated("quantity"),
            delivery_location_id: $orderPlaced->validated("delivery_location_id"),
        );
    }
}
