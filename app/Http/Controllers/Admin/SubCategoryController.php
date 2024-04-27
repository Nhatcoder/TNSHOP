<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::getCategory();
        $sub_category = SubCategory::getSubCategory();
        // $sub_category = SubCategory::with('sub_category')->get();
        // return response()->json($sub_category);
        return view('admin.sub_category.list', compact('category', 'sub_category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::getCategory();
        return view('admin.sub_category.add', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = request()->validate([
            'category_id' => 'required',
            'name' => 'required|unique:sub_category',
            'slug' => 'required|unique:sub_category',
            'status' => 'nullable'
        ], [
            'name.required' => 'Vui lòng nhập tên !',
            'slug.required' => 'Vui lòng nhập slug !',
            'category_id.required' => 'Vui lòng chọn danh mục !',
            'name.unique' => 'Tên đã tồn tại !',
            'slug.unique' => 'Slug đã tồn tại !'
        ]);

        $sub_category = new SubCategory();
        $sub_category->category_id = $data['category_id'];
        $sub_category->name = $data['name'];
        $sub_category->slug = $data['slug'];
        $sub_category->status = $data['status'];
        $sub_category->save();

        return redirect('admin/sub_category')->with("success", "Thêm danh mục phụ thành công");
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
        $category = Category::getCategory();
        $sub_category = SubCategory::getSubCategoryId($id);
        // return response()->json($sub_category);
        return view('admin.sub_category.edit', compact('category', 'sub_category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'category_id' => 'required',
            'name' => 'required|unique:sub_category,name,' . $id,
            'slug' => 'required|unique:sub_category,slug,' . $id,
            'status' => 'nullable'
        ], [
            'name.required' => 'Vui lòng nhập tên !',
            'slug.required' => 'Vui lòng nhập slug !',
            'category_id.required' => 'Vui lòng chọn danh mục !',
            'name.unique' => 'Tên đã tồn tại !',
            'slug.unique' => 'Slug đã tồn tại !'
        ]);

        $sub_category = SubCategory::getSubCategoryId($id);
        $sub_category->category_id = $data['category_id'];
        $sub_category->name = $data['name'];
        $sub_category->slug = $data['slug'];
        $sub_category->status = $data['status'];
        $sub_category->save();

        return redirect('admin/sub_category')->with("success", "Thêm danh mục phụ thành công");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sub_category = SubCategory::find($id);
        $sub_category->delete();
        return redirect('admin/sub_category')->with("success", "Xóa danh mục phụ thành công");
    }

    public function getSubCategory(Request $request)
    {
        $category_id = $request->id;
        $get_sub_category = SubCategory::getSubCategoryCategory_id($category_id);
        $html = "";
        foreach ($get_sub_category as $key => $value) {
            $html .= "<option value='" . $value->id . "'>" . $value->name . "</option>";
        }

        echo json_encode($html);
    }
}
