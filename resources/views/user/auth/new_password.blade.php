@extends('user.layout.main')

@section('main')
    <main class="main">
        <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Trang chủ</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Đặt lại mật khẩu</li>
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
                    {{-- <form action="{{ route('auth_update_password') }}" method="POST" id="SubmitFormReset"> --}}
                    <form action="#" method="POST" id="SubmitFormCreatePassWord">
                        {{ csrf_field() }}
                        <input type="hidden" name="token" id="remember_token" value="{{ $token }}">

                        <div class="form-group">
                            <label for="new_password">Mật khẩu mới<b class="text-danger">*</b></label>
                            <input type="password" class="form-control" placeholder="Nhập mật khẩu mới" id="new_password"
                                name="new_password">
                            <p class="text-danger" id="new_password_error"></p>
                        </div>
                        <div class="form-group">
                            <label for="signin-email">Xác nhận mật khẩu<b class="text-danger">*</b></label>
                            <input type="password" class="form-control" placeholder="Xác nhận mật khẩu"
                                id="verify_new_password" name="verify_new_password">
                            <p class="text-danger" id="verify_new_password_error"></p>
                        </div>

                        <div class="form-footer ">
                            <button type="submit" class="btn btn-outline-primary-2">
                                <span>Xác nhận</span>
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
            $('#SubmitFormCreatePassWord').on('submit', function(e) {
                e.preventDefault();

                var remember_token = $('#remember_token').val();
                var new_password = $('#new_password').val();
                var verify_new_password = $('#verify_new_password').val();
                var new_password_error = $('#new_password_error');
                var verify_new_password_error = $('#verify_new_password_error');

                // Xóa các thông báo lỗi trước đó
                new_password_error.text('');
                verify_new_password_error.text('');

                function isStrongPassword(password) {
                    var strongPasswordPattern =
                        /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
                    return strongPasswordPattern.test(password);
                }

                if (!new_password) {
                    new_password_error.text('Mật khẩu không được để trống.');
                    return;
                }

                if (!verify_new_password) {
                    verify_new_password_error.text('Vui lòng xác nhận mật khẩu.');
                    return;
                }

                if (new_password !== verify_new_password) {
                    verify_new_password_error.text('Mật khẩu không khớp.');
                    return;
                }

                if (!isStrongPassword(new_password)) {
                    new_password_error.text(
                        'Mật khẩu phải có ít nhất 8 ký tự, bao gồm chữ hoa, chữ thường, số và ký tự đặc biệt.'
                    );
                    return;
                }

                $.ajax({
                    type: "POST",
                    url: "{{ route('auth_update_password') }}",
                    dataType: "JSON",
                    data: {
                        new_password: new_password,
                        token: remember_token,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        Swal.fire({
                            title: "Đổi mật khẩu thành công !",
                            icon: "success",
                            showConfirmButton: false,
                            timer: 1800
                        });
                        setTimeout(() => {
                            window.location.href = "{{ route('user_auth') }}";
                        }, 1900);
                    }
                });
            });
        });
    </script>
@endsection
