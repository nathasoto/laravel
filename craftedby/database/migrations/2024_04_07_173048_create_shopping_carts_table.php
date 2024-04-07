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
        Schema::create('shopping_carts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->timestamps();
            $table->unsignedInteger('quantity')->between(1, 10);// siempre valores positivos
            $table->decimal('unit_price', 10, 2);
            $table->string('color');
            $table->string('size');
            $table->string('status');
            $table->foreignUuId('product_id')->constrained('products')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shopping_carts');
    }
};
