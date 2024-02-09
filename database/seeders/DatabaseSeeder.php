<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Production seed
        $this->call(RoleSeeder::class);
        $this->call(CountrySeeder::class);
        $this->call(CountryRegionSeeder::class);
        $this->call(CitySeeder::class);

        // Dev seed
        if (app()->environment() === "local") {
            $this->call(CategorySeeder::class);
            $this->call(UserSeeder::class);
            $this->call(DeliveryLocationSeeder::class);
            $this->call(ProductSeeder::class);
        }
    }
}
