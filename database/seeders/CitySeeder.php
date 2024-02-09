<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // TODO: csv read
        DB::table("city")->insert([
            "id" => 1,
            "name" => "Bucureşti",
            "country_region_id" => 1
        ]);
        DB::table("city")->insert([
            "id" => 2,
            "name" => "Cluj-Napoca",
            "country_region_id" => 2
        ]);
        DB::table("city")->insert([
            "id" => 3,
            "name" => "Braşov",
            "country_region_id" => 3
        ]);
        DB::table("city")->insert([
            "id" => 4,
            "name" => "Iaşi",
            "country_region_id" => 4
        ]);
        DB::table("city")->insert([
            "id" => 5,
            "name" => "Constanţa",
            "country_region_id" => 5
        ]);
        DB::table("city")->insert([
            "id" => 6,
            "name" => "Craiova",
            "country_region_id" => 6
        ]);
        DB::table("city")->insert([
            "id" => 7,
            "name" => "Galaţi",
            "country_region_id" => 7
        ]);

    }
}
