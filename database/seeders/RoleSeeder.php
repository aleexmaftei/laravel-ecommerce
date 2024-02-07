<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        DB::table("role")->insert([
            "id" => 1,
            "name" => "Admin"
        ]);

        DB::table("role")->insert([
            "id" => 2,
            "name" => "User"
        ]);
    }
}
