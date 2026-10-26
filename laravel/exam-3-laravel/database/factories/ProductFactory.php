<?php

namespace Database\Factories;

use App\Models\categories;
use App\Models\products;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<products>
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
            'category_id'   => categories::factory(),
            'name'          => fake()->words(3, true),
            'description'   => fake()->sentence(),
            'price'         => fake()->randomFloat(2, 10000, 10000000),
            'stock'         => fake()->numberBetween(0, 100),
            'image_url'     => null,
        ];
    }
}
