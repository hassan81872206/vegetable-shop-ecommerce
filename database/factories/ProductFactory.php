<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\odel=Product>
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
        return [
            'productName' => fake()->word,
            'price' => fake()->randomFloat(2, 1, 100),
            'categorieID' =>fake()->numberBetween(25,34),
            'created_at' => now(),
            'updated_at' => now(),
            'supplierID' => fake()->numberBetween(1,7),
            'inventoryID' => fake()->numberBetween(1,13),
            'image' => 'default.PNG',
            // 'promotionID' => \App\Models\Promotion::factory(),
            'description' => fake()->paragraph,
        ];
    }
}
