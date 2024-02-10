<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductCategoryFactory extends Factory
{
    public function definition(): array
    {
        return [
            "product_id" => Product::all()->random()->first()->id,
            "category_id" => Category::all()->where("parent_category_id", "!=", null)->random()->first()->id,
        ];
    }
}
