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

    public static function reviewAll()
    {
        $statistics = DB::table('reviews')
            ->select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('SUM(CASE WHEN rating >= 3 THEN 1 ELSE 0 END) as positive_reviews'),
                DB::raw('SUM(CASE WHEN rating < 3 THEN 1 ELSE 0 END) as negative_reviews')
            )
            ->groupBy(DB::raw('DATE(created_at)'))
            ->get();

        return $statistics;
    }

    public static function reviewPositive()
    {
        return self::select(DB::raw('DATE(reviews.created_at) as reviewNow'), DB::raw('COUNT(reviews.id) as review_count'))
            ->where('rating', '>=', '3')
            ->groupBy(DB::raw('DATE(reviews.created_at)'))
            ->get();
    }
    public static function reviewNegative()
    {
        return self::select(DB::raw('DATE(reviews.created_at) as reviewNow'), DB::raw('COUNT(reviews.id) as review_count'))
            ->where('rating', '<', '3')
            ->get();
    }

}
