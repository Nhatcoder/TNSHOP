<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Review;
use App\Models\Address;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;



class AcountController extends Controller
{

    public function acount()
    {
        $orders = Order::getOrder();
        $ordersConfirm = Order::getOrderConfirm();
        $orderTransport = Order::getOrderTransport();
        $orderWaiting = Order::getOrderWaiting();
        $orderSuccess = Order::getOrderSuccess();
        $orderCancelled = Order::getOrderCancelled();
        $orderRefunds = Order::getOrderRefunds();

        $address = Address::where('user_id', auth()->user()->id)->orderBy('type', 'desc')->orderBy('id', 'desc')->get();
        return view('user.acount.acount', compact('address', 'orders', 'ordersConfirm', 'orderTransport', 'orderWaiting', 'orderSuccess', 'orderCancelled', 'orderRefunds'));
    }

    public function searchOrder(Request $request)
    {
        if (!empty($request->keyword)) {
            $keyword = trim($request->keyword);
            $orders = Order::searchOrder($keyword);

            if (!empty($orders)) {
                $view = view("user.acount.order_search", [
                    "order" => $orders
                ])->render();
                return response()->json([
                    "status" => "success",
                    "view" => $view
                ], 200);
            } else {
                return response()->json([
                    "status" => "error",
                    "message" => "Không tìm thấy đơn hàng mã: " . $keyword,
                ], 200);
            }
        }
    }

    public function cancelOrder(Request $request)
    {
        if (!empty($request->id)) {
            $order = Order::find($request->id);
            $order->status = 5;
            $order->save();
        }
    }
    public function listOrderCancel()
    {
        $orders = Order::getOrderCancelled();
        return response()->json([
            "view" => view('user.acount.order_cancel', compact('orders'))->render()
        ], 200);
    }

    public function orderDetail(Request $request)
    {
        if (!empty($request->id)) {

            $order_detail = Order::getOrderDetail($request->id);
            $singleOrder = Order::find($request->id);

            $view = view("user.acount.order_detail", [
                "orders" => $order_detail,
                "order_detail" => $singleOrder
            ])->render();


            return response()->json([
                "status" => $order_detail,
                "order_detail" => $singleOrder,
                "view" => $view
            ], 200);
        }
    }

    public function acountNewAddress(Request $request)
    {
        $address = new Address();
        $address->user_id = auth()->user()->id;
        $address->name = $request->name_address;
        $address->phone = $request->phone_address;
        $address->city = $request->city;
        $address->district = $request->district;
        $address->ward = $request->ward;
        $address->home_address = $request->home_address;
        $address->save();


        $getAddress = Address::where('user_id', auth()->user()->id)->orderBy('type', 'desc')->orderBy('id', 'desc')->get();

        $view = view("user.acount.address.list", [
            "address" => $getAddress
        ])->render();

        return response()->json([
            'view' => $view,
            'status' => 'success'
        ], 200);
    }

    public function acountEditAddress(Request $request)
    {
        $address = Address::find($request->id);
        // return response()->json($address);
        $view = view("user.acount.address.edit", [
            "address" => $address
        ])->render();

        return response()->json([
            'view' => $view,
            'status' => 'success'
        ], 200);
    }

    public function acountUpdateAddress(Request $request)
    {
        $address = Address::find($request->id);
        $address->name = $request->name_address;
        $address->phone = $request->phone_address;
        $address->city = $request->city;
        $address->district = $request->district;
        $address->ward = $request->ward;
        $address->home_address = $request->home_address;
        $address->save();

        $getAddress = Address::where('user_id', auth()->user()->id)->orderBy('type', 'desc')->orderBy('id', 'desc')->get();
        $view = view("user.acount.address.list", [
            "address" => $getAddress
        ])->render();

        return response()->json([
            'view' => $view,
            'status' => 'success'
        ], 200);

    }

    public function acountDeleteAddress()
    {
        Address::where('id', $_POST['id'])->delete();
        $getAddress = Address::where("user_id", auth()->user()->id)->OrderBy("type", "desc")->OrderBy('id', 'desc')->get();

        $view = view("user.acount.address.list", [
            "address" => $getAddress
        ])->render();

        return response()->json([
            'view' => $view,
            'status' => 'success'
        ], 200);

    }
    public function acountAddressDefault(Request $request)
    {

        if (!empty($request->id)) {
            foreach (Address::where('user_id', auth()->user()->id)->get() as $address) {
                $address->type = 0;
                $address->save();
            }

            $address = Address::find($request->id);
            $address->type = 1;
            $address->save();

            $getAddress = Address::where("user_id", auth()->user()->id)->OrderBy("type", "desc")->OrderBy('id', 'desc')->get();

            $view = view("user.acount.address.list", [
                "address" => $getAddress
            ])->render();

            return response()->json([
                'view' => $view,
                'status' => 'success'
            ], 200);



        }
    }


