<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;


    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function product_attributes()
    {
        return $this->hasMany(ProductAttribute::class);
    }
}
