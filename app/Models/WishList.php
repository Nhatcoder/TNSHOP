<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WishList extends Model
{
    use HasFactory;
    protected $table = 'wishlist';

    static function singleImage($product_id)
    {
        return ProductImage::where('product_id', $product_id)->orderBy("order_by", "ASC")->first();
    }

    public static function wishlistAll(){

        return self::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
    }

    public function product()
    {
        return self::belongsTo(Product::class, 'product_id');
    }





}
