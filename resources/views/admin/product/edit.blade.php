@extends('admin.layout.app')
@section('title', 'Sản phẩm')

@section('main')
    <div class="card card-statistics">
        <div class="card-header">
            <div class="card-heading">
                <h4 class="card-title">Thêm sản phẩm</h4>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('product.update', $product->id) }}" method="post" class="form-horizontal"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label class="control-label" for="name">Tên</label>
                            <div class="mb-2">
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                    oninput="ChangeToSlug()" id="name" name="title"
                                    value ="{{ old('title', $product->title) }}" placeholder="Điền ..." />
                                @error('title')
                                    <em class="text-danger" style="">{{ $message }}</em>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label class="control-label" for="convert_slug">Slug</label>
                            <div class="mb-2">
                                <input type="text" id="convert_slug" class="form-control" name="slug"
                                    placeholder="Điền ..." value ="{{ old('slug', $product->slug) }}" readonly />
                                @error('slug')
                                    <em class="text-danger" style="">{{ $message }}</em>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label class="control-label" for="">Danh mục</label>
                            <div class="mb-2">
                                <select name="category_id" id="ChangeCategory"
                                    class="form-control @error('category_id') is-invalid @enderror">
                                    <option value="" selected disabled>Chọn danh mục</option>
                                    @foreach ($category as $item)
                                        <option {{ $item->id == $product->category_id ? 'selected' : '' }}
                                            value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <em class="text-danger" style="">{{ $message }}</em>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label class="control-label" for="">Danh mục phụ</label>
                            <div class="mb-2">
                                <select name="sub_category_id" id="getSubCategory" class="form-control">
                                    <option value="" selected disabled>Chọn danh mục phụ</option>
                                    @foreach ($sub_category as $sub)
                                        <option {{ $product->sub_category_id == $sub->id ? 'selected' : '' }}
                                            value="{{ $sub->id }}">{{ $sub->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label class="control-label" for="">Thương hiệu</label>
                            <div class="mb-2">
                                <select name="brand_id" class="form-control">
                                    <option value="" selected disabled>Chọn thương hiện</option>
                                    @foreach ($brand as $item)
                                        <option {{ $product->brand_id == $item->id ? 'selected' : '' }}
                                            value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label" for="">Màu sắc</label>
                    <div class="d-flex">
                        @foreach ($color as $item)
                            @php
                                $check = '';
                                foreach ($product_color as $p_color) {
                                    if ($p_color->product_id == $product->id && $p_color->color_id == $item->id) {
                                        $check = 'checked';
                                        // break;
                                    }
                                }
                            @endphp
                            <div class="form-check pr-3">
                                <input {{ $check }} class="form-check-input" value="{{ $item->id }}"
                                    name="color_id[]" type="checkbox" id="check-{{ $item->id }}">
                                <label class="form-check-label" for="check-{{ $item->id }}">
                                    {{ $item->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label class="control-label" for="">Giá cũ</label>
                            <div class="mb-2">
                                <input type="text" id="" class="form-control" name="old_price"
                                    placeholder="Điền ..." value ="{{ old('old_price', $product->old_price) }}" />
                                @error('old_price')
                                    <em class="text-danger" style="">{{ $message }}</em>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label class="control-label" for="">Giá</label>
                            <div class="mb-2">
                                <input type="text" id="" class="form-control" name="price"
                                    placeholder="Điền ..." value ="{{ old('price', $product->price) }}" />
                                @error('price')
                                    <em class="text-danger" style="">{{ $message }}</em>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class=" mb-3">
                    <label class="control-label" for="">Hình ảnh</label>
                    <input type="file" class="form-control " name="image[]" multiple accept="image/*">
                </div>

                @php
                    // dd();
                @endphp
                @if (!empty($product->productImage->count()))
                    <div class="row">
                        @foreach ($product->productImage as $image)
                            @if (!empty($image->checkImage()))
                                <div class="col-2 py-3">
                                    <img class="w-100 h-100" src="{{ $image->checkImage() }}" alt="">
                                    {{-- <a href="{{ url('admin/product/delete-image/'. $image->id) }}" data-id="{{ $image->id }}" class="btn-sm btn-danger delete_img-{{ $image->id }}">Xóa</a> --}}
                                    <button type="button" route="{{ url('admin/product/delete-image/' . $image->id) }}"
                                        data-id="{{ $image->id }}" class="btn-sm btn-danger delete_img">Xóa</button>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @endif

                <label for="">Size</label>
                <table class="table table-hover ">
                    <thead>
                        <tr>
                            <th>Tên size</th>
                            <th>Giá</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody id="AppendSize">
                        @php
                            $i_s = 1;
                        @endphp
                        @foreach ($product_size as $size)
                            <tr id="DeleteSize{{ $i_s }}">
                                <td> <input type="text" placeholder="Điền..." class="form-control"
                                        name="size[{{ $i_s }}][name]" value="{{ $size->name }}"></td>
                                <td> <input type="text" placeholder="Điền..." class="form-control"
                                        name="size[{{ $i_s }}][price]" value="{{ $size->price }}"></td>
                                <td>
                                    <button type="button" id="{{ $i_s }}"
                                        class="btn btn-danger DeleteSize">Xóa</button>
                                </td>
                            </tr>
                            @php
                                $i_s++;
                            @endphp
                        @endforeach

                        <tr>
                            <td> <input type="text" class="form-control"name="size[100][name]"></td>
                            <td> <input type="text" class="form-control" name="size[100][price]"></td>
                            <td>
                                <button type="button" class="btn btn-success AddSize">Thêm</button>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="form-group">
                    <label class="control-label" for="">Mô tả ngắn</label>
                    <div class="mb-2">
                        <textarea type="text" class="form-control" name="short_description" placeholder="Điền ...">{{ old('short_description', $product->short_description) }}
                        </textarea>
                        @error('short_description')
                            <em class="text-danger" style="">{{ $message }}</em>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="">Mô tả</label>
                    <div class="mb-2">
                        <textarea type="text" id="description" class="form-control " name="description" placeholder="Điền ...">{{ old('description', $product->description) }}
                        </textarea>
                        @error('description')
                            <em class="text-danger" style="">{{ $message }}</em>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="">Vận chuyển trả lại</label>
                    <div class="mb-2">
                        <textarea id="shipping_returns" class="form-control" name="shipping_returns" placeholder="Điền ...">
                            {{ old('shipping_returns', $product->shipping_returns) }}
                        </textarea>
                        @error('shipping_returns')
                            <em class="text-danger" style="">{{ $message }}</em>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="">Thông tin thêm</label>
                    <div class="mb-2">
                        <textarea class="form-control" id="additional_information" name="additional_information" placeholder="Điền ...">
                            {{ old('additional_information', $product->additional_information) }}
                        </textarea>
                        @error('additional_information')
                            <em class="text-danger" style="">{{ $message }}</em>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="">Trạng thái</label>
                    <div class="mb-2">
                        <select name="status" class="form-control">
                            <option value="1">Hiện</option>
                            <option value="0">Ẩn</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                    <a href="{{ route('product.index') }}" class="btn btn-info ">Quay lại</a>
                </div>

            </form>
        </div>
    </div>


    <script>
        $('#additional_information').summernote({
            tabsize: 2,
            height: 100
        });

        $('#description').summernote({
            tabsize: 2,
            height: 200
        });

        $('#shipping_returns').summernote({
            tabsize: 2,
            height: 100
        });


        // add size
        // $('.AddSize').on('click', function() {
        var i = 101;
        $('body').delegate('.AddSize', 'click', function() {
            var html = `
             <tr id="DeleteSize${i}">
                <td> <input type="text" placeholder="Điền..." class="form-control" name="size[${i}][name]"></td>
                <td> <input type="text" placeholder="Điền..." class="form-control" name="size[${i}][price]"></td>
                <td>
                    <button type="button" id="${i}" class="btn btn-danger DeleteSize">Xóa</button>
                </td>
            </tr>
            `;
            i++;
            $('#AppendSize').append(html);
        })
        // xóa
        $('body').delegate('.DeleteSize', 'click', function() {
            var id = $(this).attr('id');
            $('#DeleteSize' + id).remove();
        })


        // get sub category
        // $(document).ready(function() {
        //     var change = function() {
        //         $('#ChangeCategory').on('change', function() {
        //             var id = $(this).val();
        //             $.ajax({
        //                 type: "POST",
        //                 url: "{{ url('admin/get_sub_category') }}",
        //                 data: {
        //                     id: id,
        //                     _token: '{{ csrf_token() }}'
        //                 },
        //                 dataType: "json",
        //                 success: function(data) {
        //                     $('#getSubCategory').html(data);
        //                 },
        //                 error: function(data) {
        //                     // Xử lý lỗi nếu có
        //                 }
        //             });
        //         });

        //         // Lấy giá trị của option đã được chọn mặc định
        //         var defaultId = $('#ChangeCategory').val();

        //         // Kích hoạt sự kiện change khi trang được tải lần đầu
        //         $('#ChangeCategory').val(defaultId).trigger('change');
        //     };

        //     change();
        // });
        $(document).ready(function() {
            $('#ChangeCategory').on('change', function() {
                var id = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "{{ url('admin/get_sub_category') }}",
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: "json",
                    success: function(data) {
                        $('#getSubCategory').html(data);
                    },
                    error: function(data) {

                    }

                })
            })
        })

        // Xóa ảnh ajax
        $(document).ready(function() {
            var btn_delete = $('.delete_img');
            btn_delete.each(function() {
                var id = $(this).attr('data-id');
                var route = $(this).attr('route');
                // console.log(route);
                $(this).on('click', function(e) {
                    e.preventDefault();

                    const swalWithBootstrapButtons = Swal.mixin({
                        customClass: {
                            confirmButton: "btn btn-success",
                            cancelButton: "btn btn-danger"
                        },
                        buttonsStyling: false
                    });
                    swalWithBootstrapButtons.fire({
                        title: "Bạn có muốn xóa không ?",
                        text: "Bạn sẽ không thể hoàn nguyên điều này!!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonText: "Xóa",
                        cancelButtonText: "Hủy",
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                type: "GET",
                                url: route,
                                data: {
                                    id: id,
                                },
                                success: function() {
                                    Swal.fire({
                                        icon: "success",
                                        title: "Xóa ảnh thành công",
                                        showConfirmButton: false,
                                        timer: 1000
                                    }).then(function() {
                                        setTimeout(function() {
                                            location.reload();
                                        }, 1);
                                    });
                                },
                                error: function(data) {

                                }

                            })

                        } else if (
                            /* Read more about handling dismissals below */
                            result.dismiss === Swal.DismissReason.cancel
                        ) {
                            swalWithBootstrapButtons.fire({
                                title: "Đã hủy",
                                text: "Xóa không thành công !",
                                icon: "error",
                                showConfirmButton: false,
                                timer: 1400
                            });
                        }
                    });

                });
            });
        });
    </script>
@endsection
