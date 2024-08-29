<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sku;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productsGroup = Product::with([
            'skus' => ['productAttributes']
        ])
            ->get()
            ->groupBy('product_category_name');
        // dd($productsGroup);
        $data = [
            'products_group' => $productsGroup
        ];

        return view('products.products')->with($data);
    }


    public function skus()
    {
        return Sku::with('product', 'productAttributes')->get();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $category, string $slug)
    {
        // $product = Product::where('product_category_name', $category)
        //     ->where('slug', $slug)
        //     ->with([
        //         'skus' => ['productAttributes']
        //     ])
        //     ->first(['id', 'name', 'brand', 'model', 'product_category_id']);
        
        return view('products.product')->with(['category' => $category, 'slug' => $slug]);
    }

    //remember to check situation if two attributes have same value, like 6gb ram and 6gb rom/
    //so the query shouldnt pick 6gb from ram whereas the value was for rom

    private function filteredOptions($product, $selectedOptions)
    {
        $filtered = $product->skus()->whereHas('productAttributes', function (Builder $query) use ($selectedOptions) {
            // $query->where('product_attribute_sku.value', '8GB');
            // $query->where('product_attribute_sku.value', 'purple');
            // $query->where('product_attribute_sku.value', '64GB');
            $query->whereIn('product_attribute_sku.value', $selectedOptions);
        })->with('productAttributes')
            ->get();
        $filteredSku = $filtered->map(function ($sku) {
            return $sku->productAttributes->pluck('pivot.value', 'name');
        });
        return $filteredSku;
        // dd($filtmap);
    }


    private function getSku($product, $selectedOptions)
    {
        //    $selectedOptions = [
        //     'color' => 'pink',
        //     'RAM' => '8GB',
        //     'ROM' => '16GB'
        // ];

        $filtered = $product->skus();
        foreach ($selectedOptions as $attributeName => $value) {
            $filtered->whereHas('productAttributes', function ($query) use ($attributeName, $value) {
                $query->where('name', $attributeName)
                    ->where('product_attribute_sku.value', $value);
            });
        }

        $filtered = $filtered->with('product')->get();
        return $filtered;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
