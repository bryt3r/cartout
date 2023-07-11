<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductAttribute>
 */
class ProductAttributeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $names = [
            'phones' => ['color', 'RAM', 'ROM'],
            'computers' => ['color', 'RAM', 'Disk Size'],
            'clothing' => ['color', 'size'],
            'shoes' => ['color', 'material', 'size'],
            'books' => ['pages', 'genre'],
        ];
        $name = array_keys($names)[rand(0, 3)];
        return [
            'name' =>  $names[$name][rand(0, 1)],
            'description' => fake()->sentence(6),
            'product_category_id' => rand(1, 5),
        ];
    }
}
