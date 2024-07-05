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
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Trang chủ</a></li>
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
                                        role="tab" aria-controls="tab-downloads" aria-selected="false">Đổi mật khẩu</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " id="tab-address-link" data-toggle="tab" href="#tab-address"
                                        role="tab" aria-controls="tab-address" aria-selected="false">Địa chỉ</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('user_logout') }}">Đăng xuất</a>
                                </li>
                            </ul>
                        </aside>

                        <div class="col-md-8 col-lg-10">
                            <div class="tab-content">
                                <div class="tab-pane fade" id="tab-dashboard" role="tabpanel"
                                    aria-labelledby="tab-dashboard-link">
                                    <h3>Hồ sơ của tôi</h3>
                                    <p>Quản lý thông tin hồ sơ để bảo mật tài khoản</p>
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="form-group">
                                                <label for="account-fn">Tên</label>
                                                <input type="text" class="form-control mb-0" id="account-name"
                                                    value="{{ Auth::user()->name }}" name="name" required>
                                                <b class="text-danger" id="error_name_profile"></b>
                                            </div>
                                            <div class="form-group">
                                                <label for="account-fn">Email</label>
                                                <input type="text" readonly class="form-control mb-0" id="account-email"
                                                    value="{{ Auth::user()->email }}" name="email" required>
                                                <b class="text-danger" id="error_email_profile"></b>

                                            </div>
                                            <div class="form-group">
                                                <label for="account-fn">Số điện thoại @if (Auth::user()->phone == null)
                                                        <b class="text-primary">(Thêm mới)</b>
                                                    @endif
                                                </label>
                                                <input type="text" class="form-control mb-0" id="account-phone"
                                                    value="{{ Auth::user()->phone }}" name="phone" required>
                                                <b class="text-danger" id="error_phone_profile"></b>

                                            </div>

                                            <label for="">Giới tính
                                            </label>
                                            <div class="d-flex">
                                                <input type="hidden" id="sex">
                                                <div class="payment_item">
                                                    <input type="radio" {{ Auth::user()->sex == 'nam' ? 'checked' : '' }}
                                                        name="sex" value="nam" class="type_payment"
                                                        id="payment_cash">
                                                    <label class="custome-control-label label_payment"
                                                        for="payment_cash">Nam</label>
                                                </div>
                                                <div class="payment_item">
                                                    <input type="radio" name="sex" value="nu"
                                                        {{ Auth::user()->sex == 'nu' ? 'checked' : '' }}
                                                        class="type_payment" id="payment_vnpay">
                                                    <label class="custome-control-label label_payment"
                                                        for="payment_vnpay">Nữ</label>
                                                </div>
                                                <div class="payment_item">
                                                    <input type="radio" name="sex" class="type_payment"
                                                        {{ Auth::user()->sex == 'khac' ? 'checked' : '' }}
                                                        id="payment_momo" value="khac">
                                                    <label class="custome-control-label label_payment"
                                                        for="payment_momo">Khác</label>
                                                </div>
                                            </div>
                                            <b class="text-danger" id="error_sex_profile"></b>

                                        </div>
                                        <div class="col-4">
                                            <article class="entry entry-grid">
                                                <input type="file" class="d-none" id="avatar" name="avatar"
                                                    value="" accept="image/*">
                                                <label class="render_img_acount w-100 h-100" for="avatar">
                                                    @if (Auth::user()->avatar && filter_var(Auth::user()->avatar, FILTER_VALIDATE_URL))
                                                        <img id="preview_image_account" class="d-block w-100 h-100"
                                                            src="{{ Auth::user()->avatar }}" alt="">
                                                    @else
                                                        <img id="preview_image_account" class="d-block w-100 h-100"
                                                            src="{{ asset('uploads/product/' . Auth::user()->avatar) }}"
                                                            alt="">
                                                    @endif


                                                </label>

                                                <div class="entry-body text-center">
                                                    <div class="entry-content">
                                                        <p>Dụng lượng file tối đa 5 MB</p>
                                                    </div>
                                                </div>
                                            </article>
                                        </div>

                                    </div>
                                    <div class="mt-3">
                                        <button class="btn btn-outline-primary-2 btn_update_acount"><span>Cập
                                                nhật</span><i class="icon-long-arrow-right"></i></button>
                                    </div>
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

                                                                            <td class="d-flex">
                                                                                <a href="#order-detail-modal"
                                                                                    data-toggle="modal"
                                                                                    data-id="{{ $order->id }}"
                                                                                    class="btn bg-image btn-outline-primary mr-2 btn-order-detail">Xem
                                                                                    thêm</a>
                                                                                @if ($order->status == 1)
                                                                                    <button
                                                                                        class="btn btn-danger btn_cancel_order"
                                                                                        data-id="{{ $order->id }}">Hủy
                                                                                        đơn</button>
                                                                                @endif
                                                                                <div
                                                                                    id="change_review_{{ $order->id }}">
                                                                                    @if ($order->status == 4)
                                                                                        @if ($order->is_review == 0)
                                                                                            <a href="#modal-review-order"
                                                                                                data-toggle="modal"
                                                                                                data-id="{{ $order->id }}"
                                                                                                class="btn btn-primary btn_review_order">Đánh
                                                                                                giá</a>
                                                                                        @else
                                                                                            <a href="#modal-see-review-order"
                                                                                                data-toggle="modal"
                                                                                                data-id="{{ $order->review_id }}"
                                                                                                class="btn btn-outline-success btn_see_review_order">Xem
                                                                                                đánh giá</a>
                                                                                        @endif
                                                                                    @endif
                                                                                </div>
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

                                <div class="tab-pane fade " id="tab-downloads" role="tabpanel"
                                    aria-labelledby="tab-downloads-link">
                                    <div class="d-flex justify-content-between">
                                        <h3>Đổi mật khẩu.</h3>
                                    </div>

                                    <form method="post" id="form_change_password">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                                        <div class="form-group">
                                            <label for="">Mật khẩu cũ</label>
                                            <input type="password" name="password" id="password"
                                                class="form-control mb-0">
                                            <b class="text-danger" id="password_error"></b>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Mật khẩu mới</label>
                                            <input type="password" name="new_password" id="new_password"
                                                class="form-control  mb-0">
                                            <b class="text-danger" id="new_password_error"></b>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Xác nhận mật khẩu </label>
                                            <input type="password" name="confirm_password" id="confirm_password"
                                                class="form-control  mb-0">
                                            <b class="text-danger" id="confirm_password_error"></b>

                                        </div>

                                        <button type="submit" class="btn btn-primary">Cập nhật</>
                                    </form>

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

        {{-- modal see review  --}}
        <div class="modal fade" id="modal-see-review-order" tabindex="-1" role="dialog" aria-hidden="true">
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

                            <div id="render_see_review_order">

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

            // update password
            $("#form_change_password").on("submit", function(e) {
                e.preventDefault();

                var password_error = $("#password_error");
                var new_password_error = $("#new_password_error");
                var confirm_password_error = $("#confirm_password_error");


                $.ajax({
                    method: 'POST',
                    url: "{{ route('updatePassword') }}",
                    dataType: "JSON",
                    data: $("#form_change_password").serialize(),
                    success: function(response) {

                        if (response.status == "success") {
                            Swal.fire({
                                title: response.message,
                                icon: "success",
                                showConfirmButton: false,
                                timer: 1800
                            });

                            $("#password").val("");
                            $("#new_password").val("");
                            $("#confirm_password").val("");
                            $("#password").removeClass("is-invalid");
                            $("#new_password").removeClass("is-invalid");
                            $("#confirm_password").removeClass("is-invalid");


                        } else {
                            if (response.error) {
                                $("#password").addClass("is-invalid");
                                password_error.text(response.error);
                            }

                            if (response.message.password) {
                                $("#password").addClass("is-invalid");
                                password_error.text(response.message.password);
                            } else {
                                $("#password").removeClass("is-invalid");
                                password_error.text("");
                            }

                            if (response.message.new_password) {
                                $("#new_password").addClass("is-invalid");
                                new_password_error.text(response.message.new_password);
                            } else {
                                $("#new_password").removeClass("is-invalid");
                                new_password_error.text("")
                            }

                            if (response.message.confirm_password) {
                                $("#confirm_password").addClass("is-invalid");
                                confirm_password_error.text(response.message.confirm_password);
                            } else {
                                $("#confirm_password").removeClass("is-invalid");
                                confirm_password_error.text("");
                            }


                        }


                    },
                })

            })

            // update avatar and profile
            $("#avatar").change(function() {
                if (this.files && this.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $("#preview_image_account").attr('src', e.target.result);
                    }
                    reader.readAsDataURL(this.files[0]);


                    var formData = new FormData();
                    formData.append('id', '{{ Auth::user()->id }}');
                    formData.append('avatar', this.files[0]);
                    formData.append('_token', '{{ csrf_token() }}');

                    // Gửi tệp ảnh qua AJAX
                    $.ajax({
                        url: "{{ route('updateProfileAvatar') }}",
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
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
                                title: "cập nhật avatar thành công"
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText); // Xử lý lỗi
                        }


                    })
                }
            })

            $('input[name="sex"]').change(function() {
                var selectedValue = $('input[name="sex"]:checked').val();
                $("#sex").val(selectedValue);
            });

            $(".btn_update_acount").on('click', function(e) {
                e.preventDefault();

                var name = $('#account-name').val();
                var email = $('#account-email').val();
                var phone = $('#account-phone').val();
                var sex = $('input[name="sex"]:checked').val();
                var token = '{{ csrf_token() }}';

                var isValid = true;
                var errorMessage = '';

                if (!name) {
                    isValid = false;
                    $('#account-name').addClass('is-invalid');
                    $('#account-name').focus();
                    $("#error_name_profile").text('Tên không được để trống.');
                } else {
                    $('#account-name').removeClass('is-invalid');
                    $("#error_name_profile").text('');
                }

                if (!email) {
                    isValid = false;
                    $('#account-email').addClass('is-invalid');
                    if (isValid) $('#account-email').focus();
                    $("#error_email_profile").text('Email không được để trống.');
                } else if (!validateEmail(email)) {
                    isValid = false;
                    $('#account-email').addClass('is-invalid');
                    if (isValid) $('#account-email').focus();
                    $("#error_email_profile").text('Email không hợp lệ.');
                } else {
                    $('#account-email').removeClass('is-invalid');
                    $("#error_email_profile").text('');
                }

                if (!phone) {
                    isValid = false;
                    $('#account-phone').addClass('is-invalid');
                    if (isValid) $('#account-phone').focus();
                    $("#error_phone_profile").text('Số điện thoại không được để trống.');
                } else if (!validatePhone(phone)) {
                    isValid = false;
                    $('#account-phone').addClass('is-invalid');
                    if (isValid) $('#account-phone').focus();
                    $("#error_phone_profile").text('Số điện thoại không hợp lệ.');
                } else {
                    $('#account-phone').removeClass('is-invalid');
                    $("#error_phone_profile").text('');
                }

                if (!sex) {
                    isValid = false;
                    $("#error_sex_profile").text('Vui lòng chọn giới tính.');
                } else {
                    $("#error_sex_profile").text('');
                }

                if (!isValid) {
                    return;
                }


                $.ajax({
                    url: "{{ route('updateProfileUser') }}",
                    type: 'POST',
                    data: {
                        id: "{{ Auth::user()->id }}",
                        avatar: $("#avatar").val(),
                        name: name,
                        email: email,
                        phone: phone,
                        sex: sex,
                        _token: token,
                    },
                    success: function(response) {
                        Swal.fire({
                            title: "Đánh giá thành công!",
                            icon: "success",
                            showConfirmButton: false,
                            timer: 1600
                        });
                    }
                });
            });

            function validateEmail(email) {
                var re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return re.test(email);
            }

            function validatePhone(phone) {
                var re = /^\d{10,11}$/;
                return re.test(phone);
            }

            // see review order
            $(document).on('click', '.btn_see_review_order', function() {
                let id = $(this).data('id');
                console.log(id);
                $.ajax({
                    url: "{{ route('seeReviewOrder') }}",
                    type: 'Post',
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        // console.log(response);
                        $('#render_see_review_order').html(response.view);
                    }
                });
            });


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
                        // console.log(response);
                        $('#render_review_order').html(response.view);

                        function rateStars(star) {
                            for (let i = 1; i <= 5; i++) {
                                document.getElementById(i.toString()).style.color =
                                    (i <=
                                        star) ? "orange" : "#9e9e9e";
                            }
                        }

                        const ratings = [{
                                star: 5,
                                text: "Tuyệt vời"
                            },
                            {
                                star: 4,
                                text: "Hài lòng"
                            },
                            {
                                star: 3,
                                text: "Bình thường"
                            },
                            {
                                star: 2,
                                text: "Không hài lòng"
                            },
                            {
                                star: 1,
                                text: "Tệ"
                            },
                        ];

                        ratings.forEach(rating => {
                            document.getElementById(rating.star.toString())
                                .onclick =
                                function() {
                                    rateStars(rating.star);
                                    $(".display_rating").text(rating.text);
                                };
                        });

                        $('input[name="rating"]').on('change', function() {
                            var rating = $(this).val();
                            $("#star").val(rating);
                            console.log($("#star"));
                        });

                    },
                });
            });

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
                var star = $("#star").val();

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

                        var changeReview = $("#change_review_" + order_id);
                        var elementBtnSeeReview = `
                                <a href="#modal-see-review-order"
                                    data-toggle="modal"
                                    data-id="${response.id_review}"
                                    class="btn btn-outline-success btn_see_review_order">Xem
                                    đánh giá
                                </a>    
                            `
                        changeReview.html(elementBtnSeeReview);
                    },
                });

            });


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
                    console.error('There was a problem with the AJAX request:', status,
                        error);
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
                $('#ward').empty().append(
                    '<option value="" selected disabled>Chọn phường xã</option>');
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
                            wardSelect.append(
                                `<option value="${ward.Name}">${ward.Name}</option>`);
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
                            console.error(
                                'There was a problem with the AJAX request:',
                                status,
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
                        console.error('There was a problem with the AJAX request:',
                            status,
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
                            const cityIdEdit = $(
                                '#city_edit option:selected').data(
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

                            const cityEdit = dataEdit.find(city => city.Id ==
                                cityId);
                            if (cityEdit) {
                                $.each(cityEdit.Districts, function(index,
                                    district) {
                                    districtSelectEdit.append(
                                        `<option data-id="${district.Id}" value="${district.Name}">${district.Name}</option>`
                                    );
                                });
                            }
                        }

                        // Event listener for district select change
                        $('#district_edit').on('change', function() {
                            const cityId = $('#city_edit option:selected')
                                .data('id');
                            const districtId = $(
                                '#district_edit option:selected').data(
                                'id');
                            populateWardsEdit(cityId, districtId);
                        });

                        // Populate wards select
                        function populateWardsEdit(cityId, districtId) {
                            const wardSelect = $('#ward_edit');
                            wardSelect.empty();
                            wardSelect.append(
                                '<option value="" selected>Chọn phường xã</option>'
                            );

                            const city = dataEdit.find(city => city.Id == cityId);
                            if (city) {
                                const district = city.Districts.find(district =>
                                    district.Id ==
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
                            var edit_name_address = $("#name_address_edit")
                                .val();
                            var edit_phone_address = $(
                                "#phone_address_edit").val();
                            var edit_city = $("#city_edit").val();
                            var edit_district = $("#district_edit").val();
                            var edit_ward = $("#ward_edit").val();
                            var edit_home_address = $("#home_address_edit")
                                .val();

                            var isValidEdit = true;

                            if (edit_name_address == "") {
                                $("#error_edit_name_address").text(
                                    "Vui lòng điền đầy đủ họ tên!"
                                );
                                $("#name_address_edit").focus();
                                $("#name_address_edit").addClass(
                                    "is-invalid");
                                isValidEdit = false;
                            } else if (edit_name_address.length < 5) {
                                $("#error_edit_name_address").text(
                                    "Nhập đầy đủ họ và tên !");
                                $("#name_address_edit").focus();
                                $("#name_address_edit").addClass(
                                    "is-invalid");
                                isValidEdit = false;
                            } else {
                                $("#error_edit_name_address").text("");
                                $("#edit_name_address").removeClass(
                                    "is-invalid");
                            }

                            if (edit_phone_address == "") {
                                $("#error_edit_phone_address").text(
                                    "Vui lòng nhập số điện thoại!");
                                $("#edit_phone_address").focus();
                                $("#edit_phone_address").addClass(
                                    "is-invalid");
                                isValidEdit = false;
                            } else if (!/^\d{10}$/.test(
                                    edit_phone_address)) {
                                $("#error_edit_phone_address").text(
                                    "Số điện thoại không hợp lệ!");
                                $("#edit_phone_address").focus();
                                $("#edit_phone_address").addClass(
                                    "is-invalid");
                                isValidEdit = false;
                            } else {
                                $("#error_edit_phone_address").text("");
                                $("#edit_phone_address").removeClass(
                                    "is-invalid");
                            }
                            if (edit_home_address == "") {
                                $("#error_edit_home_address").text(
                                    "Vui lòng nhập địa chỉ cụ thể !");
                                $("#edit_home_address").focus();
                                $("#edit_home_address").addClass(
                                    "is-invalid");
                                isValidEdit = false;
                            } else {
                                $("#error_edit_home_address").text("");
                                $("#edit_home_address").removeClass(
                                    "is-invalid");
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
                                            $(".close")
                                                .click();
                                        }, 1800);

                                        $(".render_list_address")
                                            .html(
                                                response.view);
                                    },
                                    error: function(xhr, status,
                                        error) {
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
