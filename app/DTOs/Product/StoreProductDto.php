<?php

namespace App\DTOs\Product;

use App\Http\Requests\Product\StoreProductRequest;

class StoreProductDto
{
    public function __construct(
        public readonly string  $name,
        public readonly ?string $short_description,
        public readonly ?string $description,
        public readonly int     $quantity,
        public readonly int     $price,
        public readonly int     $tva_percentage
    )
    {

    }

    public static function create(StoreProductRequest $product): StoreProductDto
    {
        return new self(
            name: $product->validated("name"),
            short_description: $product->validated("short_description"),
            description: $product->validated("description"),
            quantity: $product->validated("quantity"),
            price: $product->validated("price"),
            tva_percentage: $product->validated("tva_percentage"),
        );
    }
}
