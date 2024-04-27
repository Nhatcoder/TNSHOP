<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Color;
use App\Models\ProductColor;
use App\Models\SubCategory;
use App\Models\ProductSize;
use App\Models\ProductImage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Product::getProduct();
        // dd($product);
        return view('admin.product.list', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $product = [];
        $category = Category::all();
        $brand = Brand::all();
        $color = Color::all();
        // return response()->json($category);
        return view('admin.product.add', compact('product', 'category', 'brand', 'color'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'title' => 'required',
        //     'slug' => 'required',
        //     'category_id' => 'required',
        //     'sub_category_id' => 'required',
        //     'brand_id' => 'required',


        //     'old_price' => 'required',
        //     'price' => 'required',
        //     'additional_information' => 'required',

        //     'short_description' => 'required',
        //     'description' => 'required',
        //     'shipping_returns' => 'required',
        //     'status' => 'nullable'
        //     // 'image' => 'required',
        // ]);

        $product = new Product();
        $product->title = $request->title;
        $product->slug = $request->slug;
        $product->category_id = $request->category_id;
        $product->sub_category_id = $request->sub_category_id;
        $product->brand_id = $request->brand_id;
        $product->old_price = $request->old_price;
        $product->price = $request->price;
        $product->short_description = $request->short_description;
        $product->description = $request->description;
        $product->additional_information = $request->additional_information;
        $product->shipping_returns = $request->shipping_returns;

        $product->save();

        // $product->colors()->attach($request->color_id);

        if (!empty($request->color_id)) {
            foreach ($request->color_id as $color_id) {
                $color = new ProductColor();
                $color->color_id = $color_id;
                $color->product_id = $product->id;
                $color->save();
            }
        }
        if (!empty($request->size)) {
            foreach ($request->size as $size) {
                // dd($size['price']);
                if (!empty($size['name'] && $size['price'])) {
                    $produc_size = new ProductSize();
                    $produc_size->name = $size['name'];
                    $produc_size->price = !empty($size['price']) ? $size['price'] : 0;
                    $produc_size->product_id = $product->id;
                    $produc_size->save();
                }
            }
        }
        return redirect('admin/product')->with('success', 'Thêm sản phẩm thành công');

        // return response()->json($request->all());
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
        $product = Product::find($id);
        $category = Category::all();
        $sub_category = SubCategory::all();
        $brand = Brand::all();
        $color = Color::all();
        $product_color = ProductColor::all();
        $product_size = ProductSize::where('product_id', $id)->get();
        return view('admin.product.edit', compact('product', 'category', 'brand', 'color', 'product_color', 'sub_category', 'product_size'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());

        $product = Product::find($id);
        $product->title = $request->title;
        $product->slug = $request->slug;
        $product->category_id = $request->category_id;
        $product->sub_category_id = $request->sub_category_id;
        $product->brand_id = $request->brand_id;
        $product->old_price = $request->old_price;
        $product->price = $request->price;
        $product->short_description = $request->short_description;
        $product->description = $request->description;
        $product->additional_information = $request->additional_information;
        $product->shipping_returns = $request->shipping_returns;

        $product->save();

        // $product->colors()->attach($request->color_id);


        ProductColor::DeleteRecord($product->id);
        if (!empty($request->color_id)) {
            foreach ($request->color_id as $color_id) {
                $color = new ProductColor();
                $color->color_id = $color_id;
                $color->product_id = $product->id;
                $color->save();
            }
        }

        ProductSize::DeleteRecord($product->id);
        if (!empty($request->size)) {
            foreach ($request->size as $size) {
                // dd($size['price']);
                if (!empty($size['name'] && $size['price'])) {
                    $produc_size = new ProductSize();
                    $produc_size->name = $size['name'];
                    $produc_size->price = !empty($size['price']) ? $size['price'] : 0;
                    $produc_size->product_id = $product->id;
                    $produc_size->save();
                }
            }
        }

        if ($request->file('image')) {
            foreach ($request->file('image') as $key => $image) {
                $image_ex = $image->getClientOriginalExtension();
                $filename = $image->getClientOriginalName();
                $replaceName = date('dmY') . '_' . rand(0, 999999999) . '_' . $filename;
                $image->move(public_path('uploads/product'), $replaceName);

                $imageUpload = new ProductImage();
                $imageUpload->product_id = $id;
                $imageUpload->image_name = $replaceName;
                $imageUpload->image_extension = $image_ex;
                $imageUpload->save();
            }
        }

        // die;
        return redirect('admin/product')->with('success', 'Cập nhật sản phẩm thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    // Xóa ảnh
    public function deleteImage($id){
        $image = ProductImage::find($id);
        if(!empty($image->image_name) && file_exists('uploads/product/'.$image->image_name)){
            unlink('uploads/product/'.$image->image_name);
        }
        $image->delete();

        
    }
}
