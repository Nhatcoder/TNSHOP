<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        $orders = Order::getOrderAll();
        $orderRevenue = Order::oderRevenue();
        return view('admin.dashboard', compact('orders', "orderRevenue"));
    }

    public function chartSelected(Request $request)
    {
        if (!empty($request->day)) {
            $orders = Order::chartSelected($request->day);

            $doanhThu = [];
            $soLuongBanRa = [];
            $soDonHang = [];
            $ngayMua = [];

            foreach ($orders as $value) {
                $doanhThu[] = $value->total_price;
                $soDonHang[] = $value->order_count;
                $soLuongBanRa[] = $value->order_item_count;
                $ngayMua[] = $value->orderNow;
            }


            return response()->json([
                'doanhThu' => array_map('intval', $doanhThu),
                'soLuongBanRa' => array_map('intval', $soLuongBanRa),
                'soDonHang' => array_map('intval', $soDonHang),
                'ngayMua' => $ngayMua,
            ], 200);
        }
    }


    public function chartFromDate(Request $request)
    {
        if (!empty($request->from_date) && !empty($request->to_date)) {
            $orders = Order::chartFromToDate($request->from_date, $request->to_date);

            $doanhThu = [];
            $soLuongBanRa = [];
            $soDonHang = [];
            $ngayMua = [];

            foreach ($orders as $value) {
                $doanhThu[] = $value->total_price;
                $soDonHang[] = $value->order_count;
                $soLuongBanRa[] = $value->order_item_count;
                $ngayMua[] = $value->orderNow;
            }


            return response()->json([
                'doanhThu' => array_map('intval', $doanhThu),
                'soLuongBanRa' => array_map('intval', $soLuongBanRa),
                'soDonHang' => array_map('intval', $soDonHang),
                'ngayMua' => $ngayMua,
            ], 200);
        }
    }



}
