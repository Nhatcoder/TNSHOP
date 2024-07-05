@extends('user.layout.main')

@section('style')
    <link rel="stylesheet" href="{{ asset('') }}assets_fe/css/plugins/nouislider/nouislider.css">
    <link rel="stylesheet" href="{{ asset('') }}assets_fe/css/plugins/owl-carousel/owl.carousel.css">
    <link rel="stylesheet" href="{{ asset('') }}assets_fe/css/plugins/magnific-popup/magnific-popup.css">
@endsection

@section('main')
    <main class="main">
        <div class="page-header text-center"
            style="background-image: url('{{ asset('') }}assets_fe/images/page-header-bg.jpg')">
            <div class="container">
                @if (!empty($category_subslug))
                    <h1 class="page-title">{{ $category_subslug->name }}</h1>
                @elseif (!empty($category_slug))
                    <h1 class="page-title">{{ $category_slug->name }}</h1>
                @elseif(!empty(Request::get('kw')))
                    <h1 class="page-title">Tìm kiếm : {{ Request::get('kw') }}</h1>
                @else
                    <h1 class="page-title">Sản phẩm</h1>
                @endif

            </div>
        </div>
        <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a href="#">Sản phẩm</a></li>
                    @if (!empty($category_subslug))
                        <li class="breadcrumb-item">
                            <a href="{{ url($category_slug->slug) }}">
                                {{ $category_slug->name }}
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            {{ $category_subslug->name }}
                        </li>
                    @elseif (!empty($category_slug))
                        <li class="breadcrumb-item active" aria-current="page">{{ $category_slug->name }}</li>
                    @endif


                </ol>
            </div>
        </nav>

        <div class="page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="getProductAjax">
                            @include('user.product.__product_filter')
                        </div>
                    </div>
                    <aside class="col-lg-3 order-lg-first ">
                        <form id="filter_form" action="" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" class="form-control" name="category_id" id="category_id">
                            <input type="hidden" class="form-control" name="sub_category_id" id="sub_category_id">
                            <input type="hidden" class="form-control" name="color_id" id="color_id">
                            <input type="hidden" class="form-control" name="brand_id" id="brand_id">
                            <input type="hidden" class="form-control" name="sort_by_id" id="sort_by_id">
                            <input type="hidden" class="form-control" name="price_start" id="price_start">
                            <input type="hidden" class="form-control" name="price_end" id="price_end">
                        </form>
                        <div class="sidebar sidebar-shop " id="sidebar-scroll">
                            <div class="widget widget-clean">
                                <label>Bộ Lọc:</label>
                                <a href="{{ url()->current() }}" class="sidebar-filter-clear">Xóa lọc</a>
                            </div>

                            @if (!empty($getSubCategoryFilter))
                                <div class="widget widget-collapsible">
                                    <h3 class="widget-title">
                                        <a data-toggle="collapse" href="#widget-1" role="button" aria-expanded="true"
                                            aria-controls="widget-1">
                                            Danh mục
                                        </a>
                                    </h3>

                                    <div class="collapse show" id="widget-1">
                                        <div class="widget-body">
                                            <div class="filter-items filter-items-count">
                                                @foreach ($getSubCategoryFilter as $item)
                                                    <div class="filter-item">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" value="{{ $item->id }}"
                                                                class="custom-control-input ChangeSubCategory"
                                                                id="cat-{{ $item->id }}">
                                                            <label class="custom-control-label"
                                                                for="cat-{{ $item->id }}">{{ $item->sub_name }}</label>
                                                        </div>
                                                    </div>
                                                @endforeach

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="widget widget-collapsible">
                                    <h3 class="widget-title">
                                        <a data-toggle="collapse" href="#widget-1" role="button" aria-expanded="true"
                                            aria-controls="widget-1">
                                            Danh mục
                                        </a>
                                    </h3>

                                    <div class="collapse show" id="widget-1">
                                        <div class="widget-body">
                                            <div class="filter-items filter-items-count">
                                                @foreach ($category as $item)
                                                    <div class="filter-item">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" value="{{ $item->id }}"
                                                                class="custom-control-input ChangeCategory"
                                                                id="cat-{{ $item->id }}">
                                                            <label class="custom-control-label"
                                                                for="cat-{{ $item->id }}">{{ $item->name }}</label>
                                                        </div>
                                                        {{-- <span class="item-count">3</span> --}}
                                                    </div>
                                                @endforeach

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif


                            {{-- brand --}}
                            <div class="widget widget-collapsible">
                                <h3 class="widget-title">
                                    <a data-toggle="collapse" href="#widget-4" role="button" aria-expanded="true"
                                        aria-controls="widget-4">
                                        Thương hiệu
                                    </a>
                                </h3>

                                <div class="collapse show" id="widget-4">
                                    <div class="widget-body">
                                        <div class="filter-items">
                                            @foreach ($getBrand as $item)
                                                <div class="filter-item">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" value="{{ $item->id }}"
                                                            class="custom-control-input changeBrand"
                                                            id="brand-{{ $item->id }}">
                                                        <label class="custom-control-label"
                                                            for="brand-{{ $item->id }}">{{ $item->name }}</label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="widget widget-collapsible">
                                <h3 class="widget-title">
                                    <a data-toggle="collapse" href="#widget-5" role="button" aria-expanded="true"
                                        aria-controls="widget-5">
                                        Giá
                                    </a>
                                </h3>

                                <div class="collapse show" id="widget-5">
                                    <div class="widget-body">
                                        <div class="filter-price">
                                            <div class="filter-price-text">
                                                Phạm vi giá::
                                                <span id="filter-price-range"></span>
                                            </div>

                                            <div id="price-slider"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('script')
    <script src="{{ asset('') }}assets_fe/js/nouislider.min.js"></script>
    <script src="{{ asset('') }}assets_fe/js/wNumb.js"></script>
    <script src="{{ asset('') }}assets_fe/js/bootstrap-input-spinner.js"></script>
    <script src="{{ asset('') }}assets_fe/js/jquery.magnific-popup.min.js"></script>
    <script src="{{ asset('') }}assets_fe/js/nouislider.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.ChangeCategory').change(function() {
                var ids = "";
                $('.ChangeCategory').each(function() {
                    if ($(this).is(':checked')) {
                        var id = $(this).val();
                        ids += id + ",";
                    }
                })
                $('#category_id').val(ids);
                // console.log(ids);
                filterForm();

            })


            $('.ChangeSubCategory').change(function() {
                var ids = "";
                $('.ChangeSubCategory').each(function() {
                    if ($(this).is(':checked')) {
                        var id = $(this).val();
                        ids += id + ",";
                    }
                })
                $('#sub_category_id').val(ids);

                filterForm();

            })


            $('.changeBrand').change(function() {
                var ids = "";
                $('.changeBrand').each(function() {
                    if ($(this).is(':checked')) {
                        var id = $(this).val();
                        ids += id + ",";
                    }
                })
                $('#brand_id').val(ids);

                filterForm();

            })


            // change color
            $('.changeColor').click(function() {
                var ids = "";

                var id = $(this).attr('data-id');
                var status = $(this).attr('data-status');

                // $(this).toggleClass('active-color');
                if (status == 0) {
                    $(this).attr('data-status', 1);
                    $(this).addClass('active-color');
                } else {
                    $(this).attr('data-status', 0);
                    $(this).removeClass('active-color');

                }

                $('.changeColor').each(function() {
                    var status = $(this).attr('data-status');

                    if (status == 1) {
                        var id = $(this).attr('data-id');
                        ids += id + ",";
                    }
                })

                $('#color_id').val(ids);
                filterForm();


            })

            // sort
            $('.ChangeSortBy').change(function() {
                var ids = "";
                var sortby = $(this).val();

                $('#sort_by_id').val(sortby);
                filterForm();
            })


            function filterForm() {
                $.ajax({
                    type: "POST",
                    url: "{{ url('get_filter_product_ajax') }}",
                    dataType: "JSON",
                    data: $('#filter_form').serialize(),
                    success: function(data) {
                        // console.log(data);
                        $(".getProductAjax").html(data.success);
                    }
                })
            }


            // Price Range
            if (typeof noUiSlider === 'object') {
                var priceSlider = document.getElementById('price-slider');

                if (priceSlider == null) return;

                noUiSlider.create(priceSlider, {
                    start: [0, 1000000],
                    connect: true,
                    step: 10000,
                    margin: 100000,
                    range: {
                        'min': 0,
                        'max': 1000000
                    },
                    tooltips: true,
                    format: wNumb({
                        decimals: 0,
                        thousand: '.',
                        postfix: '₫',
                    })
                });

                // Update Price Range
                priceSlider.noUiSlider.on('update', function(values, handle) {
                    $('#filter-price-range').text(values.join(' - '));
                });

                priceSlider.noUiSlider.on('set', function(values, handle) {
                    var price_start = values[0].replace(/\D/g, '');
                    var price_end = values[1].replace(/\D/g, '');
                    // console.log(price_start + "_" + price_end);

                    $('#price_start').val(price_start);
                    $('#price_end').val(price_end);
                    filterForm();
                });

            }

            // add Wishlist
            $(document).on('click', '.btn-wishlist', function() {
                var idProduct = $(this).data('id');
                var user_id = $(this).data('user-id');

                $.ajax({
                    url: "{{ route('addProductWishList') }}",
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        product_id: idProduct,
                        user_id: user_id
                    },
                    success: function(response) {
                        if (response.status == "success") {
                            $(".wishlist-count").text(response.count);

                            Swal.fire({
                                title: response.message,
                                icon: "success",
                                showConfirmButton: false,
                                timer: 1800
                            });

                        } else {
                            Swal.fire({
                                title: response.message,
                                icon: "error",
                                showConfirmButton: false,
                                timer: 1800
                            });
                        }
                    },
                })
            })

        })
    </script>
@endsection
