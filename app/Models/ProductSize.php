<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSize extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'product_size';

    static function DeleteRecord($product_id)
    {
        return self::where('product_id', $product_id)->delete();
    }

}
