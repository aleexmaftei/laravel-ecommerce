<?php

namespace App\Repositories\Product;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Repositories\Base\BaseRepository;
use Illuminate\Database\Eloquent\Collection;

class ProductRepository extends BaseRepository implements IProductRepository
{
    public function __construct(Product $model)
    {
        parent::__construct($model);
    }

    public function getProductsByCategoryId(int $categoryId): Collection|array
    {
        return $this->model::query()
            ->join("product_category", "product.id", "=", "product_category.product_id")
            ->where("product_category.category_id", "=", $categoryId)
            ->get();
    }

    public function createProductCategory(int $category_id, int $product_id)
    {
        return ProductCategory::create(["category_id" => $category_id, "product_id" => $product_id])->fresh();
    }
}
