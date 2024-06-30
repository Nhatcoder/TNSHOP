<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $table = 'reviews';

    public static function seeReviewDetailProduct($id)
    {
        return self::seclect(
            "reviews.*",
            'users.avatar',
            'users.name as user_name',
        )
            ->join('users', 'users.id', '=', 'reviews.user_id')
            ->where("id", $id)
            ->get();
    }


}
