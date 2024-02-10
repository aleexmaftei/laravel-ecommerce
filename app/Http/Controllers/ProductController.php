<?php

namespace App\Http\Controllers;

use App\DTOs\ProductDto;
use App\Http\Requests\ProductRequest;
use App\Repositories\Product\IProductRepository;
use App\Services\ProductService;
use Illuminate\Http\RedirectResponse;

class ProductController extends BaseController
{
    private IProductRepository $productRepository;
    private ProductService $productService;

    public function __construct(IProductRepository $productRepository, ProductService $productService)
    {
        $this->productRepository = $productRepository;
        $this->productService = $productService;
    }

    public function index(int $category_id)
    {
        $products = $this->productRepository->getProductsByCategoryId($category_id);
        return View("product.index")
            ->with("category_id", $category_id)
            ->with("products", $products);
    }

    public function create()
    {
        //
    }

    public function store(ProductRequest $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function edit(int $category_id, int $product_id)
    {
        $product = $this->productRepository->getById($product_id);

        return View("product.edit")
            ->with("category_id", $category_id)
            ->with("product", $product);
    }

    public function update(ProductRequest $request, int $category_id, int $product_id): RedirectResponse
    {
        $product_dto = ProductDto::create($request);

        $response = $this->productService->update($product_dto, $product_id);
        if (!$response) {
            abort(404);
        }

        return redirect()->route("products.index", [$category_id]);
    }

    public function destroy(string $id)
    {
        //
    }
}
