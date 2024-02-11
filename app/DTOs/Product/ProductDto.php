<?php

namespace App\DTOs\Product;

use App\Http\Requests\Product\ProductRequest;

class ProductDto
{
    public function __construct(
        public readonly string  $name,
        public readonly ?string $description,
        public readonly ?string $short_description,
        public readonly int     $quantity,
        public readonly int     $price,
        public readonly int     $tva_percentage
    )
    {

    }

    public static function create(ProductRequest $product): ProductDto
    {
        return new self(
            name: $product->validated("name"),
            description: $product->validated("description"),
            short_description: $product->validated("short_description"),
            quantity: $product->validated("quantity"),
            price: $product->validated("price"),
            tva_percentage: $product->validated("tva_percentage")
        );
    }
}
