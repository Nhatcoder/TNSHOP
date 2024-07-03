@extends('user.layout.main')

@section('style')
    <link rel="stylesheet" href="{{ asset('') }}assets_fe/css/plugins/nouislider/nouislider.css">
@endsection

@section('main')
    <main class="main">
        <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
            <div class="container d-flex align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('') }}">Trang chủ</a></li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a href="{{ url($productDetail->category->slug) }}">{{ $productDetail->category->name }}</a>
                    </li>

                    @empty(!$productDetail->subCategory)
                        <li class="breadcrumb-item" aria-current="page">
                            <a href="{{ url($productDetail->subCategory->slug) }}">{{ $productDetail->subCategory->name }}</a>
                        </li>
                    @endempty
                    <li class="breadcrumb-item active"><a
                            href="#">{{ Str::limit($productDetail->title, 20, '...') }}</a></li>
                </ol>

                <nav class="product-pager ml-auto" aria-label="Product">
                    <a class="product-pager-link product-pager-prev" href="#" aria-label="Previous" tabindex="-1">
                        <i class="icon-angle-left"></i>
                        <span>Prev</span>
                    </a>

                    <a class="product-pager-link product-pager-next" href="#" aria-label="Next" tabindex="-1">
                        <span>Next</span>
                        <i class="icon-angle-right"></i>
                    </a>
                </nav>
                <!-- End .pager-nav -->
            </div>
            <!-- End .container -->
        </nav>
        <!-- End .breadcrumb-nav -->

        <div class="page-content">
            <div class="container">
                <div class="product-details-top">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="product-gallery product-gallery-vertical">
                                <div class="{{ count($productDetail->productImage) > 1 ? 'row' : '' }} ">
                                    <figure class="product-main-image">
                                        @php
                                            $getProductImage = $productDetail->singleImage($productDetail->id);
                                        @endphp
                                        @empty(!$getProductImage && !$getProductImage->checkImage())
                                            <img id="product-zoom" src="{{ $getProductImage->checkImage() }}"
                                                data-zoom-image="{{ $getProductImage->checkImage() }}" alt="product image">

                                            <a href="#" id="btn-product-gallery" class="btn-product-gallery">
                                                <i class="icon-arrows"></i>
                                            </a>
                                        @endempty

                                    </figure>
                                    <!-- End .product-main-image -->

                                    @if (count($productDetail->productImage) > 1)
                                        <div id="product-zoom-gallery"
                                            class="product-image-gallery {{ count($productDetail->productImage) > 4 ? 'product-scroll-image' : '' }}">

                                            @foreach ($productDetail->productImage as $img)
                                                <a class="product-gallery-item active" href="#"
                                                    data-image="{{ $img->checkImage() }}"
                                                    data-zoom-image="{{ $img->checkImage() }}">
                                                    <img src="{{ $img->checkImage() }}" alt="{{ $img->title }}">
                                                </a>
                                            @endforeach
                                        </div>
                                    @endif
                                    <!-- End .product-image-gallery -->
                                </div>
                                <!-- End .row -->
                            </div>
                            <!-- End .product-gallery -->
                        </div>
                        <!-- End .col-md-6 -->

                        <div class="col-md-6">
                            <form id="form_add_to_cart" action="#" method="POST">
                                @csrf
                                <input type="hidden" id="product_id" name="product_id" value="{{ $productDetail->id }}">
                                <input type="hidden" id="color_id" name="color_id">
                                <input type="hidden" id="size_id" name="size_id">
                                <input type="hidden" id="quantity_cart" name="qty" value="1">
                            </form>
                            <div class="product-details">
                                <h1 class="product-title">{{ $productDetail->title }}</h1>
                                <!-- End .product-title -->

                                <div class="ratings-container">
                                    <div class="ratings">
                                        <div class="ratings-val" style="width: 80%;"></div>
                                    </div>
                                    <!-- End .ratings -->
                                    <a class="ratings-text" href="#product-review-link" id="review-link">( 2 đánh giá
                                        )</a>
                                </div>
                                <!-- End .rating-container -->

                                <div class="product-price" id="getChangePrice">
                                    {{ number_format($productDetail->price, 0, ',', '.') }}₫
                                </div>
                                <!-- End .product-price -->

                                <div class="product-content">
                                    <p>
                                        {{ $productDetail->short_description }}
                                    </p>
                                </div>
                                <!-- End .product-content -->

                                @empty(!$productDetail->color)
                                    <div class="d-flex flex-wrap">
                                        <label style="width: 76px;">Màu sắc</label>
                                        @foreach ($productDetail->color as $key => $item)
                                            <div class="color_list ">
                                                <input type="radio" name="color" class="color d-none"
                                                    id="color_{{ $key + 1 }}" value="{{ $item->id }}">
                                                <label for="color_{{ $key + 1 }}" class="color_item d-flex">
                                                    <img src="{{ $item->checkImage() }}" alt="product desc">
                                                    <span class="pr-2">{{ $item->color_name }}</span>
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                @endempty

                                @empty(!$productDetail->sizes)
                                    <div class="details-filter-row details-row-size">
                                        <label for="size">Kích thước</label>
                                        <div class="select-custom">
                                            <select name="size_id" id="size" class="form-control getPrice">
                                                <option value="#" data-price="0" selected="selected" disabled>Chọn kích
                                                    thước</option>
                                                @foreach ($productDetail->sizes as $size)
                                                    <option value="{{ $size->id }}" required
                                                        data-price="{{ $size->price }}">
                                                        {{ $size->name }} -
                                                        {{ number_format($size->price, 0, ',', '.') }}₫
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @endempty

                                <!-- End .details-filter-row -->
                                <div class="details-filter-row details-row-size">
                                    <label for="qty">Số lượng</label>
                                    <div class="product-details-quantity">
                                        <input type="number" id="qty" name="qty" class="form-control"
                                            value="1" min="1" max="10" step="1"
                                            data-decimals="0" required>
                                    </div>
                                    <!-- End .product-details-quantity -->
                                </div>
                                <!-- End .details-filter-row -->

                                <strong class="text-danger" id="error_msg"></strong>

                                <div class="product-details-action">
                                    <button type="submit" class="btn btn-product btn-cart"
                                        data-id="{{ $productDetail->id }}" id="addToCart">
                                        <span>Thêm giỏ hàng</span>
                                    </button>
                                    <div class="details-action-wrapper">
                                        <a href="#" class="btn-product btn-wishlist" title="Wishlist"><span>Thêm
                                                danh sách yêu thích</span>
                                        </a>
                                    </div>
                                    <!-- End .details-action-wrapper -->
                                </div>
                                <!-- End .product-details-action -->

                                <div class="product-details-footer">
                                    <div class="product-cat">
                                        <span>Danh mục:</span>
                                        <a
                                            href="{{ url($productDetail->category->slug) }}">{{ $productDetail->category->name }}</a>,

                                        @empty(!$productDetail->subCategory)
                                            <a
                                                href="{{ url($productDetail->subCategory->slug) }}">{{ $productDetail->subCategory->name }}</a>
                                        @endempty
                                    </div>
                                    <!-- End .product-cat -->

                                    <div class="social-icons social-icons-sm">
                                        <span class="social-label">Chia sẻ:</span>
                                        <a href="#" class="social-icon" title="Facebook" target="_blank"><i
                                                class="icon-facebook-f"></i></a>
                                        <a href="#" class="social-icon" title="Twitter" target="_blank"><i
                                                class="icon-twitter"></i></a>
                                        <a href="#" class="social-icon" title="Instagram" target="_blank"><i
                                                class="icon-instagram"></i></a>
                                        <a href="#" class="social-icon" title="Pinterest" target="_blank"><i
                                                class="icon-pinterest"></i></a>
                                    </div>
                                </div>
                                <!-- End .product-details-footer -->
                            </div>

                            <!-- End .product-details -->
                        </div>
                        <!-- End .col-md-6 -->
                    </div>
                    <!-- End .row -->
                </div>
                <!-- End .product-details-top -->

                <div class="product-details-tab">
                    <ul class="nav nav-pills justify-content-center" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="product-desc-link" data-toggle="tab" href="#product-desc-tab"
                                role="tab" aria-controls="product-desc-tab" aria-selected="true">Mô tả</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="product-info-link" data-toggle="tab" href="#product-info-tab"
                                role="tab" aria-controls="product-info-tab" aria-selected="false">Thông tin thêm</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="product-shipping-link" data-toggle="tab"
                                href="#product-shipping-tab" role="tab" aria-controls="product-shipping-tab"
                                aria-selected="false">Vận chuyển & Trả hàng</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="product-review-link" data-toggle="tab" href="#product-review-tab"
                                role="tab" aria-controls="product-review-tab" aria-selected="false">Đánh giá
                                ({{ count($getReviewByProductSlug) }})</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="product-desc-tab" role="tabpanel"
                            aria-labelledby="product-desc-link">
                            <div class="product-desc-content">
                                <p>{!! $productDetail->description !!}</p>
                            </div>
                            <!-- End .product-desc-content -->
                        </div><!-- .End .tab-pane -->
                        <div class="tab-pane fade" id="product-info-tab" role="tabpanel"
                            aria-labelledby="product-info-link">
                            <div class="product-desc-content">
                                {!! $productDetail->additional_information !!}
                            </div>
                            <!-- End .product-desc-content -->
                        </div><!-- .End .tab-pane -->
                        <div class="tab-pane fade" id="product-shipping-tab" role="tabpanel"
                            aria-labelledby="product-shipping-link">
                            <div class="product-desc-content">
                                {!! $productDetail->shipping_returns !!}
                            </div>
                            <!-- End .product-desc-content -->
                        </div><!-- .End .tab-pane -->
                        <div class="tab-pane fade" id="product-review-tab" role="tabpanel"
                            aria-labelledby="product-review-link">

                            <div class="reviews">
                                <h3>Đánh giá ({{ count($getReviewByProductSlug) }})</h3>
                                @foreach ($getReviewByProductSlug as $review)
                                    <div class="review">
                                        <div class="row no-gutters">
                                            <div class="col-auto">
                                                <img class="mb-2 ml-2" style="border-radius: 50%; width: 60px"
                                                    src="{{ $review->avatar }}" alt="">
                                                <h4><a href="#">{{ $review->name }}</a></h4>
                                                <div class="ratings-container">
                                                    <div class="d-flex py-3">
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            <i class="fa fa-star"
                                                                style="color: {{ $i <= $review->rating ? 'orange' : '' }};"></i>
                                                        @endfor
                                                    </div>
                                                    <!-- End .ratings -->
                                                </div>
                                                <!-- End .rating-container -->
                                            </div>
                                            <!-- End .col -->
                                            <div class="col">
                                                <h6>Phân loại:
                                                    {{ $review->color_name . ' Size ' . $review->size_name . '' }}</h6>
                                                <div class="review-content">
                                                    <p>{{ $review->comment }}</p>
                                                </div>
                                                <span class="review-date">{{ $review->created_at }}</span>

                                                <!-- End .review-content -->

                                                <div class="review-action">
                                                    <a href="#"><i class="icon-thumbs-up"></i> (2)</a>
                                                </div>
                                                <!-- End .review-action -->
                                            </div>
                                            <!-- End .col-auto -->
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                            <!-- End .reviews -->
                        </div><!-- .End .tab-pane -->
                    </div>
                    <!-- End .tab-content -->
                </div>
                <!-- End .product-details-tab -->

                <h2 class="title text-center mb-4">Bạn cũng có thể thích</h2>
                <!-- End .title text-center -->

                <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl"
                    data-owl-options='{
                            "nav": false, 
                            "dots": true,
                            "margin": 20,
                            "loop": false,
                            "responsive": {
                                "0": {
                                    "items":1
                                },
                                "480": {
                                    "items":2
                                },
                                "768": {
                                    "items":3
                                },
                                "992": {
                                    "items":4
                                },
                                "1200": {
                                    "items":4,
                                    "nav": true,
                                    "dots": false
                                }
                            }
                        }'>


                    @foreach ($relatedProducts as $product)
                        @php
                            $image = $product->singleImage($product->id);
                        @endphp
                        <div class="product product-7 text-center">
                            <figure class="product-media">
                                <span class="product-label label-new">Mới</span>
                                <a href="{{ url($product->slug) }}">
                                    <img src="{{ $image->checkImage() }}" alt="{{ $product->title }}"
                                        class="product-image">
                                </a>

                                <div class="product-action-vertical">
                                    <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>Thêm danh
                                            sách yêu thích</span></a>
                                    <a href="popup/quickView.html" class="btn-product-icon btn-quickview"
                                        title="Quick view"><span>Xem nhanh</span></a>
                                    <a href="#" class="btn-product-icon btn-compare" title="Compare"><span>So
                                            sánh</span></a>
                                </div>
                                <!-- End .product-action-vertical -->

                            </figure>
                            <!-- End .product-media -->

                            <div class="product-body">
                                <div class="product-cat">
                                    <a href="{{ url($product->category->slug) }}"> {{ $product->category->name }}</a>
                                </div>
                                <!-- End .product-cat -->
                                <h3 class="product-title"><a href="{{ url($product->slug) }}">{{ $product->title }}</a>
                                </h3>
                                <!-- End .product-title -->
                                <div class="product-price">
                                    {{ number_format($product->price, 0, ',', '.') }}₫
                                </div>

                            </div>
                            <!-- End .product-body -->
                        </div>
                    @endforeach


                </div>
                <!-- End .owl-carousel -->
            </div>
            <!-- End .container -->
        </div>
        <!-- End .page-content -->


    </main>
