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
            <form action="{{ route('product.store') }}" method="post" class="form-horizontal" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label class="control-label" for="name">Tên</label>
                            <div class="mb-2">
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                    oninput="ChangeToSlug()" id="name" name="title" value ="{{ old('title') }}"
                                    placeholder="Điền ..." />
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
                                    placeholder="Điền ..." value ="{{ old('slug') }}" readonly />
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
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
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
                                    <option value="0">Ẩn</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label class="control-label" for="">Thương hiệu</label>
                            <div class="mb-2">
                                <select name="brand_id" class="form-control @error('brand_id') is-invalid @enderror">
                                    <option value="" selected disabled>Chọn thương hiện</option>
                                    @foreach ($brand as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('brand_id')
                                    <em class="text-danger" style="">{{ $message }}</em>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- <div class="form-group">
                    <label class="control-label" for="">Màu sắc</label>
                    <div class="d-flex">
                        @foreach ($color as $item)
                            <div class="form-check pr-3">
                                <input class="form-check-input"
                                    {{ is_array(old('color_id')) && in_array($item->id, old('color_id')) ? 'checked' : '' }}
                                    value="{{ $item->id }}" name="color_id[]" type="checkbox"
                                    id="check-{{ $item->id }}">
                                <label class="form-check-label" for="check-{{ $item->id }}">
                                    {{ $item->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                    @error('color_id')
                        <em class="text-danger" style="">{{ $message }}</em>
                    @enderror
                </div> --}}

                <label class="control-label" for="">Màu sắc</label>
                <table class="table table-hover ">
                    <thead>
                        <tr>
                            <th>Hình ảnh</th>
                            <th>Tên màu sắc</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody id="AppendColor">
                        <tr>
                            <td>
                                <input type="file" class="d-none" id="image_color_1" name="color[100][color_image]" value=""
                                    accept="image/*">
                                <label class="render_img_color" for="image_color_1">
                                    <img id="preview_image_color_1" width="80px"
                                        src="{{ asset('assets_ad/img/color_img.jpg') }}" alt="">
                                </label>
                            </td>
                            <td><input type="text" class="form-control" name="color[100][color_name]" placeholder="Điền..."></td>
                            <td>
                                <button type="button" class="btn btn-success AddColor">Thêm</button>
                            </td>
                        </tr>
                    </tbody>

                </table>

                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label class="control-label" for="">Giá gốc</label>
                            <div class="mb-2">
                                <input type="text" id=""
                                    class="form-control @error('old_price') is-invalid @enderror" name="old_price"
                                    placeholder="Điền ..." value ="{{ old('old_price') }}" />
                                @error('old_price')
                                    <em class="text-danger" style="">{{ $message }}</em>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label class="control-label" for="">Giá khuyến mại</label>
                            <div class="mb-2">
                                <input type="text" id=""
                                    class="form-control @error('price') is-invalid @enderror" name="price"
                                    placeholder="Điền ..." value ="{{ old('price') }}" />
                                @error('price')
                                    <em class="text-danger" style="">{{ $message }}</em>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <style>
                    .delete_image__product {
                        position: absolute;
                        top: 24px;
                        right: 30px;
                    }

                    .close_image {
                        font-size: 16px;
                        color: #f00;
                        font-weight: 700;
                        cursor: pointer;
                    }
                </style>

                <div class="mb-3">
                    <label class="control-label" for="">Hình ảnh</label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror"
                        onchange="previewImages(this)" id="image" name="image[]" value="{{ old('image') }}"
                        multiple accept="image/*">
                    @error('image')
                        <em class="text-danger" style="">{{ $message }}</em>
                    @enderror
                </div>
                <div class="row" id="image-preview">
                    <!-- Placeholder for preview images -->
                </div>


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
                        <textarea type="text" class="form-control" name="short_description">
                        </textarea>
                        @error('short_description')
                            <em class="text-danger" style="">{{ $message }}</em>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="">Mô tả</label>
                    <div class="mb-2">
                        <textarea type="text" id="description" class="form-control " name="description" placeholder="Điền ...">
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
                        </textarea>
                        @error('shipping_returns')
                            <em class="text-danger" style="">{{ $message }}</em>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="">Thông tin thêm</label>
                    <div class="mb-2">
                        <textarea id="additional_information" class="form-control" name="additional_information" placeholder="Điền ...">
                        </textarea>
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
                    <button type="submit" class="btn btn-primary">Thêm mới</button>
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
            $('#image_color_1').on('change', function() {
                handleFileInputChange(this, '#preview_image_color_1');
            });

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
        // $('.AddSize').on('click', function() {
        var i = 100;
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
    </script>
@endsection
