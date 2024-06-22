<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class Product extends Model
{
    use HasFactory;
    protected $table = 'product';

    public static function getProduct()
    {
        return self::select('product.*', 'category.name as category_name', 'brand.name as brand_name', 'sub_category.name as sub_category_name')
            ->join('category', 'product.category_id', '=', 'category.id')
            ->join('brand', 'product.brand_id', '=', 'brand.id')
            ->leftJoin('sub_category', 'product.sub_category_id', '=', 'sub_category.id')
            ->where('product.status', 1)
            ->orDerBy('id', 'desc')
            ->paginate(8);
    }
    public static function productAll()
    {
        return self::select('product.*', 'category.name as category_name', 'brand.name as brand_name', 'sub_category.name as sub_category_name')
            ->join('category', 'product.category_id', '=', 'category.id')
            ->join('brand', 'product.brand_id', '=', 'brand.id')
            ->leftJoin('sub_category', 'product.sub_category_id', '=', 'sub_category.id')
            ->where('product.status', 1)
            ->orDerBy('id', 'desc')
            ->get();
    }
    public static function seeMoreProductHome($limit)
    {
        return self::select('product.*', 'category.name as category_name', 'brand.name as brand_name', 'sub_category.name as sub_category_name')
            ->join('category', 'product.category_id', '=', 'category.id')
            ->join('brand', 'product.brand_id', '=', 'brand.id')
            ->leftJoin('sub_category', 'product.sub_category_id', '=', 'sub_category.id')
            ->where('product.status', 1)
            ->orDerBy('id', 'desc')
            ->limit($limit)
            ->get();
    }

    public static  function getProductSingle($id)
    {
        return self::where('id', $id)->where("status", "1")->first();
    }

    static function productDetailBySlug($slug)
    {
        return self::where('slug', $slug)->where("status", "1")->where('is_delete', 1)->first();
    }

    public static function getAllProductByCategoryId($category_id = "")
    {
        $return = Product::select('product.*', 'category.name as category_name', 'category.slug as category_slug', 'brand.name as brand_name', 'sub_category.name as sub_category_name', 'sub_category.slug as sub_category_slug')
            ->join('category', 'product.category_id', '=', 'category.id')
            ->join('brand', 'product.brand_id', '=', 'brand.id')
            ->leftJoin('sub_category', 'product.sub_category_id', '=', 'sub_category.id');
        if (!empty($category_id)) {
            $return = $return->where('product.category_id', $category_id);
        }

        $return = $return->where('product.status', 1)
            ->groupBy('product.id')
            ->orderBy('product.id', 'desc')
            ->get();
        return $return;
    }

    static function getProductCategoryById($category_id = "", $limit = "")
    {
        $return = Product::select('product.*', 'category.name as category_name', 'category.slug as category_slug', 'brand.name as brand_name', 'sub_category.name as sub_category_name', 'sub_category.slug as sub_category_slug')
            ->join('category', 'product.category_id', '=', 'category.id')
            ->join('brand', 'product.brand_id', '=', 'brand.id')
            ->leftJoin('sub_category', 'product.sub_category_id', '=', 'sub_category.id');
        if (!empty($category_id)) {
            $return = $return->where('product.category_id', $category_id);
        }

        $return = $return->where('product.status', 1)
            ->groupBy('product.id')
            ->orderBy('product.id', 'desc');

        if (!empty($limit)) {
            $return = $return->limit($limit)
                ->get();
        }
        return $return;
    }



    static function getProductBySlug($category_id = "", $subcategory_id = "")
    {
        $return = Product::select('product.*', 'category.name as category_name', 'category.slug as category_slug', 'brand.name as brand_name', 'sub_category.name as sub_category_name', 'sub_category.slug as sub_category_slug')
            ->join('category', 'product.category_id', '=', 'category.id')
            ->join('brand', 'product.brand_id', '=', 'brand.id')
            ->leftJoin('sub_category', 'product.sub_category_id', '=', 'sub_category.id');
        if (!empty($category_id)) {
            $return = $return->where('product.category_id', $category_id);
        }
        if (!empty($subcategory_id)) {
            $return = $return->where('product.sub_category_id', $subcategory_id);
        }


        // ajax
        if (!empty(Request::get('category_id'))) {
            $category_id = rtrim(Request::get('category_id'), ',');
            $category_id_array = explode(',', $category_id);

            $return = $return->whereIn('product.category_id', $category_id_array);
        }

        if (!empty(Request::get('sub_category_id'))) {
            $sub_category_id = rtrim(Request::get('sub_category_id'), ',');
            $sub_category_id_array = explode(',', $sub_category_id);

            $return = $return->whereIn('product.sub_category_id', $sub_category_id_array);
        }
        if (!empty(Request::get('color_id'))) {
            $color_id = rtrim(Request::get('color_id'), ',');
            $color_id_array = explode(',', $color_id);

            $return = $return->join('product_color', 'product_color.product_id', '=', 'product.id');
            $return = $return->whereIn('product_color.color_id', $color_id_array);
        }
        if (!empty(Request::get('brand_id'))) {
            $brand_id = rtrim(Request::get('brand_id'), ',');
            $brand_id_array = explode(',', $brand_id);
            $return = $return->whereIn('product.brand_id', $brand_id_array);
        }

        if (!empty(Request::get('price_start')) && !empty(Request::get('price_end'))) {
            $price_start = Request::get('price_start');
            $price_end = Request::get('price_end');

            $return = $return->where('product.price', '>=', $price_start);
            $return = $return->where('product.price', '<=', $price_end);
        }

        if (!empty(Request::get('kw'))) {
            $return = $return->where('product.title', 'like', '%' . Request::get('kw') . '%');
        }

        $return = $return->where('product.status', 1)
            ->groupBy('product.id')
            ->orderBy('product.id', 'desc')
            ->paginate(9);
        return $return;
    }

    static public function getRelatedProduct($product_id, $category_id)
    {
        $return = Product::select('product.*', 'category.name as category_name', 'category.slug as category_slug', 'brand.name as brand_name', 'sub_category.name as sub_category_name', 'sub_category.slug as sub_category_slug')
            ->join('category', 'product.category_id', '=', 'category.id')
            ->join('brand', 'product.brand_id', '=', 'brand.id')
            ->leftJoin('sub_category', 'product.sub_category_id', '=', 'sub_category.id')
            ->where('product.id', "<>", $product_id)
            ->where('product.category_id', "=", $category_id)
            ->where('product.status', 1)
            ->orderBy('product.id', 'desc')
            ->limit(10)
            ->get();
        return $return;
    }

    static function singleImage($product_id)
    {
        return ProductImage::where('product_id', $product_id)->orderBy("order_by", "ASC")->first();
    }
    static function limitImage($product_id)
    {
        return ProductImage::where('product_id', $product_id)->orderBy("order_by", "ASC")->limit(2)->get();
    }

    public function productImage()
    {
        return $this->hasMany(ProductImage::class, 'product_id')->orderBy('order_by', 'ASC');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id')->where("status", 1);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id')->where("status", 1);
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id')->where("status", 1);
    }

    public function color()
    {
        return $this->hasMany(ProductColor::class, 'product_id');
    }

    public function sizes()
    {
        return $this->hasMany(ProductSize::class, 'product_id');
    }
}
