<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ColorController;
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


Route::get('admin', [AuthController::class, 'login_admin']);
Route::post('admin', [AuthController::class, 'auth_login_admin']);
Route::post('admin/logout', [AuthController::class, 'logout_admin'])->name('logout');


Route::group(['middleware' => 'admin'], function () {
    Route::get('admin/dashboard', [DashboardController::class, 'DashboardController'])->name('dashboard');
    Route::resource('admin/user', AdminController::class);
    Route::resource('admin/category', CategoryController::class);
    Route::resource('admin/sub_category', SubCategoryController::class);
    Route::resource('admin/color', ColorController::class);

    Route::post('admin/get_sub_category', [SubCategoryController::class, 'getSubCategory']);

    Route::resource('admin/brand', BrandController::class);
    Route::resource('admin/product', ProductController::class);

    Route::get('admin/product/delete-image/{id}', [ProductController::class, 'deleteImage']);

});

Route::get('/', function () {
    return 'welcome';
});
