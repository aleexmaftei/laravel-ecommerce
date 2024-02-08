<?php

namespace App\DTOs;

use App\Http\Requests\ProductRequest;

class ProductDto
{
    public function __construct(
        public readonly string $name,
        public readonly int    $quantity,
        public readonly int    $price,
        public readonly int    $tva_percentage,
    )
    {

    }

    public static function create(ProductRequest $product): ProductDto
    {
        return new self(
            name: $product->validated("name"),
            quantity: $product->validated("quantity"),
            price: $product->validated("price"),
            tva_percentage: $product->validated("tva_percentage")
        );
    }
}
