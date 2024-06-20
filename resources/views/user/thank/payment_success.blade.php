@extends('user.layout.main')

@section('main')
    <main class="main">
        <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a href="{{ redirect()->back() }}">Giỏ hàng</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Thanh toán</li>
                </ol>
            </div>

            <!-- End .container -->
        </nav>

        <!-- End .breadcrumb-nav -->

        <div class="login-page bg-image pt-8 pb-8 pt-md-12 pb-md-12 pt-lg-17 pb-lg-17"
            style="background-image: url('{{ asset('/') }}assets_fe/images/backgrounds/login-bg.jpg')">
            <div class="container">
                <div class="form-box reset-form-box">
                    <ul class="nav nav-pills nav-fill mb-3">
                        <li class="nav-item">
                            <a class="nav-link active">Thanh toán thành công</a>
                        </li>
                    </ul>

                    <div class="icon-box icon-box-circle text-center">
                        <span class="icon-box-icon">
                            {{-- <i class="icon-info-circle"></i> --}}
                            <i class="fa-solid fa-check-to-slot"></i>
                        </span>
                        <div class="icon-box-content">
                            <h3 class="icon-box-title">Kính gửi quý khách hàng</h3>
                            
                            <p>Bạn đã đặt hàng thành công tại cửa hàng <a href="">TN SHOP</a></p>
                            <p>Vui lòng chụp ảnh màn hình để lưu trang này!</p>
                            <p>Nếu bạn cần kiểm tra tình trạng đơn hàng và hậu cần, vui lòng sao chép mã đơn hàng và số điện thoại di động của bạn vào liên kết bên dưới để xem chi tiết</p>
                            <a href="">https://www.ief-vn.com/account/order-lookup</a>
                            <p>Nếu bạn có bất kỳ phản hồi nào về sản phẩm hoặc dịch vụ của chúng tôi, vui lòng cho chúng tôi biết</p>
                            <b>Xin cảm ơn !</b>

                          
                        </div>
                    </div>


                </div>

                <!-- End .form-box -->
            </div>

            <!-- End .container -->
        </div>

        <!-- End .login-page section-bg -->
    </main>
@endsection
