<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'product_image';

    public function checkImage()
    {
        if (!empty($this->image_name) && file_exists('uploads/product/' . $this->image_name)) {
            return asset('uploads/product/' . $this->image_name);
        } else {
            return "";
        }
    }
}
