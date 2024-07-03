<?php

// namespace App\Http\Controllers\Admin;

// use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
// use App\Models\Color;

// class ColorController extends Controller
// {

//     /**
//      * Display a listing of the resource.
//      */
//     public function index()
//     {
//         $color = Color::getColor();
//         // return response()->json($color);
//         return view('admin.color.list', compact('color'));
//     }

//     /**
//      * Show the form for creating a new resource.
//      */
//     public function create()
//     {
//         return view('admin.color.add');
//     }

//     /**
//      * Store a newly created resource in storage.
//      */
//     public function store(Request $request)
//     {
//         $data = $request->validate([
//             'name' => 'required|unique:color',
//             'slug' => 'required|unique:color',
//             'status' => 'nullable'
//         ], [
//             'name.required' => 'Vui lòng nhập tên !',
//             'slug.required' => 'Vui lòng nhập slug !',
//             'name.unique' => 'Tên đã tồn tại !',
//             'slug.unique' => 'Slug đã tồn tại !'
//         ]);

//         $color = new Color();
//         $color->name = $data['name'];
//         $color->slug = $data['slug'];
//         $color->status = $data['status'];

//         $color->save();

//         return redirect('admin/color')->with("success", "Thêm danh mục thành công");
//     }

//     /**
//      * Display the specified resource.
//      */
//     public function show(string $id)
//     {
//     }

//     /**
//      * Show the form for editing the specified resource.
//      */
//     public function edit(string $id)
//     {
//         $color = Color::find($id);


//         return view('admin.color.edit', compact('color'));
//     }

//     /**
//      * Update the specified resource in storage.
//      */
//     public function update(Request $request, string $id)
//     {
//         $data = $request->validate([
//             'name' => 'required|unique:color,name,' . $id,
//             'slug' => 'required|unique:color,slug,' . $id,
//             'status' => 'nullable'
//         ], [
//             'name.required' => 'Vui lòng nhập tên !',
//             'slug.required' => 'Vui lòng nhập slug !',
//             'name.unique' => 'Tên đã tồn tại !',
//             'slug.unique' => 'Slug đã tồn tại !'
//         ]);

//         $color = Color::find($id);
//         $color->name = $data['name'];
//         $color->slug = $data['slug'];
//         $color->status = $data['status'];
//         $color->save();

//         return redirect('admin/color')->with("success", "Cập nhật danh mục thành công");
//     }

//     /**
//      * Remove the specified resource from storage.
//      */
//     public function destroy(string $id)
//     {
//         $color = color::find($id);
//         $color->delete();
//         return redirect('admin/color')->with("success", "Xóa danh mục thành công");
//     }
// }
