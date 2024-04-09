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
        // Retrieve a random category ID
        $categories_id = Category::inRandomOrder()->first()->id;

        return [
            // Generates a new shop ID using the Shop model factory
            'shop_id' => function () {
                return \App\Models\Shop::factory()->create()->id;
            },

            // Generates a fake
            'name' => fake()->word,
            'price' => fake()->randomFloat(2, 0, 1000),
            'weight' => fake()->numberBetween(1, 100),
            'stock' => fake()->numberBetween(0, 100),

            // Generates a random material from the provided list
            'material' => fake()->randomElement(['Bois', 'Tissu', 'Verre', 'Métal', 'Pierre']),
            'history_anécdota' => fake()->sentence,
            'image_path' => fake()->imageUrl(),
            'description' => fake()->paragraph(3),
            'categories_id' => $categories_id,

            // Assigns a random user ID from existing users
            'user_id' => User::inRandomOrder()->first()->id,

        ];
    }
}
