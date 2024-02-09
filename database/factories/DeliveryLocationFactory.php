<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class DeliveryLocationFactory extends Factory
{
    public function definition(): array
    {
        return [
            'address_detail' => $this->faker->address(),
            'postal_code' => $this->faker->postcode(),
            'city_id' => City::all()->random()->id,
            'user_id' => User::all()->random()->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
