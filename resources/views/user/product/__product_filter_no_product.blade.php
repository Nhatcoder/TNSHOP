    <div class="products mb-3">
        <div class="error-content"
            style="background-image: url({{ asset('') }}assets_fe/images/backgrounds/no-result.gif)">
            <div class="text-center">
                {{-- <img src="{{ asset('') }}assets_fe/images/backgrounds/no-result.gif" alt="" class="w-100"> --}}
                <h1 class="error-title">Không có sản phẩm </h1><!-- End .error-title -->
                <p >Không có sản phẩm nào phù hợp với tiêu chí lọc!</p>
                <a href="{{ route('getProducts') }}" class="btn btn-outline-primary-2 btn-minwidth-lg">
                    <span>Xem tất cả sản phẩm</span>
                    <i class="icon-long-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
