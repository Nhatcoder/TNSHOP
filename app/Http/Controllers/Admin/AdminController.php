<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = User::where('is_admin', '1')->get();
        return view('admin.user.list', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required',
                'status' => 'required',
            ],
            [
                "name.required" => "Tên người dùng không được để trống !",
                "email.required" => "Email không được để trống !",
                "email.unique" => "Email đã tồn tại !",
                "email.email" => "Phải đúng định dạng email !",
                "password.required" => "Mật khẩu không được để trống !",
                "status.required" => "Trạng thái không được để trống !",
            ]
        );

        $admin = new User();
        $admin->name = $data['name'];
        $admin->email = $data['email'];
        $admin->password = Hash::make($data['password']);
        $admin->is_admin = 1;
        $admin->status = 1;
        $admin->save();

        return redirect('admin/user')->with('success', 'Thêm người quản trị thành công !');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $admin = User::find($id);
        // dd($admin);
        return view('admin.user.edit', compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate(
            [
                'name' => 'required',
                'email' => 'required|email|unique:users,email,' . $id,
                'password' => 'nullable',
                'status' => 'required',
            ],
            [
                "name.required" => "Tên người dùng không được để trống !",
                "email.required" => "Email không được để trống !",
                "email.unique" => "Email đã tồn tại !",
                "email.email" => "Phải đúng định dạng email !",
                "status.required" => "Trạng thái không được để trống !",
            ]
        );

        $admin = User::find($id);
        $admin->name = $data['name'];
        $admin->email = $data['email'];
        if (!empty($data['password'])) {
            $admin->password = Hash::make($data['password']);
        }
        $admin->status = $data['status'];
        $admin->save();

        return redirect('admin/user')->with('success', 'Cập nhật thành công người quản trị thành công !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $admin = User::find($id);
        $admin->delete();
        return redirect('admin/user')->with('success', 'Xóa người quản trị thành công !');
    }
}
