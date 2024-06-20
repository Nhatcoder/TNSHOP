@extends('user.layout.main')

@section('main')
    <main class="main">
        <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a href="{{ redirect()->back() }}">Đặt lại mật khẩu</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Chờ xác nhận</li>
                </ol>
            </div>

            <!-- End .container -->
        </nav>

        <!-- End .breadcrumb-nav -->

        <div class="login-page bg-image pt-8 pb-8 pt-md-12 pb-md-12 pt-lg-17 pb-lg-17"
            style="background-image: url('{{ asset('/') }}assets_fe/images/backgrounds/login-bg.jpg')">
            <div class="container">
                <div class="form-box">
                    <ul class="nav nav-pills nav-fill mb-3">
                        <li class="nav-item">
                            <a class="nav-link active">Đã gửi Email</a>
                        </li>
                    </ul>

                    <div class="icon-box icon-box-circle text-center">
                        <span class="icon-box-icon">
                            {{-- <i class="icon-info-circle"></i> --}}
                            <i class="fa-solid fa-envelope-circle-check"></i>
                        </span>
                        <div class="icon-box-content">
                            <h3 class="icon-box-title">Đến email</h3>
                            <b class="text-danger">{{ Session::get('email') }}</b>
                            <p>Vui lòng xác minh.</p>
                            <p>Nếu bạn chưa nhận được email của chúng tôi bấm <a href="{{ route('forgot_password') }}">Tại đây</a>
                            </p>
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
