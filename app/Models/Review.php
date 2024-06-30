<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Review extends Model
{
    use HasFactory;

    protected $table = 'reviews';

    public static function seeReviewDetailProduct($id)
    {
        return DB::table('reviews')
            ->select(
                'reviews.*',
                'users.avatar',
                'users.name as user_name',
            )
            ->join('users', 'users.id', '=', 'reviews.user_id')
            ->where("reviews.id", $id)
            ->first();
    }

    public static function seeReviewDetailOrder($id)
    {
        return DB::table('reviews')
            ->select(
                'reviews.id',
                'order_items.product_id',
                'order_items.color_name',
                'order_items.size_name',
            )
            ->join('order_items', 'order_items.order_id', '=', 'reviews.order_id')
            ->where("reviews.id", $id)
            ->get();
    }


}
