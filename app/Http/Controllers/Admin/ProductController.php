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
use App\Events\DeleteImageProduct;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Product::getProduct();
        // dd($product);
        // return response()->json($product);
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
        $request->validate([
            'title' => 'required',
            'slug' => 'required|unique:product',
            'category_id' => 'required',
            'sub_category_id' => 'nullable',
            'brand_id' => 'required',
            'color_id' => 'required',
            'old_price' => 'nullable',
            'price' => 'required',
            'image' => 'required',
            'short_description' => 'nullable',
            'description' => 'nullable',
            'additional_information' => 'nullable',
            'shipping_returns' => 'nullable',
            'status' => 'nullable'
        ], [
            'title.required' => 'Vui lòng nhập tên sản phẩm',
            'slug.required' => 'Vui lòng nhập slug',
            'slug.unique' => 'Slug đã tồn tại',
            'category_id' => 'Vui lòng chọn danh mục',
            'brand_id' => 'Vui lòng nhà cung cấp',
            'old_price' => 'Vui lòng nhập giá mới',
            'price' => 'Vui lòng nhập giá cũ',
            'image' => 'Vui lòng chọn ảnh',
        ]);



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
        $productFind = Product::find($product->id);

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

        if ($request->file('image')) {
            foreach ($request->file('image') as $image) {
                $image_ex = $image->getClientOriginalExtension();
                $filename = $image->getClientOriginalName();
                $replaceName = date('dmY') . '_' . rand(0, 999999999) . '_' . $filename;
                $image->move(public_path('uploads/product'), $replaceName);

                $imageUpload = new ProductImage();
                $imageUpload->product_id = $productFind->id;
                $imageUpload->image_name = $replaceName;
                $imageUpload->image_extension = $image_ex;
                $imageUpload->save();
            }
        }
        return redirect('admin/product')->with('success', 'Thêm sản phẩm thành công');
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
        $request->validate([
            'title' => 'required',
            'slug' => 'required',
            'category_id' => 'required',
            'sub_category_id' => 'nullable',
            'brand_id' => 'required',
            'color_id' => 'nullable',
            'old_price' => 'required',
            'price' => 'required',
            'image' => 'nullable',
            'short_description' => 'nullable',
            'description' => 'nullable',
            'additional_information' => 'nullable',
            'shipping_returns' => 'nullable',
            'status' => 'nullable'
        ], [
            'title.required' => 'Vui lòng nhập tên sản phẩm',
            'slug.required' => 'Vui lòng nhập slug',
            'category_id' => 'Vui lòng chọn danh mục',
            'brand_id' => 'Vui lòng nhà cung cấp',
            'old_price' => 'Vui lòng nhập giá mới',
            'price' => 'Vui lòng nhập giá cũ',
        ]);

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
            foreach ($request->file('image') as $image) {
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

        return redirect('admin/product')->with('success', 'Cập nhật sản phẩm thành công');
    }


    public function destroy(string $id)
    {
        $product = Product::find($id);
        $imageId =  ProductImage::where('product_id', $product->id)->get();

        foreach ($imageId as $image) {
            if (!empty($image->image_name) && file_exists('uploads/product/' . $image->image_name)) {
                unlink('uploads/product/' . $image->image_name);
            }
        }
        ProductImage::deleteImage($product->id);
        $product->delete();

        echo "Xóa sản phẩm thành công";
        // return response()->json($imageId);
        // return redirect('admin/product')->with('success', 'Xóa sản phẩm thành công');
    }

    // Xóa ảnh
    public function deleteImage($id)
    {
        $image = ProductImage::find($id);
        if (!empty($image->image_name) && file_exists('uploads/product/' . $image->image_name)) {
            unlink('uploads/product/' . $image->image_name);
        }

        broadcast(new DeleteImageProduct($image));
        $image->delete();
        return response()->json("Xóa thanh cong");
    }

    // sắp xếp ảnh
    public function oderByImage(Request $request)
    {
        if (!empty($request->photo_id)) {
            $i = 1;
            foreach ($request->photo_id as $photo_id) {
                $image = ProductImage::find($photo_id);
                $image->order_by = $i;
                $image->save();
                $i++;
            }
        }
    }
}
