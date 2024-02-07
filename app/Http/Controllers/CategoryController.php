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

        return View("home")->with("categories", $categories)->with("subcategories");
    }

    public function show_subcategory(int $id)
    {
        $subcategories = $this->categoryRepository->getSubcategoriesByCategoryId($id);

        return View("home")->with("subcategories", $subcategories)->with("categories");
    }
}
