<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
        $categories = [
            'phones',
            'computers',
            'clothing',
            'shoes',
            'books',
        ];

        $name = fake()->sentence();

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => fake()->sentence(20),
            'brand' => fake()->word(),
            'model' => Str::random(5),
            'product_category_name' => $categories[rand(0,4)],
            'product_category_id' => rand(1,5),
        ];
    }
}
