<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories_id = Category::inRandomOrder()->first()->id;

        return [
            'shop_id' => function () {
                return \App\Models\Shop::factory()->create()->id;
            },

            'name' => fake()->word,
            'price' => fake()->randomFloat(2, 0, 1000),
            'weight' => fake()->numberBetween(1, 100),
            'stock' => fake()->numberBetween(0, 100),
            'material' => fake()->randomElement(['Bois', 'Tissu', 'Verre', 'Métal', 'Pierre']),
            'history_anécdota' => fake()->sentence,
            'image_path' => fake()->imageUrl(),
            'description' => fake()->paragraph(3),
            'categories_id' => $categories_id,
            'user_id' => User::inRandomOrder()->first()->id,

        ];
    }
}
