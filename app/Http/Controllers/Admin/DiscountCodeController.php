<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\DiscountCode;

class DiscountCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $discount_code = DiscountCode::getRecord();
        // return response()->json($discount_code);
        return view('admin.discount_code.list', compact('discount_code'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.discount_code.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|unique:discount_code',
            'type' => 'required',
            'percent_amount' => 'required',
            'expire_date' => 'required',
            'status' => 'nullable'
        ], [
            'name.required' => 'Vui lòng nhập tên !',
            'name.unique' => 'Tên đã tồn tại !',
            'type.required' => 'Vui lòng chọn loại !',
            'percent_amount.required' => 'Vui nhập số tiền giảm giá !',
            'expire_date.required' => 'Vui chọn ngày hết hạn !',
        ]);

        $discount_code = new DiscountCode();
        $discount_code->name = $data['name'];
        $discount_code->name_code =  Str::upper(Str::random(10));
        $discount_code->type = $data['type'];
        $discount_code->percent_amount = $data['percent_amount'];
        $discount_code->expire_date = $data['expire_date'];
        $discount_code->save();

        return redirect('admin/discount_code')->with("success", "Thêm mã giảm giá thành công");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $discount_code = DiscountCode::find($id);
        return view('admin.discount_code.edit', compact('discount_code'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name' => 'required|unique:discount_code,name,' . $id,
            'type' => 'required',
            'percent_amount' => 'required',
            'expire_date' => 'required',
            'status' => 'nullable'
        ], [
            'name.required' => 'Vui lòng nhập tên !',
            'name.unique' => 'Tên đã tồn tại !',
            'type.required' => 'Vui lòng chọn loại !',
            'percent_amount.required' => 'Vui nhập số tiền giảm giá !',
            'expire_date.required' => 'Vui chọn ngày hết hạn !',
        ]);

        $discount_code = DiscountCode::find($id);
        $discount_code->name = $data['name'];
        $discount_code->type = $data['type'];
        $discount_code->percent_amount = $data['percent_amount'];
        $discount_code->expire_date = $data['expire_date'];
        $discount_code->save();

        return redirect('admin/discount_code')->with("success", "Cập nhật mã giảm giá thành công");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $discount_code = DiscountCode::find($id);
        $discount_code->delete();
        // return redirect('admin/discount_code')->with("success", "Xóa danh mục thành công");
    }
}
