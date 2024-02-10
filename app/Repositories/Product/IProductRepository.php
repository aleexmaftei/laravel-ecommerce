<?php

namespace App\Repositories\Product;

use App\Repositories\Base\IBaseRepository;

interface IProductRepository extends IBaseRepository
{
    public function getProductsByCategoryId(int $categoryId);
}
