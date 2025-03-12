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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id('orderItemID');
            $table->float("price", 8);
            $table->unsignedSmallInteger("quantite");
            $table->foreignId("orderID")->constrained("orders")->references("orderID");
            $table->foreignId("productID")->constrained("products")->references("productID");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
