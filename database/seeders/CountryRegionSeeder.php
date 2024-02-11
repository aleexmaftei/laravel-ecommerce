<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountryRegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // TODO: csv read
        DB::table("country_region")->insert([
            "id" => 1,
            "name" => "Bucureşti",
            "country_id" => 1
        ]);
        DB::table("country_region")->insert([
            "id" => 2,
            "name" => "Cluj",
            "country_id" => 1
        ]);
        DB::table("country_region")->insert([
            "id" => 3,
            "name" => "Timiş",
            "country_id" => 1
        ]);
        DB::table("country_region")->insert([
            "id" => 4,
            "name" => "Iaşi",
            "country_id" => 1
        ]);
        DB::table("country_region")->insert([
            "id" => 5,
            "name" => "Constanţa",
            "country_id" => 1
        ]);
        DB::table("country_region")->insert([
            "id" => 6,
            "name" => "Dolj",
            "country_id" => 1
        ]);
        DB::table("country_region")->insert([
            "id" => 7,
            "name" => "Galaţi",
            "country_id" => 1
        ]);
    }
}
