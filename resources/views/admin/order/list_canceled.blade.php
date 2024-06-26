@extends('admin.layout.app')
@section('title', 'Đơn hàng hoàn thành')

@section('main')
    <div class="row">
        <div class="col-md-12 m-b-30">
            <!-- begin page title -->
            <div class="d-block d-sm-flex flex-nowrap align-items-center">
                <div class="page-title mb-2 mb-sm-0">
                    <h1>Đơn hàng hoàn thành</h1>
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
                            <li class="breadcrumb-item active text-primary" aria-current="page">Đơn hàng chờ xác nhận
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
                    <div class="datatable-wrapper table-responsive" id="no_data_confirm">
                        @if (count($orderCanceled) != 0)
                            <table id="datatable" class="table text-center table-striped table-bordered">
                                <thead class="table-dark">
                                    <tr>
                                        <th>STT</th>
                                        <th>Mã đơn hàng</th>
                                        <th>Đặt lúc</th>
                                        <th>Địa chỉ</th>
                                        <th>Tổng tiền</th>
                                        <th>Trạng thái</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody class="text-dark">
                                    @foreach ($orderCanceled as $key => $item)
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
                                            <td>{{ number_format($item->total_price, 0, '', '.') }}₫</td>
                                            <td>
                                                <div id="render_order_status-{{ $item->id }}">
                                                    @if ($item->status == 1)
                                                        <b class="badge badge-info">Chờ xác nhận</b>
                                                    @elseif($item->status == 2)
                                                        <b class="badge badge-secondary">Vận chuyển</b>
                                                    @elseif($item->status == 3)
                                                        <b class="badge badge-primary">Chờ giao hàng</b>
                                                    @elseif($item->status == 4)
                                                        <b class="badge badge-success">Hoàn thành</b>
                                                    @elseif($item->status == 5)
                                                        <b class="badge badge-danger">Đã hủy</b>
                                                    @elseif($item->status == 6)
                                                        <b class="badge badge-warning">Trả hàng và hoàn tiền</b>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    <button data-toggle="modal" data-target="#modalDetailOrder"
                                                        class="btn btn-primary btn_see_more"
                                                        data-id="{{ $item->id }}">Xem
                                                        thêm</button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        @else
                            <div class="text-center pt-5" @style('height: 600px;')>
                                <img width="300px" src="{{ asset('assets_ad/img/no_order.png') }}" alt="">
                                <h4 class="mt-5 text-opacity-75">Chưa có đơn hàng</h4>
                            </div>
                        @endif

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
        $(document).ready(function() {

            $(document).on('click', '#btn_update_status', function() {
                var id = $(this).data('id');
                var status = $(this).data('status');
                var elementTr = $(this).closest('tr');

                $.ajax({
                    type: "Post",
                    url: "{{ route('orderUpdateStatus') }}",
                    data: {
                        id: id,
                        status: status,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(data) {
                        console.log(data);
                        elementTr.remove()

                        const Toast = Swal.mixin({
                            toast: true,
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.onmouseenter = Swal.stopTimer;
                                toast.onmouseleave = Swal.resumeTimer;
                            }
                        });
                        Toast.fire({
                            icon: "success",
                            title: "Đã thay đổi trạng thái đơn hàng !"
                        });

                    }
                })
            })


            // xem chi tiet
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
                        $('#render_order_detail').html(data.view);
                    }
                })

            })


        })
    </script>
@endsection
