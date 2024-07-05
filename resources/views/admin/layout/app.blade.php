<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ env('APP_NAME') }} - @yield('title')</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="Admin template that can be used to build dashboards for CRM, CMS, etc." />
    <meta name="author" content="Potenza Global Solutions" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!-- app favicon -->
    <link rel="shortcut icon" href="{{ asset('/') }}assets_ad/img/favicon.ico">
    <!-- google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <!-- plugin stylesheets -->
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}assets_ad/css/vendors.css" />
    <!-- app style -->
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}assets_ad/css/style.css" />

    {{-- cdn jquery --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- plugins -->
    <script src="{{ asset('/') }}assets_ad/js/vendors.js"></script>
    <script src="{{ asset('/') }}assets_ad/sortable/jquery-ui.js"></script>

    {{-- sweetalert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script type="text/css'" src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"></script>

    @yield('style')
</head>

<body>
    <!-- begin app -->
    <div class="app">
        <!-- begin app-wrap -->
        <div class="app-wrap">
            <!-- begin pre-loader -->
            <div class="loader">
                <div class="h-100 d-flex justify-content-center">
                    <div class="align-self-center">
                        <img src="{{ asset('/') }}assets_ad/img/loader/loader.svg" alt="loader">
                    </div>
                </div>
            </div>
            <!-- end pre-loader -->

            <!-- begin app-header -->
            @include('admin.layout.header')
            <!-- end app-header -->

            <!-- begin app-container -->
            <div class="app-container">
                <!-- begin app-nabar -->
                @include('admin.layout.includes.navbar')
                <!-- end app-navbar -->
                <!-- begin app-main -->
                <div class="app-main" id="main">
                    <!-- begin container-fluid -->
                    <div class="container-fluid">
                        @yield('main')
                    </div>
                    <!-- end container-fluid -->
                </div>
                <!-- end app-main -->
            </div>
            <!-- end app-container -->
            <!-- begin footer -->
            @include('admin.layout.footer')
            <!-- end footer -->
        </div>
        <!-- end app-wrap -->
    </div>
    <!-- end app -->


    <!-- custom app -->
    <script src="{{ asset('/') }}assets_ad/js/app.js"></script>

    {{-- sort table --}}


    {{-- script --}}
    @yield('script')


    @if (request()->segment(2) != 'product')
        <style>
            @media (min-width:667px) {
                .modal-dialog {
                    max-width: 500px;
                    margin: 1.75rem auto
                }

                .modal-dialog-centered {
                    min-height: calc(100% - (1.75rem * 2))
                }

                .modal-dialog-centered::before {
                    height: calc(100vh - (1.75rem * 2))
                }

                .modal-sm {
                    max-width: 300px
                }
            }

            @media (min-width:992px) {
                .modal-lg {
                    max-width: 800px
                }
            }

            @media (min-width:1400px) {
                .modal-xl {
                    max-width: 1500px
                }
            }
        </style>
    @endif

    <script>
        $(function() {
            $("#product_table").sortable();
        });
    </script>

    {{-- slug --}}
    <script type="text/javascript">
        function ChangeToSlug() {
            var slug;
            //Lấy text từ thẻ input title 
            slug = document.getElementById("name").value;
            slug = slug.toLowerCase();
            //Đổi ký tự có dấu thành không dấu
            slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
            slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
            slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
            slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
            slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
            slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
            slug = slug.replace(/đ/gi, 'd');
            //Xóa các ký tự đặt biệt
            slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
            //Đổi khoảng trắng thành ký tự gạch ngang
            slug = slug.replace(/ /gi, "-");
            //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
            //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
            slug = slug.replace(/\-\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-/gi, '-');
            slug = slug.replace(/\-\-/gi, '-');
            //Xóa các ký tự gạch ngang ở đầu và cuối
            slug = '@' + slug + '@';
            slug = slug.replace(/\@\-|\-\@|\@/gi, '');
            //In slug ra textbox có id “slug”
            document.getElementById('convert_slug').value = slug;
        }
    </script>

    {{-- add image  --}}
    <script>
        function previewImages(input) {
            var preview = document.getElementById('image-preview');
            preview.innerHTML = '';

            if (input.files) {
                var filesAmount = input.files.length;
                for (i = 0; i < filesAmount; i++) {
                    var reader = new FileReader();

                    reader.onload = function(event) {
                        var imgElement = document.createElement('div');
                        imgElement.className = 'col-2 m-3 border';
                        imgElement.innerHTML = '<img class="w-100" style="height: 200px;" src="' + event.target.result +
                            '" alt="">';

                        preview.appendChild(imgElement);
                    }

                    reader.readAsDataURL(input.files[i]);
                }
            }
        }
    </script>


</body>


</html>
