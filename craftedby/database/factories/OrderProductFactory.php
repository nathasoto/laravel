<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderProduct>
 */
class OrderProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'quantity' => fake()->numberBetween(1, 10),
            'unit_price' => fake()->randomFloat(2, 10, 100),
            'color' => fake()->safeColorName,
            'size' => fake()->randomElement(['Small', 'Medium', 'Large']),
            'product_id' => Product::inRandomOrder()->first(),
            'order_id' => Order::inRandomOrder()->first()
        ];
    }
}
