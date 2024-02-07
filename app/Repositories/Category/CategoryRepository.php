<?php

namespace App\Repositories\Category;

use App\Models\Category;
use App\Repositories\Base\BaseRepository;
use Illuminate\Database\Eloquent\Collection;

class CategoryRepository extends BaseRepository implements ICategoryRepository
{
    public function __construct(Category $model)
    {
        parent::__construct($model);
    }

    public function getCategories(): Collection|array
    {
        return $this->model::query()->where("parent_category_id", null)->get();
    }

    public function getSubcategoriesByCategoryId($categoryId): Collection|array
    {
        return $this->model::query()->where("parent_category_id", $categoryId)->get();
    }
}
