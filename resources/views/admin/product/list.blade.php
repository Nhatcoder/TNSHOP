@extends('admin.layout.app')
@section('title', 'Sản phẩm')

@section('style')
    <link rel='stylesheet'
        href='https://raw.githack.com/SochavaAG/example-mycode/master/pens/slick-slider/plugins/slick/slick.css'>

    <style>
        ul {
            margin: 0;
            padding: 0;
        }

        .layout {
            width: 100%;
            cursor: grab;
            position: relative;
        }

        .layout a {
            color: #666;
        }

        .slide {
            display: none;
        }

        .slide li {
            list-style: none;
        }

        .slide.slick-initialized {
            display: block;
        }

        .slick-dots {
            margin-top: 5px;
            margin-left: -5px;
            margin-right: -5px;
            display: flex;
            justify-content: center;
        }

        .slick-dots li {
            display: inline-block;
            max-height: 56px;
            max-width: 112px;
            margin: 5px;
        }

        .slick-dots li img {
            height: auto;
            width: 100%;

            cursor: pointer;

            opacity: 0.5;
        }

        .slick-dots li.slick-active img {
            cursor: default;

            opacity: 1;
        }

        .slick-prev,
        .slick-next {
            margin: -50px 0 0;

            z-index: 99;
            position: absolute;
            top: 50%;
        }

        .slick-prev {
            left: -50px;
        }

        .slick-next {
            right: -50px;
        }

        .icon {
            display: inline-block;
            height: 50px;
            width: 50px;
        }

        .icon__cnt {
            height: 100%;
            width: 100%;
        }

        @media only screen and (max-width: 767px) {
            .ag-format-container {
                width: 96%;
            }

        }

        @media only screen and (max-width: 639px) {}

        @media only screen and (max-width: 479px) {}

        @media (min-width: 768px) and (max-width: 979px) {
            .ag-format-container {
                width: 750px;
            }

        }

        @media (min-width: 980px) and (max-width: 1161px) {
            .ag-format-container {
                width: 960px;
            }

        }
    </style>
@endsection

@section('main')
    @if (session('success'))
        <script>
            Swal.fire({
                icon: "success",
                title: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 1600
            });
        </script>
    @endif

    <!-- begin row -->
    <div class="row">
        <div class="col-md-12 m-b-30">
            <!-- begin page title -->
            <div class="d-block d-sm-flex flex-nowrap align-items-center">
                <div class="page-title mb-2 mb-sm-0">
                    <h1>Danh sách sản phẩm</h1>
                </div>
                <div class="ml-auto d-flex align-items-center">
                    <nav>
                        <ol class="breadcrumb p-0 m-b-0">
                            <li class="breadcrumb-item">
                                <a href="index.html"><i class="ti ti-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                Admin
                            </li>
                            <li class="breadcrumb-item active text-primary" aria-current="page">Danh sách sản phẩm
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <a class="btn btn-primary mt-2" href="{{ route('product.create') }}">Thêm sản phẩm</a>
            <!-- end page title -->
        </div>
    </div>
    <!-- end row -->
    <!-- begin row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-statistics">
                <div class="card-body">
                    <div class="datatable-wrapper table-responsive list-products">
                        <table id="datatable" class="table table-striped table-bordered text-center">
                            <thead class="table-dark">
                                <tr>
                                    <th>STT</th>
                                    <th>Hình ảnh</th>
                                    <th>Tên</th>
                                    <th>Danh mục</th>
                                    <th>Giá cũ</th>
                                    <th>Giá mua</th>
                                    <th>Thời gian tạo</th>
                                    <th>Hot</th>
                                    <th>Trạng thái</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody class="text-dark">
                                @foreach ($product as $key => $item)
                                    <tr>
                                        @php
                                            $getProductSingle = App\Models\Product::getProductSingle($item->id);
                                            $getProductImage = $getProductSingle->singleImage($getProductSingle->id);
                                        @endphp
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                            <img width="80px" src="{{ $getProductImage->checkImage() }}"
                                                alt="{{ $item->title }}">
                                        </td>
                                        <td>{{ Illuminate\Support\Str::limit($item->title, 20, '...') }}</td>
                                        <td>{{ $item->category_name }}</td>
                                        <td>
                                            <p class="text-decoration-line-through">
                                                {{ number_format($item->old_price, 0, ',', '.') }}₫</p>
                                        </td>
                                        <td>{{ number_format($item->price, 0, ',', '.') }}₫</td>
                                        <td>{{ date('Y-m-d', strtotime($item->created_at)) }}</td>
                                        <td>
                                            <div class="checkbox checbox-switch switch-warning">
                                                <label id="render_hot">
                                                    @if ($item->hot == 1)
                                                        <input type="checkbox" class="hot"
                                                            data-hot="{{ $item->hot }}" data-id="{{ $item->id }}"
                                                            name="hot" checked="" />
                                                        <span></span>
                                                        <b class="badge badge-warning">Hiện</b>
                                                    @elseif($item->hot == 0)
                                                        <input type="checkbox" class="hot"
                                                            data-hot="{{ $item->hot }}" data-id="{{ $item->id }}"
                                                            name="hot" />
                                                        <span></span>
                                                        <b class="badge badge-secondary">Ẩn</b>
                                                    @endif
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="checkbox checbox-switch switch-success">
                                                <label id="render_status">
                                                    @if ($item->status == 1)
                                                        <input type="checkbox" class="status"
                                                            data-status="{{ $item->status }}"
                                                            data-id="{{ $item->id }}" name="status" checked="" />
                                                        <span></span>
                                                        <b class="badge badge-success">Hiện</b>
                                                    @else
                                                        <input type="checkbox" class="status"
                                                            data-status="{{ $item->status }}"
                                                            data-id="{{ $item->id }}" name="status" />
                                                        <span></span>
                                                        <b class="badge badge-danger">Ẩn</b>
                                                    @endif
                                                </label>
                                            </div>

                                        </td>
                                        <td>
                                            <a title="Sửa" href="{{ route('product.edit', ['product' => $item->id]) }}"
                                                class="btn btn-icon btn-outline-primary btn-round mr-2 mb-2 mb-sm-0 "><i
                                                    class="ti ti-pencil"></i></a>
                                            <button title="Xem chi tiết" data-toggle="modal" data-target="#detailProduct"
                                                data-id="{{ $item->id }}"
                                                class="btn btn-icon btn-outline-info btn-round btn_view_detail"><i
                                                    class="ion ion-md-eye"></i></button>
                                            <button title="Xóa" data-id="{{ $item->id }}"
                                                class="btn btn-icon btn-outline-danger btn-round delete-product"><i
                                                    class="ti ti-close"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- detail product --}}
    <div class="modal fade p-0" id="detailProduct" tabindex="-1" role="dialog" aria-labelledby="detailProduct"
        aria-hidden="true">
        <div class="modal-dialog modal-fullscreen" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Chi tiết sản phẩm</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="see_detail_product"></div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Trở về</button>
                </div>
            </div>
        </div>
    </div>

    <!-- end row -->


