<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductCategory>
 */
class ProductCategoryFactory extends Factory
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
        $name = $categories[rand(0, 4)];
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => fake()->sentence(8)
        ];
    }
}
