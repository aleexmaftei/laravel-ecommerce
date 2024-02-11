<?php

namespace App\Http\Controllers;

use App\DTOs\Product\ProductDto;
use App\DTOs\Product\StoreProductDto;
use App\Http\Requests\Product\ProductRequest;
use App\Http\Requests\Product\StoreProductRequest;
use App\Repositories\Product\IProductRepository;
use App\Services\ProductService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;

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

    public function create(int $category_id)
    {
        return View("product.create")
            ->with("category_id", $category_id);
    }

    public function store(StoreProductRequest $storeProductRequest, int $category_id): RedirectResponse
    {
        $storeProductDto = StoreProductDto::create($storeProductRequest);

        $response = $this->productService->store($storeProductDto, $category_id);
        if (!$response) {
            abort(404);
        }

        return redirect()->route("products.index", [$category_id]);
    }

    public function edit(int $category_id, int $product_id)
    {
        $product = $this->productRepository->getById($product_id);
        if (!$product) {
            abort(404);
        }

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

    public function destroy(int $product_id): RedirectResponse
    {
        if (!Gate::allows("can-delete-product")) {
            abort(403);
        }

        $product = $this->productRepository->getById($product_id);
        if (!$product) {
            abort(404);
        }

        $is_deleted = $this->productRepository->delete($product);
        if(!$is_deleted) {
            abort(500);
        }

        return Redirect::back();
    }
}
