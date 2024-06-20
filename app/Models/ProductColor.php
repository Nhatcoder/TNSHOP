<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductColor extends Model
{
    use HasFactory;
    public $table = 'product_color';
    public $timestamps = false;


    static function DeleteRecord($product_id)
    {
        return self::where('product_id', $product_id)->delete();
    }

    public function getColor()
    {
        return $this->belongsTo(Color::class, 'color_id');
    }

   
    
}
