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
                        <aside class="col-md-4 col-lg-3">
                            <ul class="nav nav-dashboard flex-column mb-3 mb-md-0" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="tab-dashboard-link" data-toggle="tab"
                                        href="#tab-dashboard" role="tab" aria-controls="tab-dashboard"
                                        aria-selected="true">Hồ sơ</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab-orders-link" data-toggle="tab" href="#tab-orders"
                                        role="tab" aria-controls="tab-orders" aria-selected="false">Đơn hàng</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab-downloads-link" data-toggle="tab" href="#tab-downloads"
                                        role="tab" aria-controls="tab-downloads" aria-selected="false">Sản phẩm vừa
                                        xem</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab-address-link" data-toggle="tab" href="#tab-address"
                                        role="tab" aria-controls="tab-address" aria-selected="false">Địa chỉ</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab-account-link" data-toggle="tab" href="#tab-account"
                                        role="tab" aria-controls="tab-account" aria-selected="false">Cập nhật tài
                                        khoản</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Đăng xuất</a>
                                </li>
                            </ul>
                        </aside>

                        <div class="col-md-8 col-lg-9">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="tab-dashboard" role="tabpanel"
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

                                <div class="tab-pane fade" id="tab-orders" role="tabpanel"
                                    aria-labelledby="tab-orders-link">
                                    <p>No order has been made yet.</p>
                                    <a href="category.html" class="btn btn-outline-primary-2"><span>GO SHOP</span><i
                                            class="icon-long-arrow-right"></i></a>
                                </div><!-- .End .tab-pane -->

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
                                        <button class="btn btn-primary">Thêm địa chỉ mới</button>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="card card-dashboard">
                                                <div class="card-body">
                                                    <h3 class="card-title">Billing Address</h3>
                                                    <p>User Name<br>
                                                        User Company<br>
                                                        John str<br>
                                                        New York, NY 10001<br>
                                                        1-234-987-6543<br>
                                                        yourmail@mail.com<br>
                                                        <a href="#">Edit <i class="icon-edit"></i></a>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="card card-dashboard">
                                                <div class="card-body">
                                                    <h3 class="card-title">Shipping Address</h3>

                                                    <p>You have not set up this type of address yet.<br>
                                                        <a href="#">Edit <i class="icon-edit"></i></a>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- .End .tab-pane -->

                                <div class="tab-pane fade" id="tab-account" role="tabpanel"
                                    aria-labelledby="tab-account-link">
                                    <form action="#">
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
                                    </form>
                                </div><!-- .End .tab-pane -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection



@section('script')
@endsection
