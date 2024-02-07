<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get("/", [CategoryController::class, "index_category"])->name("home");

Route::controller(CategoryController::class)->prefix("category")->group(function () {
    Route::get("{id}", "show_subcategory")
        ->where("id", "\d+")
        ->name("category.show_subcategories");
});

Route::controller(ProductController::class)->group(function () {
    Route::get("/category/{id}/products", "index")
        ->where("id", "\d+")
        ->name("products.index");
});

