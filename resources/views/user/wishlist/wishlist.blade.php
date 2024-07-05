@extends('user.layout.main')

@section('main')
    <main class="main">
        <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
            <div class="container">
                <h1 class="page-title">Sản phẩm yêu thích<span></span></h1>
            </div><!-- End .container -->
        </div><!-- End .page-header -->
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Trang chủ</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Sản phẩm yêu thích</li>
                </ol>
            </div><!-- End .container -->
        </nav><!-- End .breadcrumb-nav -->

        @if (Session::has('success'))
            <script>
                Swal.fire({
                    title: "{{ Session::get('success') }}",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 1600
                });
            </script>
        @endif

        <div class="page-content">
            <div class="container">
                <table class="table table-wishlist table-mobile text-center">
                    <thead class="table-primary">
                        <tr>
                            <th>STT</th>
                            <th>Ảnh</th>
                            <th>Tên</th>
                            <th>Giá gốc</th>
                            <th>Giá khuyến mại</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($wishlists as $key => $item)
                            @php
                                $getProductImage = $item->product->singleImage($item->product_id);
                            @endphp
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>
                                    <a href="{{ url($item->product->slug) }}"><img width="80px"
                                            src="{{ $getProductImage->checkImage() }}" alt=""></a>
                                </td>
                                <td width="150px">
                                    <a href="{{ url($item->product->slug) }}">{{ $item->product->title }}</a>
                                </td>
                                <td><span
                                        class="text-decoration-line-through">{{ number_format($item->product->price, 0, '', '.') }}₫</span>
                                </td>
                                <td>{{ number_format($item->product->old_price, 0, '', '.') }}₫</td>
                                <td>
                                    <form action="{{ route('removeWishlist', ['id' => $item->id]) }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-danger ">Xóa</button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table><!-- End .table table-wishlist -->
                <div class="wishlist-share">
                    <div class="social-icons social-icons-sm mb-2">
                        <label class="social-label">Chia sẻ:</label>
                        <a href="#" class="social-icon" title="Facebook" target="_blank"><i
                                class="icon-facebook-f"></i></a>
                        <a href="#" class="social-icon" title="Twitter" target="_blank"><i
                                class="icon-twitter"></i></a>
                        <a href="#" class="social-icon" title="Instagram" target="_blank"><i
                                class="icon-instagram"></i></a>
                        <a href="#" class="social-icon" title="Youtube" target="_blank"><i
                                class="icon-youtube"></i></a>
                        <a href="#" class="social-icon" title="Pinterest" target="_blank"><i
                                class="icon-pinterest"></i></a>
                    </div><!-- End .soial-icons -->
                </div><!-- End .wishlist-share -->
            </div><!-- End .container -->
        </div><!-- End .page-content -->
    </main>
@endsection
