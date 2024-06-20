@extends('admin.layout.app')
@section('title', 'Sản phẩm')

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
                        <table id="datatable" class="table table-striped table-bordered">
                            <thead class="table-dark">
                                <tr>
                                    <th>STT</th>
                                    <th>Tên</th>
                                    <th>Slug</th>
                                    <th>Danh mục</th>
                                    <th>Danh mục phụ</th>
                                    <th>Thương hiệu</th>
                                    <th>Giá cũ</th>
                                    <th>Giá</th>
                                    <th>Nguời tạo</th>
                                    <th>Mô tả ngắn</th>
                                    <th>Mô tả</th>
                                    <th>Thông tin thêm</th>
                                    <th>Đơn vị trả hàng</th>
                                    <th>Thời gian tạo</th>
                                    <th>Trạng thái</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody class="text-dark">
                                @foreach ($product as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ Illuminate\Support\Str::limit($item->title, 20, '...') }}</td>
                                        <td>{{ Illuminate\Support\Str::limit($item->slug, 20, '...') }}</td>
                                        <td>{{ $item->category_name }}</td>
                                        <td>{{ $item->sub_category_name }}</td>
                                        <td>{{ $item->brand_name }}</td>
                                        <td>{{ $item->old_price }}</td>
                                        <td>{{ $item->price }}</td>
                                        <td>Tớ tạo</td>
                                        <td>
                                            {{ strlen($item->short_description) >= 50 ? substr($item->short_description, 0, 50) . '...' : $item->short_description }}
                                        </td>
                                        <td>{{ Illuminate\Support\Str::limit($item->description, 50, '...') }}</td>
                                        <td>{{ Illuminate\Support\Str::limit($item->additional_information, 50, '...') }}
                                        </td>
                                        <td>
                                            {{ strlen($item->shipping_returns) >= 50 ? substr($item->shipping_returns, 0, 50) . '...' : $item->shipping_returns }}
                                        </td>
                                        <td>{{ date('Y-m-d', strtotime($item->created_at)) }}</td>
                                        <td>
                                            @if ($item->status == 1)
                                                <b class="badge badge-success">Hiện</b>
                                            @else
                                                <b class="badge badge-danger">Ẩn</b>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('product.edit', ['product' => $item->id]) }}"
                                                    class="btn btn-info  ">Sửa</a>
                                                <button type="button" data-id="{{ $item->id }}"
                                                    class="btn btn-danger delete-product">Xóa</button>
                                            </div>
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
    <!-- end row -->

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
