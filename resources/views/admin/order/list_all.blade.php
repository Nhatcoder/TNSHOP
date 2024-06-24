@extends('admin.layout.app')
@section('title', 'Đơn hàng')

@section('main')
    <div class="row">
        <div class="col-md-12 m-b-30">
            <!-- begin page title -->
            <div class="d-block d-sm-flex flex-nowrap align-items-center">
                <div class="page-title mb-2 mb-sm-0">
                    <h1>Tất cả đơn hàng</h1>
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
                            <li class="breadcrumb-item active text-primary" aria-current="page">Đơn hàng
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!-- end page title -->
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-statistics">
                <div class="card-body">
                    <div class="datatable-wrapper table-responsive">
                        <table id="datatable" class="table text-center table-striped table-bordered">
                            <thead class="table-dark">
                                <tr>
                                    <th>STT</th>
                                    <th>Mã đơn hàng</th>
                                    <th>Đặt lúc</th>
                                    <th>Địa chỉ</th>
                                    <th>Số sản phẩm</th>
                                    <th>Tổng tiền</th>
                                    <th>Trạng thái</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody class="text-dark">
                                @foreach ($orderAll as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->code_order }}</td>
                                        <td>{{ $item->created_at }}</td>
                                        <td class="text-left"><b>Họ tên:
                                                {{ $item->name }}</b><br>
                                            Sđt: {{ $item->phone }} <br>
                                            {{ $item->city . '-' . $item->district . '-' . $item->ward }} <br>
                                            {{ $item->home_address }}
                                        </td>
                                        <td>12</td>
                                        <td>{{ number_format($item->total_price, 0, '', '.') }}₫</td>
                                        <td>
                                            <div class="form-group">
                                                <select name="" class="form-select" id="">
                                                    <option value="1">Chờ xác nhận</option>
                                                    <option value="2">Vận chuyển</option>
                                                    <option value="3">Chờ giao hàng</option>
                                                    <option value="4">Hoàn thành</option>
                                                    <option value="5">Đã hủy</option>
                                                    <option value="6">Hoàn trả và hoàn tiền</option>
                                                </select>
                                            </div>
                                        </td>
                                        <td><button data-toggle="modal" data-target="#modalDetailOrder"
                                                class="btn btn-primary btn_see_more" data-id="{{ $item->id }}">Xem
                                                thêm</button></td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- modal detail order --}}
    <div class="modal fade" id="modalDetailOrder" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content" id="render_order_detail">


            </div>
        </div>
    </div>

    
@endsection

@section('script')
    <script>
        $(document).on('click', '.btn_see_more', function() {
            var id = $(this).data('id');

            $.ajax({
                type: "Post",
                url: "{{ route('adminOrderDetail') }}",
                data: {
                    id: id,
                    _token: "{{ csrf_token() }}"
                },
                success: function(data) {
                    console.log(data);
                    $('#render_order_detail').html(data.view);
                }
            })

        })
    </script>
@endsection
