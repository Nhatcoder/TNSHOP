@extends('user.layout.main')

@section('style')
@endsection

@section('main')
    <main class="main">
        <div class="page-header text-center"
            style="background-image: url('{{ asset('') }}assets_fe/images/page-header-bg.jpg')">
            <div class="container">
                <h1 class="page-title">Tài khoản<span>{{ Auth::user()->name }}</span></h1>
            </div>
        </div>
        <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a href="#">Tài khoản</a></li>
                    {{-- <li class="breadcrumb-item active" aria-current="page"></li> --}}
                </ol>
            </div>
        </nav>

        <div class="page-content">
            <div class="dashboard">
                <div class="container">
                    <div class="row">
                        <aside class="col-md-4 col-lg-2">
                            <ul class="nav nav-dashboard flex-column mb-3 mb-md-0" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link " id="tab-dashboard-link" data-toggle="tab" href="#tab-dashboard"
                                        role="tab" aria-controls="tab-dashboard" aria-selected="true">Hồ sơ</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" id="tab-orders-link" data-toggle="tab" href="#tab-orders"
                                        role="tab" aria-controls="tab-orders" aria-selected="false">Đơn mua</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab-downloads-link" data-toggle="tab" href="#tab-downloads"
                                        role="tab" aria-controls="tab-downloads" aria-selected="false">Sản phẩm vừa
                                        xem</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " id="tab-address-link" data-toggle="tab" href="#tab-address"
                                        role="tab" aria-controls="tab-address" aria-selected="false">Địa chỉ</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab-account-link" data-toggle="tab" href="#tab-account"
                                        role="tab" aria-controls="tab-account" aria-selected="false">Cập nhật tài
                                        khoản</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('user_logout') }}">Đăng xuất</a>
                                </li>
                            </ul>
                        </aside>

                        <div class="col-md-8 col-lg-10">
                            <div class="tab-content">
                                <div class="tab-pane fade " id="tab-dashboard" role="tabpanel"
                                    aria-labelledby="tab-dashboard-link">
                                    <h3>Hồ sơ của tôi</h3>
                                    <p>Quản lý thông tin hồ sơ để bảo mật tài khoản</p>
                                    <form action="">
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="form-group">
                                                    <label for="account-fn">Tên</label>
                                                    <input type="text" class="form-control" id="account-fn"
                                                        value="{{ Auth::user()->name }}" name="name" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="account-fn">Email</label>
                                                    <input type="text" class="form-control" id="account-fn"
                                                        value="{{ Auth::user()->email }}" name="name" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="account-fn">Số điện thoại @if (Auth::user()->phone == null)
                                                            <b class="text-primary">(Thêm mới)</b>
                                                        @endif
                                                    </label>
                                                    <input type="text" class="form-control" id="account-fn"
                                                        value="{{ Auth::user()->phone }}" name="name" required>
                                                </div>

                                                <label for="">Giới tính @if (Auth::user()->sex == null)
                                                    @endif
                                                    <b class="text-primary">(Thêm mới)</b></label>
                                                <div class="d-flex">
                                                    <div class="payment_item">
                                                        <input type="radio" name="sex" value="nam"
                                                            class="type_payment" id="payment_cash">
                                                        <label class="custome-control-label label_payment"
                                                            for="payment_cash">Nam</label>
                                                    </div>
                                                    <div class="payment_item">
                                                        <input type="radio" name="sex" value="nu"
                                                            class="type_payment" id="payment_vnpay">
                                                        <label class="custome-control-label label_payment"
                                                            for="payment_vnpay">Nữ</label>
                                                    </div>
                                                    <div class="payment_item">
                                                        <input type="radio" name="sex" class="type_payment"
                                                            id="payment_momo" value="khac">
                                                        <label class="custome-control-label label_payment"
                                                            for="payment_momo">Khác</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <article class="entry entry-grid">
                                                    <figure class="entry-media">
                                                        <a href="single.html">
                                                            {{-- <img src="{{ asset('') }}assets_fe/images/blog/3cols/post-1.jpg"
                                                                alt="image desc"> --}}
                                                            <img src="{{ Auth::user()->avatar }}" alt="">
                                                        </a>
                                                    </figure>

                                                    <div class="entry-body text-center">
                                                        <h2 class="entry-title">
                                                            <button class="btn btn-primary">Đổi ảnh</button>
                                                        </h2>

                                                        <div class="entry-content">
                                                            <p>Dụng lượng file tối đa 5 MB</p>
                                                        </div>
                                                    </div>
                                                </article>
                                            </div>



                                        </div>
                                        <div class="mt-3">
                                            <button class="btn btn-outline-primary-2"><span>Cập nhật</span><i
                                                    class="icon-long-arrow-right"></i></button>
                                        </div>
                                    </form>
                                </div><!-- .End .tab-pane -->

                                <div class="tab-pane fade active show" id="tab-orders" role="tabpanel"
                                    aria-labelledby="tab-orders-link">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <ul class="nav nav-pills" id="tabs-5" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" id="tab-16-tab" data-toggle="tab"
                                                        href="#tab-16" role="tab" aria-controls="tab-16"
                                                        aria-selected="true">Tất cả</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="tab-17-tab" data-toggle="tab" href="#tab-17"
                                                        role="tab" aria-controls="tab-17" aria-selected="true">Chờ
                                                        xác nhận</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="tab-18-tab" data-toggle="tab" href="#tab-18"
                                                        role="tab" aria-controls="tab-18" aria-selected="false">Vận
                                                        chuyển</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="tab-19-tab" data-toggle="tab" href="#tab-19"
                                                        role="tab" aria-controls="tab-19" aria-selected="false">Chờ
                                                        giao hàng</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="tab-20-tab" data-toggle="tab" href="#tab-20"
                                                        role="tab" aria-controls="tab-20" aria-selected="false">Hoàn
                                                        thành</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link list_order_cancel" id="tab-21-tab"
                                                        data-toggle="tab" href="#tab-21" role="tab"
                                                        aria-controls="tab-21" aria-selected="false">Đã
                                                        hủy</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="tab-22-tab" data-toggle="tab" href="#tab-22"
                                                        role="tab" aria-controls="tab-22" aria-selected="false">Trả
                                                        hàng và hoàn tiền</a>
                                                </li>
                                            </ul>
                                            <div class="tab-content" id="tab-content-5">
                                                <div class="tab-pane fade show active" id="tab-16" role="tabpanel"
                                                    aria-labelledby="tab-16-tab">
                                                    <form action="#" id="search-orders-form">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control"
                                                                placeholder="Bạn có thể tìm kiếm theo mã đơn hàng "
                                                                aria-label="Search for..." required id="keyword_order">
                                                            <div class="input-group-append">
                                                                <button class="btn btn-primary btn-rounded"
                                                                    type="submit"><span>Tìm kiếm</span><i
                                                                        class="icon-long-arrow-right"></i></button>
                                                            </div>
                                                        </div>
                                                    </form>

                                                    <div id="render_order">
                                                        @if (count($orders) > 0)
                                                            <table
                                                                class="table text-center table-mobile table-striped table-hover">
                                                                <thead class="table-light">
                                                                    <tr>
                                                                        <th>Mã đơn hàng</th>
                                                                        <th>Số điện thoại</th>
                                                                        <th>Tổng giá</th>
                                                                        <th>Trạng thái</th>
                                                                        <th>Ngày mua</th>
                                                                        <th>Thao tác</th>
                                                                    </tr>
                                                                </thead>

                                                                <tbody id="render_order">
                                                                    @foreach ($orders as $order)
                                                                        <tr>
                                                                            <td>{{ $order->code_order }}</td>
                                                                            <td>{{ $order->phone }}</td>
                                                                            <td>{{ number_format($order->total_price, 0, '', '.') }}₫
                                                                            </td>
                                                                            <td>
                                                                                @if ($order->status == 1)
                                                                                    <b class="badge badge-primary p-2">Chờ
                                                                                        xác
                                                                                        nhận</b>
                                                                                @elseif($order->status == 2)
                                                                                    <b class="badge badge-info p-2">Vận
                                                                                        chuyển
                                                                                    </b>
                                                                                @elseif($order->status == 3)
                                                                                    <b class="badge badge-secondary p-2">Chờ
                                                                                        giao
                                                                                        hàng
                                                                                    </b>
                                                                                @elseif($order->status == 4)
                                                                                    <b class="badge badge-success p-2">Hoàn
                                                                                        thành
                                                                                    </b>
                                                                                @elseif($order->status == 5)
                                                                                    <b class="badge badge-danger p-2">Đã
                                                                                        hủy
                                                                                    </b>
                                                                                @else
                                                                                    <b class="badge badge-warning p-2">Trả
                                                                                        hàng/Hoàn
                                                                                        tiền
                                                                                    </b>
                                                                                @endif
                                                                            </td>
                                                                            <td>{{ $order->created_at }}</td>

                                                                            <td>
                                                                                <a href="#order-detail-modal"
                                                                                    data-toggle="modal"
                                                                                    data-id="{{ $order->id }}"
                                                                                    class="btn btn-primary btn-order-detail">Xem
                                                                                    thêm</a>
                                                                                @if ($order->status == 1)
                                                                                    <button
                                                                                        class="btn btn-danger btn_cancel_order"
                                                                                        data-id="{{ $order->id }}">Hủy
                                                                                        đơn</button>
                                                                                @elseif($order->status == 4)
                                                                                    @if ($order->is_review == 0)
                                                                                        <a href="#modal-review-order"
                                                                                            data-toggle="modal"
                                                                                            data-id="{{ $order->id }}"
                                                                                            class="btn btn-info btn_review_order">Đánh
                                                                                            giá</a>
                                                                                    @else
                                                                                        <a href="#modal-review-order-detail"
                                                                                            data-toggle="modal"
                                                                                            data-id="{{ $order->id }}"
                                                                                            class="btn btn-info btn_review_order_detail">Xem
                                                                                            đánh giá</a>
                                                                                    @endif
                                                                                @endif
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach

                                                                </tbody>
                                                            </table>
                                                        @endif
                                                    </div>


                                                </div>

                                                <div class="tab-pane fade " id="tab-17" role="tabpanel"
                                                    aria-labelledby="tab-17-tab">
                                                    <div class="render_confirmation">
                                                        <table
                                                            class="table text-center table-mobile table-striped table-hover">
                                                            <thead class="table-light">
                                                                <tr>
                                                                    <th>Mã đơn hàng</th>
                                                                    <th>Số điện thoại</th>
                                                                    <th>Tổng giá</th>
                                                                    <th>Trạng thái</th>
                                                                    <th>Ngày mua</th>
                                                                    <th>Thao tác</th>
                                                                </tr>
                                                            </thead>

                                                            <tbody>
                                                                @foreach ($ordersConfirm as $order)
                                                                    <tr>
                                                                        <td>{{ $order->code_order }}</td>
                                                                        <td>{{ $order->phone }}</td>
                                                                        <td>{{ number_format($order->total_price, 0, '', '.') }}₫
                                                                        </td>
                                                                        <td>
                                                                            @if ($order->status == 1)
                                                                                <b class="badge badge-primary p-2">Chờ xác
                                                                                    nhận</b>
                                                                            @elseif($order->status == 2)
                                                                                <b class="badge badge-info p-2">Vận chuyển
                                                                                </b>
                                                                            @elseif($order->status == 3)
                                                                                <b class="badge badge-secondary p-2">Chờ
                                                                                    giao
                                                                                    hàng
                                                                                </b>
                                                                            @elseif($order->status == 4)
                                                                                <b class="badge badge-success p-2">Hoàn
                                                                                    thành
                                                                                </b>
                                                                            @elseif($order->status == 5)
                                                                                <b class="badge badge-danger p-2">Đã hủy
                                                                                </b>
                                                                            @else
                                                                                <b class="badge badge-warning p-2">Trả
                                                                                    hàng/Hoàn
                                                                                    tiền
                                                                                </b>
                                                                            @endif
                                                                        </td>
                                                                        <td>{{ $order->created_at }}</td>

                                                                        <td>
                                                                            <a href="#order-detail-modal"
                                                                                data-toggle="modal"
                                                                                data-id="{{ $order->id }}"
                                                                                class="btn btn-primary btn-order-detail">Xem
                                                                                thêm</a>
                                                                            <button class="btn btn-danger">Hủy đơn</button>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach

                                                            </tbody>
                                                        </table>

                                                    </div>


                                                </div><!-- .End .tab-pane -->

                                                <div class="tab-pane fade" id="tab-18" role="tabpanel"
                                                    aria-labelledby="tab-18-tab">
                                                    <table
                                                        class="table text-center table-mobile table-striped table-hover">
                                                        <thead class="table-light">
                                                            <tr>
                                                                <th>Mã đơn hàng</th>
                                                                <th>Số điện thoại</th>
                                                                <th>Tổng giá</th>
                                                                <th>Trạng thái</th>
                                                                <th>Ngày mua</th>
                                                                <th>Thao tác</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                            @foreach ($orderTransport as $order)
                                                                <tr>
                                                                    <td>{{ $order->code_order }}</td>
                                                                    <td>{{ $order->phone }}</td>
                                                                    <td>{{ number_format($order->total_price, 0, '', '.') }}₫
                                                                    </td>
                                                                    <td>
                                                                        @if ($order->status == 1)
                                                                            <b class="badge badge-primary p-2">Chờ xác
                                                                                nhận</b>
                                                                        @elseif($order->status == 2)
                                                                            <b class="badge badge-info p-2">Vận chuyển
                                                                            </b>
                                                                        @elseif($order->status == 3)
                                                                            <b class="badge badge-secondary p-2">Chờ giao
                                                                                hàng
                                                                            </b>
                                                                        @elseif($order->status == 4)
                                                                            <b class="badge badge-success p-2">Hoàn thành
                                                                            </b>
                                                                        @elseif($order->status == 5)
                                                                            <b class="badge badge-danger p-2">Đã hủy
                                                                            </b>
                                                                        @else
                                                                            <b class="badge badge-warning p-2">Trả
                                                                                hàng/Hoàn
                                                                                tiền
                                                                            </b>
                                                                        @endif
                                                                    </td>
                                                                    <td>{{ $order->created_at }}</td>

                                                                    <td>
                                                                        <a href="#order-detail-modal" data-toggle="modal"
                                                                            data-id="{{ $order->id }}"
                                                                            class="btn btn-primary btn-order-detail">Xem
                                                                            thêm</a>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <!-- .End .tab-pane -->

                                                <div class="tab-pane fade" id="tab-19" role="tabpanel"
                                                    aria-labelledby="tab-19-tab">
                                                    <table
                                                        class="table text-center table-mobile table-striped table-hover">
                                                        <thead class="table-light">
                                                            <tr>
                                                                <th>Mã đơn hàng</th>
                                                                <th>Số điện thoại</th>
                                                                <th>Tổng giá</th>
                                                                <th>Trạng thái</th>
                                                                <th>Ngày mua</th>
                                                                <th>Thao tác</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                            @foreach ($orderWaiting as $order)
                                                                <tr>
                                                                    <td>{{ $order->code_order }}</td>
                                                                    <td>{{ $order->phone }}</td>
                                                                    <td>{{ number_format($order->total_price, 0, '', '.') }}₫
                                                                    </td>
                                                                    <td>
                                                                        @if ($order->status == 1)
                                                                            <b class="badge badge-primary p-2">Chờ xác
                                                                                nhận</b>
                                                                        @elseif($order->status == 2)
                                                                            <b class="badge badge-info p-2">Vận chuyển
                                                                            </b>
                                                                        @elseif($order->status == 3)
                                                                            <b class="badge badge-secondary p-2">Chờ giao
                                                                                hàng
                                                                            </b>
                                                                        @elseif($order->status == 4)
                                                                            <b class="badge badge-success p-2">Hoàn thành
                                                                            </b>
                                                                        @elseif($order->status == 5)
                                                                            <b class="badge badge-danger p-2">Đã hủy
                                                                            </b>
                                                                        @else
                                                                            <b class="badge badge-warning p-2">Trả
                                                                                hàng/Hoàn
                                                                                tiền
                                                                            </b>
                                                                        @endif
                                                                    </td>
                                                                    <td>{{ $order->created_at }}</td>

                                                                    <td>
                                                                        <a href="#order-detail-modal" data-toggle="modal"
                                                                            data-id="{{ $order->id }}"
                                                                            class="btn btn-primary btn-order-detail">Xem
                                                                            thêm</a>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div><!-- .End .tab-pane -->

                                                <div class="tab-pane fade" id="tab-20" role="tabpanel"
                                                    aria-labelledby="tab-20-tab">
                                                    <table
                                                        class="table text-center table-mobile table-striped table-hover">
                                                        <thead class="table-light">
                                                            <tr>
                                                                <th>Mã đơn hàng</th>
                                                                <th>Số điện thoại</th>
                                                                <th>Tổng giá</th>
                                                                <th>Trạng thái</th>
                                                                <th>Ngày mua</th>
                                                                <th>Thao tác</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                            @foreach ($orderSuccess as $order)
                                                                <tr>
                                                                    <td>{{ $order->code_order }}</td>
                                                                    <td>{{ $order->phone }}</td>
                                                                    <td>{{ number_format($order->total_price, 0, '', '.') }}₫
                                                                    </td>
                                                                    <td>
                                                                        @if ($order->status == 1)
                                                                            <b class="badge badge-primary p-2">Chờ xác
                                                                                nhận</b>
                                                                        @elseif($order->status == 2)
                                                                            <b class="badge badge-info p-2">Vận chuyển
                                                                            </b>
                                                                        @elseif($order->status == 3)
                                                                            <b class="badge badge-secondary p-2">Chờ giao
                                                                                hàng
                                                                            </b>
                                                                        @elseif($order->status == 4)
                                                                            <b class="badge badge-success p-2">Hoàn thành
                                                                            </b>
                                                                        @elseif($order->status == 5)
                                                                            <b class="badge badge-danger p-2">Đã hủy
                                                                            </b>
                                                                        @else
                                                                            <b class="badge badge-warning p-2">Trả
                                                                                hàng/Hoàn
                                                                                tiền
                                                                            </b>
                                                                        @endif
                                                                    </td>
                                                                    <td>{{ $order->created_at }}</td>

                                                                    <td>
                                                                        <a href="#order-detail-modal" data-toggle="modal"
                                                                            data-id="{{ $order->id }}"
                                                                            class="btn btn-primary btn-order-detail">Xem
                                                                            thêm</a>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div><!-- .End .tab-pane -->

                                                <div class="tab-pane fade" id="tab-21" role="tabpanel"
                                                    aria-labelledby="tab-21-tab">
                                                    <div id="render_order_cancel">

                                                    </div>
                                                </div><!-- .End .tab-pane -->

                                                <div class="tab-pane fade" id="tab-22" role="tabpanel"
                                                    aria-labelledby="tab-22-tab">
                                                    <table
                                                        class="table text-center table-mobile table-striped table-hover">
                                                        <thead class="table-light">
                                                            <tr>
                                                                <th>Mã đơn hàng</th>
                                                                <th>Số điện thoại</th>
                                                                <th>Tổng giá</th>
                                                                <th>Trạng thái</th>
                                                                <th>Ngày mua</th>
                                                                <th>Thao tác</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                            @foreach ($orderRefunds as $order)
                                                                <tr>
                                                                    <td>{{ $order->code_order }}</td>
                                                                    <td>{{ $order->phone }}</td>
                                                                    <td>{{ number_format($order->total_price, 0, '', '.') }}₫
                                                                    </td>
                                                                    <td>
                                                                        @if ($order->status == 1)
                                                                            <b class="badge badge-primary p-2">Chờ xác
                                                                                nhận</b>
                                                                        @elseif($order->status == 2)
                                                                            <b class="badge badge-info p-2">Vận chuyển
                                                                            </b>
                                                                        @elseif($order->status == 3)
                                                                            <b class="badge badge-secondary p-2">Chờ giao
                                                                                hàng
                                                                            </b>
                                                                        @elseif($order->status == 4)
                                                                            <b class="badge badge-success p-2">Hoàn thành
                                                                            </b>
                                                                        @elseif($order->status == 5)
                                                                            <b class="badge badge-danger p-2">Đã hủy
                                                                            </b>
                                                                        @else
                                                                            <b class="badge badge-warning p-2">Trả
                                                                                hàng/Hoàn
                                                                                tiền
                                                                            </b>
                                                                        @endif
                                                                    </td>
                                                                    <td>{{ $order->created_at }}</td>

                                                                    <td>
                                                                        <a href="#order-detail-modal" data-toggle="modal"
                                                                            data-id="{{ $order->id }}"
                                                                            class="btn btn-primary btn-order-detail">Xem
                                                                            thêm</a>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div><!-- .End .tab-pane -->
                                            </div>
                                        </div><!-- End .col-md-6 -->


                                    </div>







                                </div>

                                <div class="tab-pane fade" id="tab-downloads" role="tabpanel"
                                    aria-labelledby="tab-downloads-link">
                                    <p>No downloads available yet.</p>
                                    <a href="category.html" class="btn btn-outline-primary-2"><span>GO SHOP</span><i
                                            class="icon-long-arrow-right"></i></a>
                                </div><!-- .End .tab-pane -->

                                <div class="tab-pane fade" id="tab-address" role="tabpanel"
                                    aria-labelledby="tab-address-link">
                                    <div class="d-flex justify-content-between">
                                        <h3>Địa chỉ của tôi.</h3>
                                        <a href="#add-address" data-toggle="modal" class="btn btn-primary">Thêm địa chỉ
                                            mới</a>
                                    </div>
                                    <div class="card mt-2">
                                        <div class="render_list_address">
                                            @include('user.acount.address.list')
                                        </div>
                                    </div>
                                </div>
                            </div><!-- .End .tab-pane -->

                            <div class="tab-pane fade" id="tab-account" role="tabpanel"
                                aria-labelledby="tab-account-link">
                                {{-- <form action="#">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label>First Name *</label>
                                            <input type="text" class="form-control" required>
                                        </div>

                                        <div class="col-sm-6">
                                            <label>Last Name *</label>
                                            <input type="text" class="form-control" required>
                                        </div>
                                    </div>

                                    <label>Display Name *</label>
                                    <input type="text" class="form-control" required>
                                    <small class="form-text">This will be how your name will be displayed in the
                                        account section and in reviews</small>

                                    <label>Email address *</label>
                                    <input type="email" class="form-control" required>

                                    <label>Current password (leave blank to leave unchanged)</label>
                                    <input type="password" class="form-control">

                                    <label>New password (leave blank to leave unchanged)</label>
                                    <input type="password" class="form-control">

                                    <label>Confirm new password</label>
                                    <input type="password" class="form-control mb-2">

                                    <button type="submit" class="btn btn-outline-primary-2">
                                        <span>SAVE CHANGES</span>
                                        <i class="icon-long-arrow-right"></i>
                                    </button>
                                </form> --}}
                            </div><!-- .End .tab-pane -->
                        </div>
                    </div>
                </div>
            </div>
        </div>



        {{-- modal reviews --}}
        <div class="modal fade" id="modal-review-order" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="dialog">
                <div class="modal-content">
                    <div class="modal-body ">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="icon-close"></i></span>
                        </button>

                        <div class="form-box">
                            <div class="modal-header">
                                <h4>Đánh giá</h4>
                            </div>

                            <div id="render_review_order">

                            </div>


                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-info" class="close" data-dismiss="modal"
                                    aria-label="Close">Trở về</button>
                                <button type="button" class="btn btn-primary" id="save_review">Hoàn thành</button>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>

        {{-- modal order detail --}}
        <div class="modal fade" id="order-detail-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-open-width modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="icon-close"></i></span>
                        </button>

                        <div class="p-5" id="render_order_detail">


                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- modal create address --}}
        <div class="modal fade" id="add-address" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="dialog">
                <div class="modal-content">
                    <div class="modal-body ">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="icon-close"></i></span>
                        </button>

                        <div class="form-box">
                            <div class="modal-header">
                                <h4>Địa chỉ mới</h4>
                            </div>
                            <div class="row mt-2">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="">Họ và tên</label>
                                        <input type="text" class="form-control" placeholder="Họ tên"
                                            id="name_address" name="name">
                                        <p class="text-danger" id="error_name_address"></p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="">Số điện thoại</label>
                                        <input type="text" class="form-control" placeholder="Số điện thoại"
                                            id="phone_address" name="phone">
                                        <p class="text-danger" id="error_phone_address"></p>

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <label>Tỉnh/Thành phố <b class="text-danger">*</b></label>
                                    <select class="form-select m-0 " name="city" id="city">
                                        <option value="" selected disabled>Thành phố</option>
                                    </select>
                                    <p class="text-danger" id="error_city"></p>

                                </div>
                                <div class="col-lg-6">
                                    <label>Thành phố/Huyện <b class="text-danger">*</b></label>
                                    <select class="form-select m-0" name="district" id="district">
                                        <option value="" selected disabled>Thành phố</option>
                                    </select>
                                    <p class="text-danger" id="error_district"></p>

                                </div>
                            </div>
                            <div class="form-group mt-2">
                                <label>Phường/Xã <b class="text-danger">*</b></label>
                                <select class="form-select m-0" name="ward" id="ward">
                                    <option value="" selected disabled>Khu vực</option>
                                </select>
                                <p class="text-danger" id="error_ward"></p>
                            </div>

                            <div class="form-group">
                                <label for="">Địa chỉ cụ thể</label>
                                <textarea class="form-control" id="home_address" name="home_address"></textarea>
                                <p class="text-danger" id="error_home_address"></p>

                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-info" class="close" data-dismiss="modal"
                                    aria-label="Close">Trở về</button>
                                <button type="button" class="btn btn-primary" id="save_address">Hoàn thành</button>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>

        {{-- modal edit address --}}
        <div class="modal fade" id="edit-address" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="dialog">
                <div class="modal-content">
                    <div class="modal-body ">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="icon-close"></i></span>
                        </button>

                        <div class="render_edit_address">

                        </div>

                    </div>

                </div>
            </div>
        </div>


    </main>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            // Rating




            // get product review
            $(document).on('click', '.btn_review_order', function() {
                let id = $(this).data('id');

                $.ajax({
                    url: "{{ route('getOrderReview') }}",
                    type: 'Post',
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        console.log(response);
                        $('#render_review_order').html(response.view);


                        function rate5() {
                            document.getElementById("5").style.color = "orange";
                            document.getElementById("4").style.color = "orange";
                            document.getElementById("3").style.color = "orange";
                            document.getElementById("2").style.color = "orange";
                            document.getElementById("1").style.color = "orange";
                        }

                        function rate4() {
                            document.getElementById("5").style.color = "#9e9e9e";
                            document.getElementById("4").style.color = "orange";
                            document.getElementById("3").style.color = "orange";
                            document.getElementById("2").style.color = "orange";
                            document.getElementById("1").style.color = "orange";
                        }

                        function rate3() {
                            document.getElementById("5").style.color = "#9e9e9e";
                            document.getElementById("4").style.color = "#9e9e9e";
                            document.getElementById("3").style.color = "orange";
                            document.getElementById("2").style.color = "orange";
                            document.getElementById("1").style.color = "orange";
                        }

                        function rate2() {
                            document.getElementById("5").style.color = "#9e9e9e";
                            document.getElementById("4").style.color = "#9e9e9e";
                            document.getElementById("3").style.color = "#9e9e9e";
                            document.getElementById("2").style.color = "orange";
                            document.getElementById("1").style.color = "orange";
                        }

                        function rate1() {
                            document.getElementById("5").style.color = "#9e9e9e";
                            document.getElementById("4").style.color = "#9e9e9e";
                            document.getElementById("3").style.color = "#9e9e9e";
                            document.getElementById("2").style.color = "#9e9e9e";
                            document.getElementById("1").style.color = "orange";
                        }

                        document.getElementById("5").onclick = function() {
                            rate5();
                            $(".display_rating").text("Tuyệt vời")
                        }

                        document.getElementById("4").onclick = function() {
                            rate4();
                            $(".display_rating").text("Hài lòng")
                        }
                        document.getElementById("3").onclick = function() {
                            rate3();
                            $(".display_rating").text("Bình thường")
                        }
                        document.getElementById("2").onclick = function() {
                            rate2();
                            $(".display_rating").text("Không hài lòng")
                        }
                        document.getElementById("1").onclick = function() {
                            rate1();
                            $(".display_rating").text("Tệ")
                        }

                        $('input[name="rating"]').change(function() {
                            var star = $('input[name="rating"]:checked').val();
                            stateRating(star);

                        });


                    },
                })
            })



            function stateRating(star) {
                $("#save_review").click(function() {
                    $("#error_comment").text("");
                    var comment = $("#comment").val();

                    if (comment == "") {
                        $("#error_comment").text("Vui lòng nhập đánh giá !");
                        $("#comment").focus();
                        return false;
                    }

                    var user_id = $("#user_id").val();
                    var order_id = $("#order_id").val();
                    var product_id = $("#product_id").val();


                    $.ajax({
                        url: "{{ route('orderRating') }}",
                        type: 'Post',
                        data: {
                            star,
                            comment,
                            user_id,
                            order_id,
                            product_id,
                            _token: '{{ csrf_token() }}',
                        },
                        success: function(response) {
                            Swal.fire({
                                title: "Đánh giá thành công!",
                                icon: "success",
                                showConfirmButton: false,
                                timer: 1600
                            });

                            $(".close").click();

                        },
                    })


                })
            }




            // Load modal order detail
            $(document).on('click', '.btn-order-detail', function() {
                var id = $(this).data('id');

                $.ajax({
                    url: "{{ route('orderDetail') }}",
                    type: 'Post',
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        $('#render_order_detail').html(response.view);
                    },
                })
            })

            $(".list_order_cancel").click(function() {
                $.ajax({
                    url: "{{ route('listOrderCancel') }}",
                    type: 'Post',
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        $('#render_order_cancel').html(response.view);
                    },
                })
            })

            // Cancel order
            $(document).on('click', '.btn_cancel_order', function() {
                var id = $(this).data('id');
                var td = $(this).closest('td');
                var tr = td.closest('tr');

                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: "btn btn-success",
                        cancelButton: "btn btn-danger",
                        popup: 'custom-width-alert'
                    },
                    buttonsStyling: false
                });
                swalWithBootstrapButtons.fire({
                    title: "Bạn có muốn hủy đơn hàng này không ?",
                    text: "Bạn sẽ không thể hoàn nguyên điều này!!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Vâng, Chắc chắn !",
                    cancelButtonText: "Bỏ qua!",
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('cancelOrder') }}",
                            type: 'Post',
                            data: {
                                id: id,
                                _token: '{{ csrf_token() }}',
                            },
                            success: function(response) {
                                tr.remove();
                                Swal.fire({
                                    title: "Đã hủy đơn hàng thành công !",
                                    icon: "success",
                                    showConfirmButton: false,
                                    timer: 1600
                                });
                            },

                        })
                    }
                });


            })


            //Search order
            $("#search-orders-form").on("submit", function(e) {
                e.preventDefault();
                var keyword = $("#keyword_order").val();
                $.ajax({
                    url: "{{ route('searchOrder') }}",
                    type: 'Post',
                    data: {
                        keyword: keyword,
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        if (response.status == "success") {
                            $('#render_order').html(response.view);
                        } else {
                            $("#render_order").html(response.message);
                        }
                    },
                })
            })


            // Load city select
            let data = {};
            $.ajax({
                url: "{{ asset('assets_fe/address/db_country.json') }}",
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    data = response;
                    // console.log(data);
                    populateCities();
                },
                error: function(xhr, status, error) {
                    console.error('There was a problem with the AJAX request:', status, error);
                }
            });

            // Populate cities select
            function populateCities() {
                const citySelect = $('#city');
                citySelect.empty();
                citySelect.append('<option value="" selected disabled>Chọn tỉnh thành</option>');
                $.each(data, function(index, city) {
                    citySelect.append(
                        `<option data-id="${city.Id}" value="${city.Name}" {{ old('city') ? 'selected' : '' }}>${city.Name}</option>`
                    );
                });
            }

            // Event listener for city select change
            $('#city').on('change', function() {
                const cityId = $('#city option:selected').data('id');
                // console.log(cityId);
                populateDistricts(cityId);
                $('#ward').empty().append('<option value="" selected disabled>Chọn phường xã</option>');
            });

            // Populate districts select
            function populateDistricts(cityId) {
                const districtSelect = $('#district');
                districtSelect.empty();
                districtSelect.append('<option value="" selected disabled>Chọn quận huyện</option>');

                const city = data.find(city => city.Id == cityId);
                if (city) {
                    $.each(city.Districts, function(index, district) {
                        districtSelect.append(
                            `<option data-id="${district.Id}" value="${district.Name}">${district.Name}</option>`
                        );
                    });
                }
            }

            // Event listener for district select change
            $('#district').on('change', function() {
                const cityId = $('#city option:selected').data('id');
                const districtId = $('#district option:selected').data('id');
                // console.log(cityId, districtId);
                populateWards(cityId, districtId);
            });

            // Populate wards select
            function populateWards(cityId, districtId) {
                const wardSelect = $('#ward');
                wardSelect.empty();
                wardSelect.append('<option value="" selected>Chọn phường xã</option>');

                const city = data.find(city => city.Id == cityId);
                if (city) {
                    const district = city.Districts.find(district => district.Id == districtId);
                    if (district) {
                        $.each(district.Wards, function(index, ward) {
                            wardSelect.append(`<option value="${ward.Name}">${ward.Name}</option>`);
                        });
                    }
                }
            }

            // new address
            $("#save_address").on('click', function() {
                var name_address = $('#name_address').val();
                var phone_address = $('#phone_address').val();
                var city = $('#city').val();
                var district = $('#district').val();
                var ward = $('#ward').val();
                var home_address = $('#home_address').val();

                var isValid = true;

                if (name_address == "") {
                    $("#error_name_address").text("Vui lòng nhập họ và tên!");
                    $("#name_address").focus();
                    $("#name_address").addClass("is-invalid");
                    isValid = false;
                } else {
                    $("#error_name_address").text("");
                    $("#name_address").removeClass("is-invalid");
                }

                if (phone_address == "") {
                    $("#error_phone_address").text("Vui lòng nhập số điện thoại!");
                    $("#phone_address").focus();
                    $("#phone_address").addClass("is-invalid");
                    isValid = false;
                } else {
                    $("#error_phone_address").text("");
                    $("#phone_address").removeClass("is-invalid");
                }

                if (city == "" || city == null) {
                    $("#error_city").text("Vui lòng chọn thành phố!");
                    $("#city").focus();
                    $("#city").addClass("is-invalid");
                    isValid = false;
                } else {
                    $("#error_city").text("");
                    $("#city").removeClass("is-invalid");
                }

                if (district == "" || district == null) {
                    $("#error_district").text("Vui lòng chọn quận huyện!");
                    $("#district").focus();
                    $("#district").addClass("is-invalid");
                    isValid = false;
                } else {
                    $("#error_district").text("");
                    $("#district").removeClass("is-invalid");
                }

                if (ward == "" || ward == null) {
                    $("#error_ward").text("Vui lòng chọn phường xã!");
                    $("#ward").focus();
                    $("#ward").addClass("is-invalid");
                    isValid = false;
                } else {
                    $("#error_ward").text("");
                    $("#ward").removeClass("is-invalid");
                }

                if (home_address == "") {
                    $("#error_home_address").text("Vui lòng nhập địa chỉ nhà!");
                    $("#home_address").focus();
                    $("#home_address").addClass("is-invalid");
                    isValid = false;
                } else {
                    $("#error_home_address").text("");
                    $("#home_address").removeClass("is-invalid");
                }

                if (isValid) {
                    $.ajax({
                        url: "{{ route('acountNewAddress') }}",
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            name_address: name_address,
                            phone_address: phone_address,
                            city: city,
                            district: district,
                            ward: ward,
                            home_address: home_address
                        },
                        success: function(response) {
                            // console.log(response);
                            Swal.fire({
                                title: "Thêm địa chỉ thành công",
                                icon: "success",
                                showConfirmButton: false,
                                timer: 1800
                            });

                            $(".close").click();
                            $(".render_list_address").html(response.view);
                        },
                        error: function(xhr, status, error) {
                            console.error('There was a problem with the AJAX request:', status,
                                error);
                        }
                    })
                }
            })

            // delete address
            $(document).on('click', '.btn_delete_address', function() {
                var id = $(this).data('id');
                // alert(id);
                $.ajax({
                    url: "{{ route('acountDeleteAddress') }}",
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: id
                    },
                    success: function(response) {
                        Swal.fire({
                            title: "Xóa địa chỉ thành công",
                            icon: "success",
                            showConfirmButton: false,
                            timer: 1800
                        });

                        $(".render_list_address").html(response.view);
                    },
                    error: function(xhr, status, error) {
                        console.error('There was a problem with the AJAX request:', status,
                            error);
                    }
                });
            });

            // edit address
            $(document).on('click', '.btn_edit_address', function() {
                var id = $(this).data('id');
                // alert(id);
                $.ajax({
                    url: "{{ route('acountEditAddress') }}",
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: id
                    },
                    success: function(response) {
                        // console.log(response);
                        $(".render_edit_address").html(response.view);

                        let dataEdit = {};
                        $.ajax({
                            url: "{{ asset('assets_fe/address/db_country.json') }}",
                            type: 'GET',
                            dataType: 'json',
                            success: function(response) {
                                dataEdit = response;
                                // console.log(dataEdit);
                                populateCitiesEdit();
                            },
                            error: function(xhr, status, error) {
                                console.error(
                                    'There was a problem with the AJAX request:',
                                    status, error);
                            }
                        });

                        // Populate cities select
                        function populateCitiesEdit() {
                            const citySelectEdit = $('#city_edit');
                            $.each(dataEdit, function(index, city) {
                                citySelectEdit.append(
                                    `<option data-id="${city.Id}" value="${city.Name}">${city.Name}</option>`
                                );
                            });
                        }

                        // Event listener for city select change
                        $('#city_edit').on('change', function() {
                            const cityIdEdit = $('#city_edit option:selected').data(
                                'id');
                            populateDistrictsEdit(cityIdEdit);
                            $('#ward_edit').empty().append(
                                '<option value="" selected disabled>Chọn phường xã</option>'
                            );
                        });

                        // Populate districts select
                        function populateDistrictsEdit(cityId) {
                            const districtSelectEdit = $('#district_edit');
                            districtSelectEdit.empty();
                            districtSelectEdit.append(
                                '<option value="" selected disabled>Chọn quận huyện</option>'
                            );

                            const cityEdit = dataEdit.find(city => city.Id == cityId);
                            if (cityEdit) {
                                $.each(cityEdit.Districts, function(index, district) {
                                    districtSelectEdit.append(
                                        `<option data-id="${district.Id}" value="${district.Name}">${district.Name}</option>`
                                    );
                                });
                            }
                        }

                        // Event listener for district select change
                        $('#district_edit').on('change', function() {
                            const cityId = $('#city_edit option:selected').data('id');
                            const districtId = $('#district_edit option:selected').data(
                                'id');
                            populateWardsEdit(cityId, districtId);
                        });

                        // Populate wards select
                        function populateWardsEdit(cityId, districtId) {
                            const wardSelect = $('#ward_edit');
                            wardSelect.empty();
                            wardSelect.append(
                                '<option value="" selected>Chọn phường xã</option>');

                            const city = dataEdit.find(city => city.Id == cityId);
                            if (city) {
                                const district = city.Districts.find(district => district.Id ==
                                    districtId);
                                if (district) {
                                    $.each(district.Wards, function(index, ward) {
                                        wardSelect.append(
                                            `<option value="${ward.Name}">${ward.Name}</option>`
                                        );
                                    });
                                }
                            }
                        }

                        // update address
                        $("#update_address").on('click', function() {
                            var id = $(this).data('id');
                            var edit_name_address = $("#name_address_edit").val();
                            var edit_phone_address = $("#phone_address_edit").val();
                            var edit_city = $("#city_edit").val();
                            var edit_district = $("#district_edit").val();
                            var edit_ward = $("#ward_edit").val();
                            var edit_home_address = $("#home_address_edit").val();

                            var isValidEdit = true;

                            if (edit_name_address == "") {
                                $("#error_edit_name_address").text(
                                    "Vui lòng điền đầy đủ họ tên!");
                                $("#name_address_edit").focus();
                                $("#name_address_edit").addClass("is-invalid");
                                isValidEdit = false;
                            } else if (edit_name_address.length < 5) {
                                $("#error_edit_name_address").text(
                                    "Nhập đầy đủ họ và tên !");
                                $("#name_address_edit").focus();
                                $("#name_address_edit").addClass("is-invalid");
                                isValidEdit = false;
                            } else {
                                $("#error_edit_name_address").text("");
                                $("#edit_name_address").removeClass("is-invalid");
                            }

                            if (edit_phone_address == "") {
                                $("#error_edit_phone_address").text(
                                    "Vui lòng nhập số điện thoại!");
                                $("#edit_phone_address").focus();
                                $("#edit_phone_address").addClass("is-invalid");
                                isValidEdit = false;
                            } else if (!/^\d{10}$/.test(
                                    edit_phone_address)) {
                                $("#error_edit_phone_address").text(
                                    "Số điện thoại không hợp lệ!");
                                $("#edit_phone_address").focus();
                                $("#edit_phone_address").addClass("is-invalid");
                                isValidEdit = false;
                            } else {
                                $("#error_edit_phone_address").text("");
                                $("#edit_phone_address").removeClass("is-invalid");
                            }
                            if (edit_home_address == "") {
                                $("#error_edit_home_address").text(
                                    "Vui lòng nhập địa chỉ cụ thể !");
                                $("#edit_home_address").focus();
                                $("#edit_home_address").addClass("is-invalid");
                                isValidEdit = false;
                            } else {
                                $("#error_edit_home_address").text("");
                                $("#edit_home_address").removeClass("is-invalid");
                            }


                            if (isValidEdit) {
                                $.ajax({
                                    url: "{{ route('acountUpdateAddress') }}",
                                    type: 'POST',
                                    data: {
                                        _token: '{{ csrf_token() }}',
                                        id: id,
                                        name_address: edit_name_address,
                                        phone_address: edit_phone_address,
                                        city: edit_city,
                                        district: edit_district,
                                        ward: edit_ward,
                                        home_address: edit_home_address
                                    },
                                    success: function(response) {
                                        Swal.fire({
                                            title: "Cập nhật địa chỉ thành công",
                                            icon: "success",
                                            showConfirmButton: false,
                                            timer: 1800
                                        });

                                        setTimeout(() => {
                                            $(".close").click();
                                        }, 1800);

                                        $(".render_list_address").html(
                                            response.view);
                                    },
                                    error: function(xhr, status, error) {
                                        console.error(
                                            'There was a problem with the AJAX request:',
                                            status, error);
                                    }
                                })
                            }


                        });



                    },
                    error: function(xhr, status, error) {
                        console.error('There was a problem with the AJAX request:',
                            status,
                            error);
                    }
                });


            })

            // address default
            $(document).on('click', '.btn_address_default', function() {
                var id = $(this).data('id');
                // alert("Địa chỉ mặc định: " + id);

                $.ajax({
                    url: "{{ route('acountAddressDefault') }}",
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: id
                    },
                    success: function(response) {
                        // alert(response);

                        $(".render_list_address").html(response.view);
                    },
                    error: function(xhr, status, error) {
                        console.error('There was a problem with the AJAX request:',
                            status, error);
                    }
                })

            })





        });
    </script>
@endsection
