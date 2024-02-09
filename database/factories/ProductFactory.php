<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->text(30),
            'image' => $this->faker->imageUrl(),
            'quantity' => $this->faker->numberBetween(0, 1000),
            'price' => $this->faker->randomNumber(5),
            'tva_percentage' => $this->faker->numberBetween(0, 100),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
