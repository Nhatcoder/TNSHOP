@extends('user.layout.main')

@section('main')
    <main class="main">
        <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Trang chủ</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Đăng nhập</li>
                </ol>
            </div>
            <!-- End .container -->
        </nav>
        <!-- End .breadcrumb-nav -->

        <div class="login-page bg-image pt-8 pb-8 pt-md-12 pb-md-12 pt-lg-17 pb-lg-17"
            style="background-image: url('{{ asset('/') }}assets_fe/images/backgrounds/login-bg.jpg')">
            <div class="container">
                <div class="form-box">
                    <div class="form-tab">
                        <ul class="nav nav-pills nav-fill" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="signin-tab" data-toggle="tab" href="#signin" role="tab"
                                    aria-controls="signin" aria-selected="true">Đăng nhập</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="register-tab" data-toggle="tab" href="#register" role="tab"
                                    aria-controls="register" aria-selected="false">Đăng kí</a>
                            </li>

                        </ul>
                        <div class="tab-content" id="tab-content-5">
                            {{-- Sign In --}}
                            <div class="tab-pane fade show active" id="signin" role="tabpanel"
                                aria-labelledby="signin-tab">
                                <form action="#" method="POST" id="SubmitFormLogin">
                                    {{ csrf_field() }}

                                    <div class="form-group">
                                        <label for="signin-email">Email <b class="text-danger">*</b></label>
                                        <input type="text" class="form-control" placeholder="Nhập email"
                                            id="signin-email" name="signin_email">
                                        <p class="text-danger" id="email_signin_error"></p>
                                    </div>
                                    <!-- End .form-group -->

                                    <div class="form-group">
                                        <label for="signin-password">Mật khẩu *</label>
                                        <input type="password" class="form-control" placeholder="Nhập mật khẩu"
                                            id="signin-password" name="signin_password">
                                        <p class="text-danger" id="password_signin_error"></p>
                                        <p class="text-danger" id="error_login"></p>
                                    </div>
                                    <!-- End .form-group -->

                                    <div class="form-footer ">
                                        <button type="submit" class="btn btn-outline-primary-2">
                                            <span>Đăng nhập</span>
                                            <i class="icon-long-arrow-right"></i>
                                        </button>

                                        <a href="{{ route('forgot_password') }}" class="forgot-link float-end">Quên mật khẩu ?</a>
                                    </div><!-- End .form-footer -->
                                </form>
                                <div class="form-choice">
                                    <p class="text-center">Đăng nhập bằng</p>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <a href="{{ route('loginGoogle') }}" class="btn btn-login btn-g">
                                                <i class="icon-google"></i>
                                                Đăng nhập bằng Google
                                            </a>
                                        </div><!-- End .col-6 -->
                                        <div class="col-sm-6">
                                            <a href="#" class="btn btn-login btn-f">
                                                <i class="icon-facebook-f"></i>
                                                Đăng nhập bằng facebook
                                            </a>
                                        </div><!-- End .col-6 -->
                                    </div><!-- End .row -->
                                </div><!-- End .form-choice -->
                            </div><!-- .End .tab-pane -->

                            {{-- Register --}}
                            <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">
                                <form action="#" id="SubmitFormRegister" method="POST">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="register-email">Email <b class="text-danger">*</b></label>
                                        <input type="email" class="form-control" placeholder="Nhập email"
                                            id="register-email" name="register_email">
                                        <p class="text-danger" id="email_error"></p>
                                    </div><!-- End .form-group -->

                                    <div class="form-group">
                                        <label for="register-password">Mật khẩu <b class="text-danger">*</b></label>
                                        <input type="password" class="form-control" placeholder="Nhập mật khẩu"
                                            id="register-password" name="register_password">
                                        <p class="text-danger" id="password_error"></p>

                                    </div><!-- End .form-group -->

                                    <div class="form-footer">
                                        <button type="submit" class="btn btn-outline-primary-2">
                                            <span>Đăng kí</span>
                                            <i class="icon-long-arrow-right"></i>
                                        </button>

                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="register-policy"
                                                required>
                                            <label class="custom-control-label" for="register-policy">Tôi đồng ý
                                                với <a href="#">chính sách bảo mật</a> *</label>
                                        </div><!-- End .custom-checkbox -->
                                    </div><!-- End .form-footer -->
                                </form>
                                <div class="form-choice">
                                    <p class="text-center">Đăng nhập bằng</p>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <a href="{{ route('loginGoogle') }}" class="btn btn-login btn-g">
                                                <i class="icon-google"></i>
                                                Đăng nhập bằng Google
                                            </a>
                                        </div><!-- End .col-6 -->
                                        <div class="col-sm-6">
                                            <a href="#" class="btn btn-login  btn-f">
                                                <i class="icon-facebook-f"></i>
                                                Đăng nhập bằng Facebook
                                            </a>
                                        </div><!-- End .col-6 -->
                                    </div><!-- End .row -->
                                </div><!-- End .form-choice -->
                            </div><!-- .End .tab-pane -->
                        </div><!-- End .tab-content -->
                    </div><!-- End .form-tab -->
                </div>
                <!-- End .form-box -->
            </div>
            <!-- End .container -->
        </div>
        <!-- End .login-page section-bg -->
    </main>
@endsection
