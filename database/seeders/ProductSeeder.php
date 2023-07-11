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
       
        for ($i=0; $i < 5; $i++) { 
            Product::factory()->create([
                'product_category_name' => $categories[$i],
                'product_category_id' => $i + 1,
                ]
            );
       }
        for ($i=0; $i < 5; $i++) { 
            Product::factory()->create([
                'product_category_name' => $categories[$i],
                'product_category_id' => $i + 1,
                ]
            );
       }
        for ($i=0; $i < 5; $i++) { 
            Product::factory()->create([
                'product_category_name' => $categories[$i],
                'product_category_id' => $i + 1,
                ]
            );
       }
        for ($i=0; $i < 5; $i++) { 
            Product::factory()->create([
                'product_category_name' => $categories[$i],
                'product_category_id' => $i + 1,
                ]
            );
       }
        // Product::factory(20)->create();
    }
}
