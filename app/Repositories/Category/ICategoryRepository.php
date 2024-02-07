<?php

namespace App\Repositories\Category;

use App\Repositories\Base\IBaseRepository;

interface ICategoryRepository extends IBaseRepository
{
    public function getCategories();
    public function getSubcategoriesByCategoryId($categoryId);
}
