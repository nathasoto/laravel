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
        Schema::create('order_details', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->timestamps();
            $table->unsignedInteger('quantity')->between(1, 10);// siempre valores positivos
            $table->decimal('unit_price', 10, 2);
            $table->string('color');
            $table->string('size');
            $table->foreignUuId('order_id')->constrained('orders')->onDelete('cascade');
            $table->foreignUuId('product_id')->constrained('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
