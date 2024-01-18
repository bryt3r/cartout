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
        $selectedOptions = ['purple','32GB'];

        $product = Product::where('product_category_name', $category)
            ->where('slug', $slug)
            ->with([
                'skus' => ['productAttributes']
            ])
            ->first();

        $productAttributeNames = $product->attributes()->pluck('name');
        $noOfAttributes = count($productAttributeNames);
        $options = collect([]);

        if (count($selectedOptions) < 1) {
            $options = $product->skus->map(function ($sku) {
                return $sku->productAttributes->pluck('pivot.value', 'name');
            });
        }
        if ((count($selectedOptions) > 0) && (count($selectedOptions) < $noOfAttributes)) {
            $options = $this->filteredOptions($product, $selectedOptions);
        }
        if (count($selectedOptions) == $noOfAttributes) {

            // $raw = DB::table('skus')
        //     ->select(DB::raw("skus.sku,skus.product_id,
        // GROUP_CONCAT(product_attributes.name SEPARATOR ';') AS attribute_names, 
        // GROUP_CONCAT(product_attribute_sku.value SEPARATOR ';') AS attribute_values"))
        //     ->join('product_attribute_sku', 'skus.id', '=', 'product_attribute_sku.sku_id')
        //     ->join('product_attributes', 'product_attributes.id', '=', 'product_attribute_sku.product_attribute_id')
        //     ->groupByRaw('skus.sku,skus.product_id')
        //     ->get();

        // dd($raw[0]);

            //compare and get the specific sku

            //    return in_array([
            //         "color" => "blue",
            //         "RAM" => "4GB",
            //         "ROM" => "64GB"
            //     ], $options->toArray());
        }

        if (count($options) < 1) {
            $options =  $productAttributeNames->map(function ($attribute) {
                return [$attribute => ''];
            });
        }

        // dd($options->toArray());
        $attributeOptions = array_merge_recursive(...$options->toArray());
        // dd($attributeOptions);
        // return $product->skus;
        $data = [
            'product' => $product,
            'attributeOptions' => $attributeOptions
        ];
        return view('products.product')->with($data);
    }


    private function filteredOptions($product, $selectedOptions)
    {
        $filtered = $product->skus()->whereHas('productAttributes', function (Builder $query) use ($selectedOptions) {
            // $query->where('product_attribute_sku.value', '8GB');
            // $query->where('product_attribute_sku.value', 'purple');
            // $query->where('product_attribute_sku.value', '64GB');
            $query->whereIn('product_attribute_sku.value', $selectedOptions);
        })->with('productAttributes')
            ->get();
        $filtmap = $filtered->map(function ($sku) {
            return $sku->productAttributes->pluck('pivot.value', 'name');
        });
        return $filtmap;
        // dd($filtmap);
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
