<?php

namespace Database\Seeders;

use App\Models\ProductAttribute;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductAttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'phones' => ['color', 'RAM', 'ROM'],
            'computers' => ['color', 'RAM', 'Disk Size'],
            'clothing' => ['color', 'size'],
            'shoes' => ['color', 'material', 'size'],
            'books' => ['pages', 'genre'],
        ];

        $i = 1;
        foreach (array_values($categories) as $attribute_array) {
            foreach ($attribute_array as $attribute_name) {
                ProductAttribute::factory()->create(
                    [
                        'name' => $attribute_name,
                        'product_category_id' => $i,
                    ]
                );
            }
            $i++;
        }
    }
}
