<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create("role", static function (Blueprint $table) {
            $table->id();
            $table->enum("name", ["Admin", "User"]);
        });

        Schema::create("user", static function (Blueprint $table) {
            $table->id();
            $table->foreignId("role_id")
                ->references("id")
                ->on("role")
                ->restrictOnDelete();
            $table->string("email", 100)->unique();
            $table->string("first_name", 100);
            $table->string("last_name", 100);
            $table->string("password");
            $table->dateTime("email_verified_at")->nullable();
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create("category", static function (Blueprint $table) {
            $table->id();
            $table->string("name", 100);
            $table->foreignId("parent_category_id")
                ->nullable()
                ->references("id")
                ->on("category")
                ->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create("product", static function (Blueprint $table) {
            $table->id();
            $table->string("name", 150);
            $table->binary("image")->nullable();
            $table->unsignedInteger("quantity")->default(0);
            $table->unsignedInteger("price");
            $table->unsignedSmallInteger("tva_percentage");
            $table->timestamps();
            $table->softDeletes();
        });

        DB::statement("
            ALTER TABLE product
            ADD CONSTRAINT CHECK_product_tva_percentage
            CHECK (tva_percentage <= 100)"
        );

        Schema::create("product_category", static function (Blueprint $table) {
            $table->id();
            $table->foreignId("category_id")
                ->references("id")
                ->on("category")
                ->cascadeOnDelete();
            $table->foreignId("product_id")
                ->references("id")
                ->on("product")
                ->cascadeOnDelete();
        });

        Schema::create("delivery_location", static function (Blueprint $table) {
            $table->id();
            $table->string("country_name", 60);
            $table->string("region_name", 100);
            $table->string("city_name", 100);
            $table->string("address_detail", 255);
            $table->string("postal_code", 100);
            $table->timestamps();
            $table->foreignId("user_id")
                ->references("id")
                ->on("user")
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        DB::statement("SET FOREIGN_KEY_CHECKS = 0");

        Schema::dropIfExists("user");
        Schema::dropIfExists("role");
        Schema::dropIfExists("delivery_location");
        Schema::dropIfExists("product_category");
        Schema::dropIfExists("category");
        Schema::dropIfExists("product");

        DB::statement("SET FOREIGN_KEY_CHECKS = 1");
    }
};
