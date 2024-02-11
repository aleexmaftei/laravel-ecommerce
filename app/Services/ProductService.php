<?php

namespace App\Services;

use App\DTOs\Product\ProductDto;
use App\DTOs\Product\StoreProductDto;
use App\Repositories\Category\ICategoryRepository;
use App\Repositories\Product\IProductRepository;
use App\Services\Base\BaseService;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;

class ProductService extends BaseService
{
    private IProductRepository $productRepository;
    private ICategoryRepository $categoryRepository;

    public function __construct(IProductRepository $productRepository, ICategoryRepository $categoryRepository)
    {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function store(StoreProductDto $product_dto, int $category_id)
    {
        return $this->execute_in_transaction(function () use ($product_dto, $category_id) {
            $category = $this->categoryRepository->getById($category_id);
            if (!$category) {
                throw ValidationException::withMessages(["general_error" => "Not found"]);
            }

            $current_user_id = auth()->user()->id;

            $product_array = [
                "name" => $product_dto->name,
                "short_description" => $product_dto->short_description,
                "description" => $product_dto->description,
                "quantity" => $product_dto->quantity,
                "price" => $product_dto->price,
                "tva_percentage" => $product_dto->tva_percentage,
                "user_id" => $current_user_id
            ];

            $product = $this->productRepository->create($product_array);
            $this->productRepository->createProductCategory($category_id, $product->id);

            return $product;
        });
    }

    public function update(ProductDto $product_dto, int $product_id)
    {
        $product_to_update = $this->productRepository->getById($product_id);
        if (!$product_to_update) {
            abort(404);
        }

        if (!Gate::allows("can-edit-product", $product_to_update)) {
            abort(403);
        }

        return $this->execute_in_transaction(function () use ($product_to_update, $product_dto) {
            $product_array = [
                "name" => $product_dto->name,
                "quantity" => $product_dto->quantity,
                "short_description" => $product_dto->short_description,
                "description" => $product_dto->description,
                "price" => $product_dto->price,
                "tva_percentage" => $product_dto->tva_percentage,
            ];

            return $this->productRepository->update($product_to_update->id, $product_array);
        });
    }

    public function changeQuantity(int $id, int $new_quantity): void
    {
        $product = $this->productRepository->getById($id);
        if (!$product) {
            abort(404);
        }

        if ($product->quantity - $new_quantity < 0) {
            abort(500);
        }

        $product = [...$product->toArray(), "quantity" => $new_quantity];

        $this->productRepository->update($id, $product);
    }
}