@endsection

@section('script')
    <script src="{{ asset('') }}assets_fe/js/bootstrap-input-spinner.js"></script>
    <script src="{{ asset('') }}assets_fe/js/jquery.elevateZoom.min.js"></script>
    <script src="{{ asset('') }}assets_fe/js/bootstrap-input-spinner.js"></script>
    <script src="{{ asset('') }}assets_fe/js/jquery.magnific-popup.min.js"></script>


    <script type="text/javascript">
        $('.getPrice').change(function() {
            var procut_price = {{ $productDetail->price }};
            var price = $('option:selected', this).attr('data-price');

            var total = procut_price + parseFloat(price);
            var formattedPrice = new Intl.NumberFormat('vi-VN', {
                style: 'decimal',
                minimumFractionDigits: 3,
                maximumFractionDigits: 3
            }).format(total / 1000).replace(/,/g, '.');

            $('#getChangePrice').html(formattedPrice + "₫");
        })
    </script>

    <script>
        $(document).ready(function() {
            $('.color').on('change', function() {
                var color_id = $(this).val();
                $('#color_id').val(color_id);
            });
            $(document).on('click', '.color_item', function() {
                $(".color_item").removeClass("active d-flex");
                $(this).addClass("active d-flex");
            })
            $('#size').on('change', function() {
                var size_id = $(this).val();
                $('#size_id').val(size_id);
            });
            
            $('#qty').on('change', function() {
                var quantity_cart = $(this).val();
                $('#quantity_cart').val(quantity_cart);
            });

            $("#addToCart").on('click', function() {
                var color_id = $('#color_id').val();
                var size_id = $('#size_id').val();
                if (color_id === "" || size_id === "") {
                    $("#error_msg").text("Vui lòng chọn phân loại hàng");
                    return false;
                }

                $.ajax({
                    type: "POST",
                    url: "{{ route('addProductToCart') }}",
                    dataType: "JSON",
                    data: $('#form_add_to_cart').serialize(),
                    success: function(data) {
                        Swal.fire({
                            title: "Đã thêm sản phẩm vào giỏ hàng",
                            icon: "success",
                            showConfirmButton: false,
                            timer: 1800
                        });
                        $("#cart_render").html(data.success);

                        $("#error_msg").text("");
                    }
                });
            });
        });
    </script>
@endsection
