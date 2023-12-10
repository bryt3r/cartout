<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function product_category()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    function skus() {
        return $this->hasMany(Sku::class);
    }

    public function attributes() {
        return $this->product_category->product_attributes;
    }
}
