<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;



Route::controller(CategoryController::class)->group(function () {
    Route::get("/", [CategoryController::class, "index_category"])->name("home");

    Route::get("category/{category_id}", "show_subcategory")
        ->where("category_id", "\d+")
        ->name("category.show_subcategories");
});

Route::controller(ProductController::class)->group(function () {
    Route::get("/category/{category_id}/products", "index")
        ->where("category_id", "\d+")
        ->name("products.index");

    Route::get("/category/{category_id}/products/edit/{product_id}", "edit")
        ->where("category_id", "\d+")
        ->where("product_id", "\d+")
        ->name("products.edit");

    Route::put("/category/{category_id}/products/edit/{product_id}", "update")
        ->where("category_id", "\d+")
        ->where("product_id", "\d+")
        ->name("products.update");
});

