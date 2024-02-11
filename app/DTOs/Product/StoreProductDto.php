<?php

namespace App\DTOs\Product;

use App\Http\Requests\Product\StoreProductRequest;

class StoreProductDto
{
    public function __construct(
        public readonly string $name,
        public readonly int    $quantity,
        public readonly int    $price,
        public readonly int    $tva_percentage,
        public readonly string $image
    )
    {

    }

    public static function create(StoreProductRequest $product): StoreProductDto
    {
        return new self(
            name: $product->validated("name"),
            quantity: $product->validated("quantity"),
            price: $product->validated("price"),
            tva_percentage: $product->validated("tva_percentage"),
            image: $product->validated("image")
        );
    }
}
