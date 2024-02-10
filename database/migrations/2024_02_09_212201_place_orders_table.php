<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_placed', static function (Blueprint $table) {
            $table->id();
            $table->integer("order_quantity");

            $table->foreignId("product_id")
                ->nullable()
                ->references("id")
                ->on("product")
                ->nullOnDelete();
            $table->foreignId("buyer_user_id")
                ->references("id")
                ->on("user")
                ->noActionOnDelete();
            $table->foreignId("seller_user_id")
                ->references("id")
                ->on("user")
                ->noActionOnDelete();
            $table->foreignId("delivery_location_id")
                ->references("id")
                ->on("delivery_location")
                ->noActionOnDelete();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("place_order");
    }
};
