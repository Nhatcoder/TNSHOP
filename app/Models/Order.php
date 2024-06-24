<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';


    public static function getOrderAll()
    {
        return self::orderBy('status', 'asc')
            ->orderBy('id', 'desc')
            ->get();
    }

    public static function getOrderConfirm()
    {
        return self::where("status", "1")
            ->where("user_id", auth()->user()->id)
            ->orderBy('id', 'desc')
            ->get();
    }
    public static function getOrderTransport()
    {
        return self::where("status", "2")
            ->where("user_id", auth()->user()->id)
            ->orderBy('id', 'desc')
            ->get();
    }
    public static function getOrderWaiting()
    {
        return self::where("status", "3")
            ->where("user_id", auth()->user()->id)
            ->orderBy('id', 'desc')
            ->get();
    }
    public static function getOrderSuccess()
    {
        return self::where("status", "4")
            ->where("user_id", auth()->user()->id)
            ->orderBy('id', 'desc')
            ->get();
    }
    public static function getOrderCancelled()
    {
        return self::where("status", "5")
            ->where("user_id", auth()->user()->id)
            ->orderBy('id', 'desc')
            ->get();
    }
    public static function getOrderRefunds()
    {
        return self::where("status", "6")
            ->where("user_id", auth()->user()->id)
            ->orderBy('id', 'desc')
            ->get();
    }
    public static function getOrder()
    {
        return self::where("user_id", auth()->user()->id)
            ->orderBy('status', 'asc')
            ->orderBy('id', 'desc')
            ->get();
    }
    public static function searchOrder($kw)
    {
        return self::where("user_id", auth()->user()->id)
            ->orderBy('status', 'asc')
            ->orderBy('id', 'desc')
            ->where('code_order', 'like', '%' . $kw . '%')
            ->first();
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
            ->where('order_items.order_id', $order_id)
            ->where('orders.user_id', auth()->user()->id)
            ->orderBy('orders.id', 'desc')
            ->get();
    }
}