@endsection

@section('script')
    <script>
        (function() {
            const container = document.querySelector('.list-products');
            let isDragging = false;
            let startX;
            let scrollLeft;

            container.addEventListener('mousedown', (e) => {
                isDragging = true;
                startX = e.pageX - container.offsetLeft;
                scrollLeft = container.scrollLeft;
            });

            container.addEventListener('mouseleave', () => {
                isDragging = false;
            });

            container.addEventListener('mouseup', () => {
                isDragging = false;
            });

            container.addEventListener('mousemove', (e) => {
                if (!isDragging) return;
                e.preventDefault();
                const x = e.pageX - container.offsetLeft;
                const walk = (x - startX) * 2;
                container.scrollLeft = scrollLeft - walk;
            });
        }())

        // update product hot
        $(document).on('click', '.hot', function() {
            var id = $(this).attr('data-id');
            var element = $(this).closest("#render_hot");
            var hot = $(this).attr('data-hot');

            console.log(element);
            $.ajax({
                type: "POST",
                url: "{{ route('updateHotProduct') }}",
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    if (hot == 1) {
                        var result = `
                            <input type="checkbox" class="hot"
                                data-hot="0" data-id="${id}"
                                name="hot" />
                            <span></span>
                            <b class="badge badge-secondary">Ẩn</b>
                        `
                        element.html(result);
                    } else {
                        var result = `
                            <input type="checkbox" class="hot"
                                data-hot="1" data-id="${id}"
                                name="hot" checked="" />
                            <span></span>
                            <b class="badge badge-warning">Hiện</b>
                        `
                        element.html(result);
                    }

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
                        title: "Cập nhật sản phẩm hot thành công"
                    });
                }
            })
        })

        // update product status
        $(document).on('click', '.status', function() {
            var id = $(this).attr('data-id');
            var element = $(this).closest("#render_status");
            var status = $(this).attr('data-status');

            $.ajax({
                type: "POST",
                url: "{{ route('updateStatusProduct') }}",
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    if (status == 1) {
                        var resultStatus = `
                            <input type="checkbox" class="status"
                                data-status="0" data-id="${id}"
                                name="status" />
                            <span></span>
                            <b class="badge badge-secondary">Ẩn</b>
                        `
                        element.html(resultStatus);
                    } else {
                        var resultStatus = `
                            <input type="checkbox" class="status"
                                data-status="1" data-id="${id}"
                                name="status" checked="" />
                            <span></span>
                            <b class="badge badge-success">Hiện</b>
                        `
                        element.html(resultStatus);
                    }

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
                        title: "Cập nhật trạng thái thành công"
                    });
                }
            })
        })

        // view detail product
        $(document).on('click', '.btn_view_detail', function() {
            var id = $(this).attr('data-id');
            $.ajax({
                url: "{{ route('seeProductDetail') }}",
                type: 'POST',
                data: {
                    id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    $('#see_detail_product').html(data.view);
                }
            })


        })

        // delete product
        $(document).ready(function() {
            $(".delete-product").each(function() {
                $(this).click(function() {
                    var id = $(this).attr('data-id');

                    var row = $(this).closest('tr');

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
                            row.fadeOut();

                            $.ajax({
                                url: "{{ route('product.destroy', ':id') }}"
                                    .replace(':id', id),
                                type: 'DELETE',
                                data: {
                                    _token: "{{ csrf_token() }}",
                                },
                                success: function(response) {
                                    swalWithBootstrapButtons.fire({
                                        title: "Đã xóa",
                                        text: "Xóa không thành công !",
                                        icon: "success",
                                        showConfirmButton: false,
                                        timer: 1400
                                    });
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


                })
            })
        })
    </script>

@endsection
