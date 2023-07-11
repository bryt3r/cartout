<?php

namespace Database\Seeders;

use App\Models\ProductAttribute;
use App\Models\Sku;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SkuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'phones' => [
                'color' => ['pink', 'purple', 'blue'],
                'RAM' => ['4GB','8GB', '6GB'],
                'ROM' => ['16GB', '32GB', '64GB']
            ],
            'computers' => [
                'color' => ['silver', 'black', 'white'],
                'RAM' => ['16GB', '32GB', '64GB'],
                'Disk Size' => ['128GB', '256GB', '512GB']
            ],
            'clothing' => [
                'color' => ['red', 'green', 'yellow'],
                'size' => ['X', 'XL', 'XXL'],
            ],
            'shoes' => [
                'color'  => ['black', 'brown', 'gray'],
                'material'  => ['leather', 'cloth fabric', 'PU Leather'],
                'size' => ['33', '44', '55']
            ],
            'books' => [
                'pages'  => ['250', '350', '750'],
                'genre' => ['prose', 'fiction', 'comedy']
            ],
        ];

        for ($i = 0; $i < 40; $i++) {
            $sku = Sku::factory()->create();
            $category = $sku->product->product_category_name;
            // $category = $sku->product->product_category->pluck('name');
            // dd($sku->product->pluck('name'));
            // dd($category);
            $option_names = array_keys($categories[$category]);
            // $option_values = array_values($categories[$category]);
            // dd($option_names);
            foreach ($option_names as $name) {
                $attribute = ProductAttribute::where('name', $name)->select('id')->first();
                // echo $attribute->id;
                $sku->attributes()->attach($attribute->id, ['value' => $categories[$category][$name][rand(0,2)]]);
            }
            // $attribute = ProductAttribute::where('name', $category)->select(['id', 'product_category_id'])->first();
            // $sku->attributes()->attach($attribute->id, ['value' => $option_values[0][rand(0,2)]]);
        }
    }
}
