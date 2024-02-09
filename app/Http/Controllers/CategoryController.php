<?php

namespace App\Http\Controllers;

use App\Repositories\Category\ICategoryRepository;

class CategoryController extends BaseController
{

    private ICategoryRepository $categoryRepository;

    public function __construct(ICategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index_category()
    {
        $categories = $this->categoryRepository->getCategories();

        return View("category")->with("categories", $categories)->with("subcategories");
    }

    public function show_subcategory(int $category_id)
    {
        $subcategories = $this->categoryRepository->getSubcategoriesByCategoryId($category_id);

        return View("category")
            ->with("subcategories", $subcategories)
            ->with("category_id", $category_id)
            ->with("categories");
    }
}
