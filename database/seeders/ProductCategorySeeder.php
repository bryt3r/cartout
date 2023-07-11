<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class ProductCategorySeeder extends Seeder
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
        foreach ($categories as $category) { 
            ProductCategory::factory()->create([
                'name' => $category,
                'slug' => Str::slug($category)
            ]);
        }
    }
}