    // Review product
    public function getOrderReview(Request $request)
    {
        if (!empty($request->id)) {
            $order = Order::getOrderRating($request->id);

            if (!empty($order)) {
                $view = view("user.acount.order_review", [
                    "order" => $order
                ]);

                return response()->json([
                    "view" => $view->render(),
                    "status" => "success"
                ], 200);

            }
        }
    }
    public function seeReviewOrder(Request $request)
    {
        if (!empty($request->id)) {
            $review = Review::seeReviewDetailProduct($request->id);
            $reviewOrderDetail = Review::seeReviewDetailOrder($request->id);

            if (!empty($review) && !empty($reviewOrderDetail)) {
                $view = view("user.acount.see_review_product", compact('review', 'reviewOrderDetail'))->render();
                return response()->json([
                    "view" => $view,
                ], 200);

            }
        }
    }
    public function orderRating(Request $request)
    {

        if (
            !empty($request->star) &&
            !empty($request->comment) &&
            !empty($request->product_id) &&
            !empty($request->order_id) &&
            !empty($request->user_id)
        ) {
            $review = new Review();
            $review->user_id = $request->user_id;
            $review->order_id = $request->order_id;
            $review->product_id = $request->product_id;
            $review->rating = $request->star;
            $review->comment = $request->comment;
            $review->save();

            $order = Order::find($request->order_id);
            $order->is_review = 1;
            $order->save();

            return response()->json([
                "id_review" => $review->id
            ], 200);
        }
    }

    public function updateProfileUser(Request $request)
    {
        if (!empty($request->id) && !empty($request->name) && !empty($request->phone) && !empty($request->email) && !empty($request->sex)) {
            $user = User::find($request->id);
            if (!empty($user)) {
                $user->name = $request->name;
                $user->phone = $request->phone;
                $user->email = $request->email;
                $user->sex = $request->sex;
                $user->save();
            }
        }
    }

    public function updateProfileAvatar(Request $request)
    {
        $user = User::find($request->id);
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar');
            $imageExtension = $avatarPath->getClientOriginalExtension();
            $imageName = pathinfo($avatarPath->getClientOriginalName(), PATHINFO_FILENAME);
            $uniqueImageName = 'avt_' . rand(0, 999999999) . '_' . $imageName . '.' . $imageExtension;

            if (!empty($user->avatar) && file_exists(public_path('uploads/product/' . $user->avatar))) {
                unlink(public_path('uploads/product/' . $user->avatar));
            }


            $avatarPath->move(public_path('uploads/product'), $uniqueImageName);

            $user->avatar = $uniqueImageName;
            $user->save();
        }
    }


    public function updatePassword(Request $request)
    {
        $data = Validator::make(
            $request->all(),
            [
                'password' => 'required',
                'new_password' => [
                    'required',
                    'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/'
                ],
                'confirm_password' => 'required|same:new_password',

            ],
            [
                'password.required' => 'Vui lòng nhập mật khẩu hiện tại',
                'new_password.required' => 'Vui lòng nhập mật khẩu mới',
                'new_password.regex' => 'Mật khẩu phải chứa kiểu bằng có chữ viết thường, hoa, số và ký tự đặc biệt',
                'confirm_password.required' => 'Vui lòng xác nhận lại mật khẩu',
                'confirm_password.same' => 'Mật khẩu chưa trùng khớp mật khẩu mới',

            ]
        );
        if ($data->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $data->errors()
            ], 200);
        } else {
            $user = User::find($request->id);

            if (!empty($user)) {
                if (Hash::check($request->password, $user->password)) {
                    $user->password = Hash::make($request->new_password);
                    $user->save();
                    return response()->json([
                        'status' => 'success',
                        'message' => 'Đổi mật khẩu thành công'
                    ], 200);
                }else{
                    return response()->json([
                        'status' => 'error',
                        'error' => 'Mật khẩu hiện tại không đúng'
                    ], 200);
                }
            }
        }
    }
}
