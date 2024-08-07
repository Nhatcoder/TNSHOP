<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\AcountController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\WishListController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ColorController;

use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;


use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\DiscountCodeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['middleware' => 'guest'], function () {
    Route::get('admin', [AuthController::class, 'login_admin']);
    Route::post('admin', [AuthController::class, 'auth_login_admin']);
    Route::post('admin/logout', [AuthController::class, 'logout_admin'])->name('logout');
});


Route::group(['middleware' => 'admin'], function () {
    Route::get('admin/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('admin/chart_selected', [DashboardController::class, 'chartSelected'])->name('chartSelected');
    Route::post('admin/chart_review', [DashboardController::class, 'chartReview'])->name('chartReview');
    Route::post('admin/chart_from_date', [DashboardController::class, 'chartFromDate'])->name('chartFromDate');


    Route::post('admin/get_sub_category', [SubCategoryController::class, 'getSubCategory']);
    Route::resource('admin/user', AdminController::class);
    Route::resource('admin/category', CategoryController::class);
    Route::resource('admin/sub_category', SubCategoryController::class);

    Route::resource('admin/brand', BrandController::class);
    Route::resource('admin/product', ProductController::class);
    Route::post('admin/product/delete-image/{id}', [ProductController::class, 'deleteImage']);
    Route::post('admin/product/order-by-image', [ProductController::class, 'oderByImage'])->name("oderByImage");
    Route::post('admin/product/see-product-detail', [ProductController::class, 'seeProductDetail'])->name("seeProductDetail");
    Route::post('admin/product/update-hot', [ProductController::class, 'updateHotProduct'])->name("updateHotProduct");
    Route::post('admin/product/update-status', [ProductController::class, 'updateStatusProduct'])->name("updateStatusProduct");

    Route::resource('admin/discount_code', DiscountCodeController::class);

    Route::get('admin/order', [OrderController::class, 'index'])->name("adminOrder");
    Route::get('admin/order_confirm', [OrderController::class, 'orderConfirm'])->name("orderConfirm");
    Route::get('admin/order_shipping', [OrderController::class, 'orderShipping'])->name("orderShipping");
    Route::get('admin/order_waiting', [OrderController::class, 'orderWaiting'])->name("orderWaiting");
    Route::get('admin/order_success', [OrderController::class, 'orderSuccess'])->name("orderSuccess");
    Route::get('admin/order_cancelled', [OrderController::class, 'orderCanceled'])->name("orderCanceled");
    Route::get('admin/order_return', [OrderController::class, 'orderReturn'])->name("orderReturn");

    Route::get('admin/order_pdf/{id}', [OrderController::class, 'orderPdf'])->name("orderPdf");
    Route::post('admin/order_detail', [OrderController::class, 'adminOrderDetail'])->name("adminOrderDetail");
    Route::post('admin/order_update_status', [OrderController::class, 'orderUpdateStatus'])->name("orderUpdateStatus");


});


Route::get('/', [IndexController::class, 'index'])->name("home");
Route::post('user_register', [AuthController::class, 'user_register'])->name("user_register");
Route::post('user_signin', [AuthController::class, 'user_signin'])->name("user_signin");
Route::get('user_logout', [AuthController::class, 'user_logout'])->name("user_logout");
Route::get('forgot-password', [AuthController::class, 'user_forgot_password'])->name("forgot_password");
Route::get('dang-nhap', [AuthController::class, 'user_auth'])->name("user_auth");

Route::post('verify-email', [AuthController::class, 'auth_verify_email'])->name("verify_email");
Route::get('verify-email-success', [AuthController::class, 'verify_success'])->name("verify_success");
Route::post('update-password', [AuthController::class, 'auth_update_password'])->name("auth_update_password");

Route::get('verify-token/{token}', [AuthController::class, 'verify_token'])->name("verify_token");
Route::get('activate/{id}', [AuthController::class, 'activate_email'])->name("activate_email");

Route::get('auth/google', [AuthController::class, 'redirectToGoogle'])->name("loginGoogle");
Route::get('auth/google/callback', [AuthController::class, 'handleGoogleCallback']);


Route::middleware('check.auth')->group(function () {
    Route::get('account', [AcountController::class, 'acount'])->name("acount");
    Route::post('account/new_address', [AcountController::class, 'acountNewAddress'])->name("acountNewAddress");
    Route::post('account/delete_address', [AcountController::class, 'acountDeleteAddress'])->name("acountDeleteAddress");
    Route::post('account/edit_address', [AcountController::class, 'acountEditAddress'])->name("acountEditAddress");
    Route::post('account/update_address', [AcountController::class, 'acountUpdateAddress'])->name("acountUpdateAddress");
    Route::post('account/address_default', [AcountController::class, 'acountAddressDefault'])->name("acountAddressDefault");
    Route::post('account/update_profile', [AcountController::class, 'updateProfileUser'])->name("updateProfileUser");
    Route::post('account/update_avatar_profile', [AcountController::class, 'updateProfileAvatar'])->name("updateProfileAvatar");
    Route::post('account/update_password', [AcountController::class, 'updatePassword'])->name("updatePassword");

    Route::post('order/order_detail', [AcountController::class, 'orderDetail'])->name("orderDetail");
    Route::post('order/search', [AcountController::class, 'searchOrder'])->name("searchOrder");
    Route::post('order/list_cancel_order', [AcountController::class, 'listOrderCancel'])->name("listOrderCancel");
    Route::post('order/cancel_order', [AcountController::class, 'cancelOrder'])->name("cancelOrder");
    Route::post('order/get_order_rating', [AcountController::class, 'getOrderReview'])->name("getOrderReview");
    Route::post('order/order_rating', [AcountController::class, 'orderRating'])->name("orderRating");
    Route::post('order/see_order_rating', [AcountController::class, 'seeReviewOrder'])->name("seeReviewOrder");

    Route::post('check-out/address_new', [PaymentController::class, 'checkOutNewAddress'])->name("checkOutNewAddress");
    Route::post('check-out/address_default', [PaymentController::class, 'checkOutAddressDefault'])->name("checkOutAddressDefault");
    Route::post('check-out/address_edit', [PaymentController::class, 'checkOutEditAddress'])->name("checkOutEditAddress");
    Route::post('check-out/address_update', [PaymentController::class, 'checkOutUpdateAddress'])->name("checkOutUpdateAddress");


    Route::get('gio-hang', [PaymentController::class, 'cart'])->name("cart");
    Route::get('thanh-toan', [PaymentController::class, 'checkOut'])->name("checkOut");
    Route::post('thanh-toan/apply-voucher', [PaymentController::class, 'checkOutApplyVoucher'])->name("checkOutApplyVoucher");
    Route::post('place-order', [PaymentController::class, 'placeOder'])->name("place_order");

    Route::get('payment-vnpay-success', [PaymentController::class, 'paymentVnpaySuccess'])->name("paymentVnpaySuccess");
    Route::get('payment-momo-success', [PaymentController::class, 'paymentMomoSuccess'])->name("paymentMomoSuccess");

    Route::get('wishlist', [WishListController::class, 'wishList'])->name("wishlist");
    Route::post('remove-wishlist/{id}', [WishListController::class, 'removeWishlist'])->name("removeWishlist");
    Route::post('add-product-wishlist', [WishListController::class, 'addProductWishList'])->name("addProductWishList");



});



Route::post('update-cart', [PaymentController::class, 'updateCart'])->name("updateCart");
Route::post('delete-cart', [PaymentController::class, 'deleteCart'])->name("deleteCart");

Route::post('getProductCategoryById', [IndexController::class, 'getProductCategoryById'])->name("getProductCategoryById");
Route::post('seeMoreProductHome', [IndexController::class, 'seeMoreProductHome'])->name("seeMoreProductHome");
Route::post('getSeeMoreProductCategoryById', [IndexController::class, 'getSeeMoreProductCategoryById'])
    ->name("getSeeMoreProductCategoryById");

Route::get('tim-kiem', [IndexController::class, 'getProductBySearch']);
Route::get('product', [IndexController::class, 'getProducts'])->name("getProducts");


Route::get('{slug?}/{subslug?}', [IndexController::class, 'getCategory']);
Route::post('product/add-to-cart', [PaymentController::class, 'addProductToCart'])->name('addProductToCart');
Route::post('get_filter_product_ajax', [IndexController::class, 'getFilterProductAjax']);


