@extends('admin.layout.app')
@section('title', 'Sản phẩm')

@section('main')
    <div class="card card-statistics">
        <div class="card-header">
            <div class="card-heading">
                <h4 class="card-title">Cập nhật sản phẩm</h4>
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
                                <select name="brand_id" class="form-control  @error('brand_id') is-invalid @enderror">
                                    <option value="" selected disabled>Chọn thương hiện</option>
                                    @foreach ($brand as $item)
                                        <option {{ $product->brand_id == $item->id ? 'selected' : '' }}
                                            value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('brand_id')
                                    <em class="text-danger" style="">{{ $message }}</em>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <label class="control-label" for="">Màu sắc</label>
                <table class="table table-hover" id="table_data_color" data-color="{{ count($imageColor) }}">
                    <thead>
                        <tr>
                            <th>Hình ảnh</th>
                            <th>Tên màu sắc</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody id="AppendColor">
                        @foreach ($imageColor as $key => $color)
                            <tr>
                                <input type="hidden" name="color[{{ $key + 1 }}][id]" value="{{ $color->id }}">
                                <td>
                                    <input type="file" class="d-none" id="image_color_{{ $key + 1 }}"
                                        name="color[{{ $key + 1 }}][color_image]" value="{{ $color->image_name }}"
                                        accept="image/*">
                                    <label class="render_img_color" for="image_color_{{ $key + 1 }}">
                                        <img id="preview_image_color_{{ $key + 1 }}" width="80px"
                                            src="{{ $color->checkImage() }}" alt="">
                                    </label>
                                </td>
                                <td><input type="text" class="form-control"
                                        name="color[{{ $key + 1 }}][color_name]" placeholder="Điền..."
                                        value="{{ $color->color_name }}"></td>
                                <td>
                                    <button type="button" class="btn btn-danger RemoveColor">Xóa</button>
                                </td>
                            </tr>
                        @endforeach

                        <tr>
                            <td>
                                <input type="file" class="d-none" id="image_color_01" name="color[100][color_image]"
                                    value="" accept="image/*">
                                <label class="render_img_color" for="image_color_01">
                                    <img id="preview_image_color_01" width="80px"
                                        src="{{ asset('assets_ad/img/color_img.jpg') }}" alt="">
                                </label>
                            </td>
                            <td><input type="text" class="form-control" name="color[100][color_name]"
                                    placeholder="Điền..."></td>
                            <td>
                                <button type="button" class="btn btn-success AddColor">Thêm</button>
                            </td>
                        </tr>
                    </tbody>

                </table>

                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label class="control-label" for="">Giá cũ</label>
                            <div class="mb-2">
                                <input type="text" id=""
                                    class="form-control @error('old_price') is-invalid @enderror" name="old_price"
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
                                <input type="text" id=""
                                    class="form-control @error('price') is-invalid @enderror" name="price"
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
                    <input type="file" class="form-control " onchange="previewImages(this)" id="image"
                        name="image[]" value="{{ old('image') }}" multiple accept="image/*">
                </div>

                <style>
                    .delete_image__product {
                        position: absolute;
                        top: 0px;
                        padding: 25px;
                        right: 0px;
                        cursor: pointer;
                    }

                    .close_image {
                        font-size: 16px;
                        color: #f00;
                        font-weight: 700;
                    }

                    .sort_image {
                        cursor: move;
                    }
                </style>

                <div class="row" id="image-preview">

                </div>

                @if (!empty($product->productImage->count()))
                    <div class="row" id="sort_image">
                        @foreach ($product->productImage as $image)
                            @if (!empty($image->checkImage()))
                                <div class="col-2 m-3 border sort_image" id="image_preview_{{ $image->id }}"
                                    data-id="{{ $image->id }}">
                                    <img class="w-100" style="height: 200px;" src="{{ $image->checkImage() }}"
                                        alt="{{ $image->name }}">
                                    <div class="delete_image__product delete_img"
                                        route="{{ url('admin/product/delete-image/' . $image->id) }}"
                                        data-id="{{ $image->id }}">
                                        <i class="close_image ti ti-close"></i>
                                    </div>
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
        // editer
        $('#additional_information').summernote({
            tabsize: 2,
            height: 100
        });

        $('#description').summernote({
            tabsize: 2,
            height: 100
        });

        $('#shipping_returns').summernote({
            tabsize: 1,
            height: 200
        });

        // add color
        $(document).ready(function() {
            let colorIndex = 100;

            // Function to handle file input change and preview image
            function handleFileInputChange(input, preview) {
                var file = input.files[0];
                if (file) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $(preview).attr('src', e.target.result);
                    }
                    reader.readAsDataURL(file);
                }
            }

            // Initial file input change event
            $('#image_color_01').on('change', function() {
                handleFileInputChange(this, '#preview_image_color_01');
            });


            let dataColor = $("#table_data_color").data("color");

            for (let index = 1; index <= dataColor; index++) {
                $(`#image_color_${index}`).on('change', function() {
                    handleFileInputChange(this, `#preview_image_color_${index}`);
                });

            }

            // Add new row event
            $(document).on('click', '.AddColor', function() {
                colorIndex++;
                let newRow = `
                    <tr>
                        <td>
                            <input type="file" class="d-none" id="image_color_${colorIndex}" name="color[${colorIndex}][color_image]" value="" accept="image/*">
                            <label class="render_img_color" for="image_color_${colorIndex}">
                                <img id="preview_image_color_${colorIndex}" width="80px" src="{{ asset('assets_ad/img/color_img.jpg') }}" alt="">
                            </label>
                        </td>
                        <td><input type="text" class="form-control" name="color[${colorIndex}][color_name]" placeholder="Điền..."></td>
                        <td>
                            <button type="button" class="btn btn-danger RemoveColor">Xóa</button>
                        </td>
                    </tr>
                `;
                $('#AppendColor').append(newRow);

                // Bind change event for the new file input
                $(`#image_color_${colorIndex}`).on('change', function() {
                    handleFileInputChange(this, `#preview_image_color_${colorIndex}`);
                });
            });

            // Remove row event
            $(document).on('click', '.RemoveColor', function() {
                $(this).closest('tr').remove();
            });
        });


        // add size
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




        // Sắp xếp ảnh
        $(document).ready(function() {
            $("#sort_image").sortable({

                update: function() {
                    var photo_id = [];
                    $("#sort_image .sort_image").each(function() {
                        var id = $(this).data("id");
                        // console.log(id);
                        photo_id.push(id);
                        const Toast = Swal.mixin({
                            toast: true,
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 1500,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.onmouseenter = Swal.stopTimer;
                                toast.onmouseleave = Swal.resumeTimer;
                            }
                        });
                        Toast.fire({
                            icon: "success",
                            title: "Ảnh đã sắp xếp thành công"
                        });
                    });

                    $.ajax({
                        type: "POST",
                        url: "{{ route('oderByImage') }}",
                        data: {
                            "photo_id": photo_id,
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data) {
                            console.log(data);
                        },
                        error: function(data) {
                            console.log(data);
                        }

                    })
                    console.log(photo_id);
                }
            });

        })

        // get sub category
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
        // $(document).ready(function() {
        //     var btn_delete = $('.delete_img');
        //     btn_delete.each(function() {
        //         var id = $(this).attr('data-id');
        //         var route = $(this).attr('route');
        //         // console.log(route);
        //         $(this).on('click', function(e) {
        //             e.preventDefault();

        //             const swalWithBootstrapButtons = Swal.mixin({
        //                 customClass: {
        //                     confirmButton: "btn btn-success",
        //                     cancelButton: "btn btn-danger"
        //                 },
        //                 buttonsStyling: false
        //             });
        //             swalWithBootstrapButtons.fire({
        //                 title: "Bạn có muốn xóa không ?",
        //                 text: "Bạn sẽ không thể hoàn nguyên điều này!!",
        //                 icon: "warning",
        //                 showCancelButton: true,
        //                 confirmButtonText: "Xóa",
        //                 cancelButtonText: "Hủy",
        //                 reverseButtons: true
        //             }).then((result) => {
        //                 if (result.isConfirmed) {
        //                     $.ajax({
        //                         type: "GET",
        //                         url: route,
        //                         data: {
        //                             id: id,
        //                         },
        //                         success: function() {
        //                             Swal.fire({
        //                                 icon: "success",
        //                                 title: "Xóa ảnh thành công",
        //                                 showConfirmButton: false,
        //                                 timer: 1000
        //                             }).then(function() {
        //                                 setTimeout(function() {
        //                                     location.reload();
        //                                 }, 1);
        //                             });
        //                         },
        //                         error: function(data) {

        //                         }

        //                     })

        //                 } else if (
        //                     /* Read more about handling dismissals below */
        //                     result.dismiss === Swal.DismissReason.cancel
        //                 ) {
        //                     swalWithBootstrapButtons.fire({
        //                         title: "Đã hủy",
        //                         text: "Xóa không thành công !",
        //                         icon: "error",
        //                         showConfirmButton: false,
        //                         timer: 1400
        //                     });
        //                 }
        //             });

        //         });
        //     });
        // });
    </script>

    <script type="module">
        var btn_delete = $('.delete_img');
        btn_delete.each(function() {
            var id = $(this).attr('data-id');
            var route = $(this).attr('route');
            $(this).on('click', function(e) {
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: "btn btn-success",
                        cancelButton: "btn btn-danger"
                    },
                    buttonsStyling: false
                });
                swalWithBootstrapButtons.fire({
                    title: "Bạn có muốn xóa không ?",
                    text: "Xóa không thể hoàn nguyên điều này!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Xóa",
                    cancelButtonText: "Hủy",
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        axios.post(route)
                            .then(function() {
                                swalWithBootstrapButtons.fire({
                                    title: "Xóa thành công !",
                                    text: "Đã xóa ảnh",
                                    icon: "success",
                                    showConfirmButton: false,
                                    timer: 1400
                                });
                            })

                    } else if (
                        /* Read more about handling dismissals below */
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                        swalWithBootstrapButtons.fire({
                            title: "Đã hủy thành công !",
                            text: "Hủy thành công",
                            icon: "error",
                            showConfirmButton: false,
                            timer: 1400
                        });
                    }
                });

            });

        })

        Echo.channel('delete-image-product')
            .listen('DeleteImageProduct', (e) => {
                console.log(e);
                let product = $('#image_preview_' + e.image.id);
                product.remove();
            })
    </script>
@endsection
