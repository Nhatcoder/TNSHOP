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
                    <ul class="nav nav-pills nav-fill mb-3">
                        <li class="nav-item">
                            <a class="nav-link active">Đặt lại mật khẩu</a>
                        </li>
                    </ul>
                    {{-- <form action="{{ route('verify_email') }}" method="POST" id="SubmitFormReset"> --}}
                    <form action="#" method="POST" id="SubmitFormReset">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="signin-email">Email <b class="text-danger">*</b></label>
                            <input type="text" class="form-control" placeholder="Nhập email" id="user_email"
                                name="email">
                            <p class="text-danger" id="email_error"></p>
                        </div>

                        <div class="form-footer ">
                            <button type="submit" class="btn btn-outline-primary-2">
                                <span>Tiếp theo</span>
                                <i class="icon-long-arrow-right"></i>
                            </button>
                        </div>

                    </form>

                </div>
                <!-- End .form-box -->
            </div>
            <!-- End .container -->
        </div>
        <!-- End .login-page section-bg -->
    </main>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#SubmitFormReset').on('submit', function(e) {
                e.preventDefault();
                var email = $('#user_email').val();
                var email_error = $('#email_error');

                $.ajax({
                    type: "POST",
                    url: "{{ route('verify_email') }}",
                    dataType: "JSON",
                    data: {
                        email: email,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.status == true) {
                            window.location.href = response.router;
                        } else {
                            email_error.text(response.message);
                            $('#user_email').addClass('is-invalid');

                            if (response.errors.email) {
                                email_error.text(response.errors.email);
                            }
                        }
                    },
                })
            })
        })
    </script>
@endsection
