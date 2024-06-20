@extends('user.layout.main')

@section('style')
    <link rel="stylesheet" href="{{ asset('') }}assets_fe/css/plugins/nouislider/nouislider.css">
@endsection

@section('main')
    <main class="main">
        <div class="page-header text-center"
            style="background-image: url('{{ asset('') }}assets_fe/images/page-header-bg.jpg')">
            <div class="container">
                <h1 class="page-title">Giỏ hàng</h1>
            </div>
            <!-- End .container -->
        </div>
        <!-- End .page-header -->
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Trang chủ</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Giỏ hàng</li>
                </ol>
            </div>
            <!-- End .container -->
        </nav>
        <!-- End .breadcrumb-nav -->

        <div class="page-content">
            <div class="cart">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-9">
                            <table class="table table-cart table-mobile ">
                                <thead>
                                    <tr>
                                        <th>Sản phẩm</th>
                                        <th>Phân loại</th>
                                        <th>Giá</th>
                                        <th>Số lượng</th>
                                        <th>Tổng</th>
                                        <th></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach (Cart::getContent() as $product)
                                        @php
                                            $getProductSingle = App\Models\Product::getProductSingle($product->id);
                                            $getProductImage = $getProductSingle->singleImage($getProductSingle->id);

                                            $total = $product->price * $product->quantity;
                                        @endphp
                                        <tr>
                                            <td class="product-col">
                                                <div class="product">
                                                    <figure class="product-media">
                                                        <a href="#">
                                                            <img src="{{ $getProductImage->checkImage() }}"
                                                                alt="{{ $product->name }}">
                                                        </a>
                                                    </figure>
                                                    <h3 class="product-title">
                                                        <a href="#">{{ Str::limit($product->name, 20) }}</a>
                                                    </h3>
                                                </div>
                                            </td>
                                            <td>{{ $product->attributes->name_size }} -
                                                {{ $product->attributes->name_color }}</td>
                                            <td class="price-col" data-price="{{ $product->price }}">
                                                {{ number_format($product->price, '0', ',', '.') }}₫
                                            </td>
                                            <td class="quantity-col">
                                                <div class="cart-product-quantity">
                                                    <input type="number" class="form-control changePriceCart"
                                                        value="{{ $product->quantity }}" min="1" max="10"
                                                        step="1" data-decimals="0" data-id="{{ $product->id }}">
                                                </div>
                                            </td>
                                            <td data-id="{{ $product->id }}" class="total-col changeTotalPTotalPriceCart">
                                                {{ number_format($total, '0', ',', '.') }}₫
                                            </td>
                                            <td class="remove-col">
                                                <button class="btn-remove deleteProductCart" title="Xóa sản đơn hàng"
                                                    data-id="{{ $product->id }}"><i class="icon-close"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            <!-- End .table table-wishlist -->


                            <!-- End .cart-bottom -->
                        </div>
                        <!-- End .col-lg-9 -->
                        <aside class="col-lg-3">
                            <div class="summary summary-cart">
                                <h3 class="summary-title">Tổng số giỏ hàng</h3>
                                <!-- End .summary-title -->

                                <table class="table table-summary">
                                    <tbody>
                                        <tr class="summary-total">
                                            <td>Tổng giá:</td>
                                            <td>{{ number_format(Cart::getTotal(), 0, ',', '.') }}₫ </td>
                                        </tr>
                                        <!-- End .summary-total -->
                                    </tbody>
                                </table>
                                <!-- End .table table-summary -->

                                <a href="{{ route('checkOut') }}" class="btn btn-outline-primary-2 btn-order btn-block">Thủ
                                    tục thanh toán</a>
                            </div>
                            <!-- End .summary -->

                            <a href="{{ route('getProducts') }}" class="btn btn-outline-dark-2 btn-block mb-3"><span>Tiếp
                                    tục mua sắm</span><i class="icon-refresh"></i></a>
                        </aside>
                        <!-- End .col-lg-3 -->
                    </div>
                    <!-- End .row -->
                </div>
                <!-- End .container -->
            </div>
            <!-- End .cart -->
        </div>
        <!-- End .page-content -->
    </main>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('.changePriceCart').on('input', function() {
                // Lấy giá trị số lượng mới từ input
                var quantity = $(this).val();
                var id = $(this).attr('data-id');

                // Lấy giá sản phẩm từ thuộc tính data-price
                var price = $(this).closest('tr').find('.price-col').data('price');

                // Tính tổng giá mới
                var totalPrice = quantity * price;

                // Định dạng lại giá trị tiền tệ
                var formattedTotalPrice = new Intl.NumberFormat('vi-VN', {
                    style: 'currency',
                    currency: 'VND'
                }).format(totalPrice);

                // Cập nhật giá tổng trong HTML
                $(this).closest('tr').find('.changeTotalPTotalPriceCart').html(formattedTotalPrice);

                $.ajax({
                    type: "POST",
                    url: "{{ route('updateCart') }}",
                    dataType: "JSON",
                    data: {
                        id: id,
                        quantity: quantity,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        // alert('câp nhật thành công');
                    },

                });

            });


            // Xóa sản phẩm
            $('.deleteProductCart').on('click', function() {
                var id = $(this).attr('data-id');
                var elementTr = $(this).closest('tr');
                elementTr.remove();

                $.ajax({
                    type: "POST",
                    url: "{{ route('deleteCart') }}",
                    dataType: "JSON",
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        alert('Xóa thành công');
                    },

                });

            });
        });
    </script>
@endsection
