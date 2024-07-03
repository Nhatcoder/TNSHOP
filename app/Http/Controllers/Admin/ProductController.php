<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\SubCategory;
use App\Models\ProductSize;
use App\Models\ProductImage;
use App\Models\ColorImage;
use App\Events\DeleteImageProduct;
use Illuminate\Http\UploadedFile;

class ProductController extends Controller
{
    public function index()
    {
        $product = Product::getProductAdmin();
        return view('admin.product.list', compact('product'));
    }


    public function create()
    {
        $product = [];
        $category = Category::all();
        $brand = Brand::all();
        return view('admin.product.add', compact('product', 'category', 'brand'));
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
            'price' => 'Vui lòng nhập giá mới',
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

        if (!empty($request->color)) {
            foreach ($request->color as $colorData) {
                $color = new ColorImage();
                $color->color_name = $colorData['color_name'];

                if (isset($colorData['color_image']) && $colorData['color_image'] instanceof UploadedFile) {
                    $image = $colorData['color_image'];
                    $imageExtension = $image->getClientOriginalExtension();
                    $imageName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                    $uniqueImageName = 'img_color_' . rand(0, 999999999) . '_' . $imageName . '.' . $imageExtension;
                    $image->move(public_path('uploads/product'), $uniqueImageName);

                    $color->image_name = $uniqueImageName;
                }

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
        $imageColor = ColorImage::where('product_id', $id)->get();
        $product_size = ProductSize::where('product_id', $id)->get();
        return view('admin.product.edit', compact('product', 'category', 'brand', 'imageColor', 'sub_category', 'product_size'));
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

        if (!empty($request->color)) {
            $existingColorIds = ColorImage::where('product_id', $product->id)->pluck('id')->toArray();

            $newColorIds = [];

            foreach ($request->color as $colorData) {
                // Kiểm tra nếu một trong hai trường bị trống thì bỏ qua
                if (empty($colorData['color_name']) || (isset($colorData['color_image']) && !$colorData['color_image'] instanceof UploadedFile)) {
                    continue;
                }

                // Tìm hoặc tạo mới bản ghi ColorImage
                $color = ColorImage::firstOrNew([
                    'id' => $colorData['id'] ?? null,
                    'product_id' => $product->id,
                ]);

                // Cập nhật các trường cần thiết
                $color->color_name = $colorData['color_name'];

                // Xử lý ảnh nếu có
                if (isset($colorData['color_image']) && $colorData['color_image'] instanceof UploadedFile) {
                    // Xóa ảnh cũ nếu có
                    if (!empty($color->image_name) && file_exists(public_path('uploads/product/' . $color->image_name))) {
                        unlink(public_path('uploads/product/' . $color->image_name));
                    }

                    // Xử lý ảnh mới
                    $image = $colorData['color_image'];
                    $imageExtension = $image->getClientOriginalExtension();
                    $imageName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                    $uniqueImageName = 'img_color_' . rand(0, 999999999) . '_' . $imageName . '.' . $imageExtension;
                    $image->move(public_path('uploads/product'), $uniqueImageName);

                    $color->image_name = $uniqueImageName;
                }

                // Lưu thông tin màu sắc
                $color->save();

                // Thêm ID vào mảng các ID mới
                $newColorIds[] = $color->id;
            }

            // Xóa các bản ghi không có trong mảng các ID mới
            $idsToDelete = array_diff($existingColorIds, $newColorIds);
            foreach ($idsToDelete as $image) {
                $deleteImage = ColorImage::find($image);
                if (!empty($deleteImage->image_name) && file_exists('uploads/product/' . $deleteImage->image_name)) {
                    unlink('uploads/product/' . $deleteImage->image_name);
                }
            }
            ColorImage::whereIn('id', $idsToDelete)->delete();



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
        $imageId = ProductImage::where('product_id', $product->id)->get();
        $imageColor = ColorImage::where('product_id', $product->id)->get();

        foreach ($imageId as $image) {
            if (!empty($image->image_name) && file_exists('uploads/product/' . $image->image_name)) {
                unlink('uploads/product/' . $image->image_name);
            }
        }

        foreach ($imageColor as $image) {
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

    // see product
    public function seeProductDetail(Request $request)
    {
        if (!empty($request->id)) {
            $seeProductDetail = Product::getProductSeeDetail($request->id);
            $imageColor = ColorImage::where('product_id', $request->id)->get();
            $product_size = ProductSize::where('product_id', $request->id)->get();

            $view = view("admin.product.see_detail_product", compact('seeProductDetail', "imageColor", "product_size"))->render();
            return response()->json(
                [
                    'view' => $view,
                ],
                200
            );

        }
    }

    // update hot
    public function updateHotProduct(Request $request)
    {
        if (!empty($request->id)) {
            $product = Product::find($request->id);

            if ($product->hot == 1) {
                $product->hot = 0;
            } else {
                $product->hot = 1;
            }
            $product->save();
        }
    }
    public function updateStatusProduct(Request $request)
    {
        if (!empty($request->id)) {
            $product = Product::find($request->id);

            if ($product->status == 1) {
                $product->status = 0;
            } else {
                $product->status = 1;
            }
            $product->save();
        }
    }
}
