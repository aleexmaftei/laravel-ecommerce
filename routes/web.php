<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderPlacedController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::controller(CategoryController::class)->group(function () {
    Route::get("/", [CategoryController::class, "index_category"])->name("home");

    Route::get("category/{category_id}", "show_subcategory")
        ->where("category_id", "\d+")
        ->name("category.show_subcategories");
});

Route::controller(ProductController::class)->prefix("/category/{category_id}/products")->group(function () {
    Route::get("/", "index")
        ->where("category_id", "\d+")
        ->name("products.index");

    Route::get("/edit/{product_id}", "edit")
        ->where("category_id", "\d+")
        ->where("product_id", "\d+")
        ->name("products.edit");

    Route::put("/edit/{product_id}", "update")
        ->where("category_id", "\d+")
        ->where("product_id", "\d+")
        ->name("products.update");
});

Route::controller(OrderPlacedController::class)->middleware("auth")->group(function () {
   Route::post("/", "store")->name("place.order");
   Route::get("/checkout/product/{product_id}", "checkout")
       ->where("product_id", "\d+")
       ->name("order.checkout");
});

Route::controller(UserController::class)->group(function () {
    Route::get("/register", "create")
        ->name("user.create");

    Route::post("/register", "store")
        ->name("user.store");

    Route::get("/login", "login_index")
        ->name("user.login");

    Route::post("/login", "login")
        ->name("user.login");

    Route::post("/logout", "logout")
        ->name("user.logout")
        ->middleware("auth");
});

