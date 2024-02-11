<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create("country", static function (Blueprint $table) {
            $table->id();
            $table->string("name", 100);
        });

        Schema::create("country_region", static function (Blueprint $table) {
            $table->id();
            $table->string("name", 100);
            $table->foreignId("country_id")
                ->references("id")
                ->on("country")
                ->cascadeOnDelete();
        });

        Schema::create("city", static function (Blueprint $table) {
            $table->id();
            $table->string("name", 100);
            $table->foreignId("country_region_id")
                ->references("id")
                ->on("country_region")
                ->cascadeOnDelete();
        });

        Schema::table("delivery_location", static function (Blueprint $table) {
            $table->foreignId("city_id")
                ->references("id")
                ->on("city")
                ->cascadeOnDelete();

            $table->dropColumn(["country_name", "region_name", "city_name"]);
        });
    }

    public function down(): void
    {
        DB::statement("SET FOREIGN_KEY_CHECKS = 0");

        Schema::dropIfExists("city");
        Schema::dropIfExists("country_region");
        Schema::dropIfExists("country");

        DB::statement("SET FOREIGN_KEY_CHECKS = 1");

        Schema::table("delivery_location", static function (Blueprint $table) {
            $table->dropConstrainedForeignId("city_id");

            $table->string("country_name", 60);
            $table->string("region_name", 100);
            $table->string("city_name", 100);
        });


    }
};
