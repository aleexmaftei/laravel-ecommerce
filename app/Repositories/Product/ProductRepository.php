<?php

namespace App\Repositories\Product;

use App\Models\Product;
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
}
