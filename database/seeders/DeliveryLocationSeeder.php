<?php

namespace Database\Seeders;

use App\Models\DeliveryLocation;
use Illuminate\Database\Seeder;

class DeliveryLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DeliveryLocation::factory()->count(1000)->create();
    }
}
