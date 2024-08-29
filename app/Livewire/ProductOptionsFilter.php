<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Attributes\Computed;
use Livewire\Component;

class ProductOptionsFilter extends Component
{
    public string $category;
    public string $slug;
    public array $selectedOptions = [];
    public $attributeOptions;
    public $attributeNames;

    // public Product $product;

    #[Computed]
    public function product()
    {
        return Product::where('product_category_name', $this->category)
            ->where('slug', $this->slug)
            ->with([
                'skus' => ['productAttributes']
            ])
            ->first(['id', 'name', 'brand', 'model', 'description', 'product_category_id']);;
    }

    public function render()
    {
        $product = $this->product;
        $selectedOptions = $this->selectedOptions;

        $productAttributeNames = $product->attributes()->pluck('name');
        $noOfAttributes = count($productAttributeNames);
        $options = collect([]);

        if (count($selectedOptions) < 1) {
            $options = $product->skus->map(function ($sku) {
                return $sku->productAttributes->pluck('pivot.value', 'name');
            });
        }

        if ((count($selectedOptions) > 0) && (count($selectedOptions) < $noOfAttributes)) {
            $options = $this->filteredOptions($this->product, array_values($selectedOptions));
        }


        //to get sku that has all selected attribute options
        if (count($selectedOptions) == $noOfAttributes) {
            $options = $this->getSku($product, $selectedOptions);
        }

        // cater for empty options
        if (count($options??[]) < 1) {
            $options =  $productAttributeNames->map(function ($attribute) {
                return [$attribute => ''];
            });
        }

        $this->attributeOptions = array_merge_recursive(...$options->toArray());
        $this->attributeNames = $product->attributes()->pluck('name');

        return view('livewire.product-options-filter');
    }


    public function resetOptions() {
        $this->selectedOptions = [];
    }


    public function updateSelectedOptions($attributeName, $value)
    {
        $this->selectedOptions[$attributeName] = $value;
        $this->attributeOptions = $this->filteredOptions($this->product, array_values($this->selectedOptions));
        // dd($this->attributeOptions);
        // dd(array_values($this->selectedOptions));
    }


    private function filteredOptions($product, $selectedOptionValues)
    {
        $filtered = $product->skus()->whereHas('productAttributes', function ($query) use ($selectedOptionValues) {
            $query->whereIn('product_attribute_sku.value', $selectedOptionValues);
        })
        ->with('productAttributes')
        ->get();

        $filteredSku = $filtered->map(function ($sku) {
            return $sku->productAttributes->pluck('pivot.value', 'name');
        });
        // $this->attributeOptions = array_merge_recursive(...$filteredSku->toArray());
        return $filteredSku;
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
}
