<?php

// namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;

// class Color extends Model
// {
//     use HasFactory;
//     protected $table = 'color';

//     static function getColor()
//     {
//         return self::select('color.*')->where('status', 1)->orderBy('id', 'desc')->get();
//     }


//     static function getColorActive()
//     {
//         return self::select('color.*')->where('status', 1)->orderBy('id', 'desc')->get();
//     }

//     public function getColorProductCart($color_id)
//     {
//         return self::select('color.*')->where('color_id', $color_id)->where('status', 1)->first();
//     }

// }
