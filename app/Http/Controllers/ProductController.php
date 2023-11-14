<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sku;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productsGroup = Product::with([
            'skus' => ['attributes']
        ])->get()->groupBy('product_category_name');
        // dd($productsGroup);
        $data = [
            'products_group' => $productsGroup
        ];

        
        return view('products.products')->with($data);
    }


    public function skus()
    {
        return Sku::with('product', 'attributes')->get();
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
        return Product::where('product_category_name', $category)
            ->where('slug', $slug)
            ->with([
                'skus' => ['attributes']
            ])
            ->get();
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
