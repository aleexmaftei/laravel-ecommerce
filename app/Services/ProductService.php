<?php

namespace App\Services;

use App\DTOs\ProductDto;
use App\Repositories\Product\IProductRepository;
use App\Services\Base\BaseService;

class ProductService extends BaseService
{
    private IProductRepository $productRepository;

    public function __construct(IProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function store()
    {

    }

    public function update(ProductDto $product_dto, int $product_id)
    {
        return $this->execute_in_transaction(function () use ($product_dto, $product_id) {
            $product_to_update = $this->productRepository->getById($product_id);
            if (!$product_to_update) {
                abort(404);
            }

            $product_array = [
                "name" => $product_dto->name,
                "quantity" => $product_dto->quantity,
                "price" => $product_dto->price,
                "tva_percentage" => $product_dto->tva_percentage,
            ];

            return $this->productRepository->update($product_id, $product_array);
        });

    }
}
