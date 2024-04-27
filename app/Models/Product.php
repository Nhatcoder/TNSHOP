<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'product';

    static function getProduct()
    {
        return self::select('product.*', 'category.name as category_name', 'brand.name as brand_name', 'sub_category.name as sub_category_name')
            ->join('category', 'product.category_id', '=', 'category.id')
            ->join('brand', 'product.brand_id', '=', 'brand.id')
            ->leftJoin('sub_category', 'product.sub_category_id', '=', 'sub_category.id')
            ->where('product.status', 1)
            ->orDerBy('id', 'desc')->get();
    }

    public function productImage()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }
}
