<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    // public $timestamps = false;
    protected $table = "brand";

    static function getbrand()
    {
        return self::select('brand.*')->where('status', 1)->orderBy('id', 'desc')->get();
    }
}
