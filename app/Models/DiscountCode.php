<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountCode extends Model
{
    use HasFactory;
    protected $table = 'discount_code';


    static public function getRecord()
    {
        return self::where('status', 1)->orderBy('id', 'desc')->paginate(20);
    }

    static public function checkDiscount($discountCode)
    {
        return self::where('name_code', $discountCode)
        ->where('expire_date', '>=', date('Y-m-d'))
        ->where('status', 1)
        ->first();
    }

    
}
