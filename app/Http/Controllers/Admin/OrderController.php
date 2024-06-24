<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orderAll = Order::getOrderAll();
        return view('admin.order.list_all', compact('orderAll'));
    }

    public function adminOrderDetail(Request $request)
    {
        if (!empty($request->id)) {
            $order = Order::find($request->id);
            $orderDetail = Order::getOrderDetail($request->id);
            // return response()->json($orderDetail);

            return response()->json([
                'view' => view('admin.order.render_order_detail', compact('order','orderDetail'))->render(),
            ]);
        }
    }

}
