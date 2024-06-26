<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\App;
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
            return response()->json([
                'view' => view('admin.order.render_order_detail', compact('order', 'orderDetail'))->render(),
            ]);
        }
    }

    public function orderPdf($id)
    {
        $order = Order::find($id);
        $orderDetail = Order::getOrderDetail($id);

        $pdf = PDF::loadView('admin.order.invoicePdf', compact('order', 'orderDetail'));
        return $pdf->stream();
        // return $pdf->download('admin.order.invoicePdf.pdf');
    }

    public function orderConfirm()
    {
        $orderConfirm = Order::getOrderConfirm();
        return view('admin.order.list_confirm', compact('orderConfirm'));
    }

    public function orderShipping()
    {
        $orderShipping = Order::getOrderTransport();
        return view('admin.order.list_shipping', compact('orderShipping'));
    }

    public function orderWaiting()
    {
        $orderWaiting = Order::getOrderWaiting();
        return view('admin.order.list_waiting', compact('orderWaiting'));
    }
    public function orderSuccess()
    {
        $orderSuccess = Order::getOrderSuccess();
        return view('admin.order.list_success', compact('orderSuccess'));
    }
    public function orderCanceled()
    {
        $orderCanceled = Order::getOrderCancelled();
        return view('admin.order.list_canceled', compact('orderCanceled'));
    }

    public function orderReturn()
    {
        $orderReturn = Order::getOrderRefunds();
        return view('admin.order.list_return', compact('orderReturn'));
    }


    public function orderUpdateStatus(Request $request)
    {
        if (!empty($request->id) && !empty($request->status)) {
            $status = $request->status;
            if ($status == 1) {
                $order = Order::find($request->id);
                $order->status = 1;
                $order->save();

                return response()->json(
                    [
                        'success' => true,
                        'status' => $status,
                    ]
                );
            } else if ($status == 2) {
                $order = Order::find($request->id);
                $order->status = 2;
                $order->save();

                $orderConfirm = count(Order::getOrderConfirm());

                return response()->json(
                    [
                        'success' => true,
                        'status' => $status,
                        "orderConfirm" => $orderConfirm
                    ]
                );
            } else if ($status == 3) {
                $order = Order::find($request->id);
                $order->status = 3;
                $order->save();
                $orderShipping = Order::getOrderTransport();

                return response()->json(
                    [
                        'success' => true,
                        'status' => $status,
                        "orderShipping" => $orderShipping
                    ]
                );
            } else if ($status == 4) {
                $order = Order::find($request->id);
                $order->status = 4;
                $order->save();
                $orderWaiting = Order::getOrderWaiting();

                return response()->json(
                    [
                        'success' => true,
                        'status' => $status,
                        "orderWaiting" => $orderWaiting
                    ]
                );
            } else if ($status == 5) {
                $order = Order::find($request->id);
                $order->status = 5;
                $order->save();
                return response()->json(
                    [
                        'success' => true,
                        'status' => $status
                    ]
                );
            } else if ($status == 6) {
                $order = Order::find($request->id);
                $order->status = 6;
                $order->save();
                $orderSuccess = Order::getOrderSuccess();

                return response()->json(
                    [
                        'success' => true,
                        'status' => $status,
                        "orderSuccess" => $orderSuccess
                    ]
                );
            }
        }
    }

}
