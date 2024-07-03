<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ColorImage extends Model
{
    use HasFactory;
    protected $table = 'color_image';
    protected $fillable = ['product_id', 'color_name', 'image_name'];
    public $timestamps = false;


    public function checkImage()
    {
        if (!empty($this->image_name) && file_exists('uploads/product/' . $this->image_name)) {
            return asset('uploads/product/' . $this->image_name);
        } else {
            return "";
        }
    }

    public static function DeleteRecord($product_id)
    {
        return self::where('product_id', $product_id)->delete();
    }
}
