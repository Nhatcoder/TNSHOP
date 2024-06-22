<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';


    public static function getOrderConfirm()
    {
        return self::where("status", "1")
            ->where("user_id", auth()->user()->id)
            ->orderBy('id', 'desc')
            ->get();
    }


    public static function getOrderDetail($order_id)
    {
        return self::select(
            'orders.*',
            'order_items.order_id',
            'order_items.product_id',
            'order_items.quantity',
            'order_items.price',
            'order_items.size_name',
            'order_items.color_name',
            'order_items.size_amount',
            'order_items.total_price',
            'order_items.id AS order_items_id'
        )
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->where('orders.status', 1)
            ->where('order_items.order_id', $order_id)
            ->where('orders.user_id', auth()->user()->id)
            ->orderBy('orders.id', 'desc')
            ->get();
    }
}
