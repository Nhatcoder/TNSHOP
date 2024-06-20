<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    protected $table = 'sub_category';

    static function getSubCategory()
    {
        return self::select('sub_category.*', 'category.name as category_name', 'sub_category.id as sub_id', 'sub_category.name as sub_name')
            ->join('category', 'category.id', '=', 'sub_category.category_id')
            ->get();
    }

    static function getSubCategoryId($id)
    {
        return self::select('sub_category.*', 'category.name as category_name', 'sub_category.id as sub_id', 'sub_category.name as sub_name')
            ->join('category', 'category.id', '=', 'sub_category.category_id')
            ->where('sub_category.id', $id)
            ->first();
    }


    static function getSubCategoryCategory_id($category_id)
    {
        return self::select('sub_category.*', 'category.name as category_name', 'sub_category.id as sub_id', 'sub_category.name as sub_name')
            ->join('category', 'category.id', '=', 'sub_category.category_id')
            ->where('sub_category.status', 1)
            ->where('sub_category.category_id', $category_id)
            ->get();
    }

    
  
}
