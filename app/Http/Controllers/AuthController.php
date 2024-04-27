<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login_admin()
    {
        // $qq = Hash::make('123456789');
        // dd($qq);
        if (!empty(Auth::check() && Auth::user()->is_admin == 1)) {
            return redirect('admin/dashboard');
        }
        return view('admin.auth.login');
    }

    public function auth_login_admin(Request $request)
    {
        $remember = !empty($request->remember) ? true : false;
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'is_admin' => 1, 'status' => 1], $remember)) {
            return redirect('admin/dashboard')->with('success', 'Đăng nhập thành công');
        } else {
            return back()->with('error', 'Email hoặc mật khẩu không đúng !');
        }
    }
    public function logout_admin()
    {
        Auth::logout();
        return  redirect('admin');
    }
}
