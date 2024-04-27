<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brand = Brand::getbrand();

        // return response()->json($brand);
        return view('admin.brand.list', compact('brand'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.brand.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|unique:brand',
            'slug' => 'required|unique:brand',
            'status' => 'nullable'
        ], [
            'name.required' => 'Vui lòng nhập tên !',
            'slug.required' => 'Vui lòng nhập slug !',
            'name.unique' => 'Tên đã tồn tại !',
            'slug.unique' => 'Slug đã tồn tại !'
        ]);

        $brand = new Brand();
        $brand->name = $data['name'];
        $brand->slug = $data['slug'];
        $brand->status = $data['status'];
        $brand->save();

        return redirect('admin/brand')->with("success", "Thêm thương hiệu thành công");
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
        $brand = Brand::find($id);


        return view('admin.brand.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name' => 'required|unique:brand,name,' . $id,
            'slug' => 'required|unique:brand,slug,' . $id,
            'status' => 'nullable'
        ], [
            'name.required' => 'Vui lòng nhập tên !',
            'slug.required' => 'Vui lòng nhập slug !',
            'name.unique' => 'Tên đã tồn tại !',
            'slug.unique' => 'Slug đã tồn tại !'
        ]);

        $brand = Brand::find($id);
        $brand->name = $data['name'];
        $brand->slug = $data['slug'];
        $brand->status = $data['status'];
        $brand->save();

        return redirect('admin/brand')->with("success", "Cập nhật thương hiệu thành công");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand = Brand::find($id);
        $brand->delete();
        return redirect('admin/brand')->with("success", "Xóa thương hiệu thành công");
    }
}
