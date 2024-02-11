<?php

namespace App\Repositories\Product;

use App\Repositories\Base\IBaseRepository;

interface IProductRepository extends IBaseRepository
{
    public function getProductsByCategoryId(int $categoryId);
    public function createProductCategory(int $category_id, int $product_id);
}
