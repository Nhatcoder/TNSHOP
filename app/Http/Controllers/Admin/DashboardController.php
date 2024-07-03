<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Review;

class DashboardController extends Controller
{
    public function index()
    {
        $orders = Order::select("status", "total_price")->get();
        $orderRevenue = Order::oderRevenue();
        $reviewPositive = Review::reviewPositive();
        $reviewNegative = Review::reviewNegative();

        $reviewAll = Review::reviewAll();

        $totalPositive = 0;
        $totalNegative = 0;

        foreach ($reviewAll as $value) {
            $totalPositive += $value->positive_reviews;
            $totalNegative += $value->negative_reviews;
        }

        return view('admin.dashboard', compact('orders', "orderRevenue", "totalPositive", "totalNegative"));
    }

    public function chartReview()
    {

        $reviewAll = Review::reviewAll();

        $positive = [];
        $negative = [];
        $category = [];

        $totalPositive = 0;
        $totalNegative = 0;

        foreach ($reviewAll as $value) {
            $positive[] = $value->positive_reviews;
            $negative[] = $value->negative_reviews;
            $category[] = $value->date;

            $totalPositive += $value->positive_reviews;
            $totalNegative += $value->negative_reviews;
        }

        $totalReview = $totalPositive + $totalNegative;

        return response()->json([
            "positive" => array_map('intval', $positive),
            "negative" => array_map('intval', $negative),
            "category" => $category,
            "totalReview" => $totalReview,
        ]);
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
