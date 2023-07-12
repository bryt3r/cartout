<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'phones',
            'computers',
            'clothing',
            'shoes',
            'books',
        ];
       
        for ($i=0; $i < 20; $i++) {
            $cat_name = $categories[rand(0,4)];
            Product::factory()->create([
                'product_category_name' => $cat_name,
                'product_category_id' => array_search($cat_name, $categories) + 1,
                ]
            );
       }
 
    }
}
