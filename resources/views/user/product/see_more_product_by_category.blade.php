@foreach ($productByCategoryId as $item)
    <div class="col-6 col-md-4 col-lg-3 mb-4">
        <div class="product product-11 mt-v3 text-center">
            <figure class="product-media">
                @php
                    $getImage = App\Models\Product::limitImage($item->id);
                @endphp
                <a href="{{ url($item->slug) }}">
                    @foreach ($getImage as $key => $img)
                        <img src="{{ $img->checkImage() }}" alt="Product image"
                            class="{{ $key == 0 ? 'product-image' : 'product-image-hover' }}">
                    @endforeach
                </a>

                <div class="product-action-vertical">
                    <a href="#" class="btn-product-icon btn-wishlist "><span>add to
                            wishlist</span></a>
                </div>
                <!-- End .product-action-vertical -->
            </figure>
            <!-- End .product-media -->

            <div class="product-body">
                <h3 class="product-title"><a href="{{ url($item->slug) }}">{{ Str::limit($item->title, 25) }}</a>
                </h3>
                <!-- End .product-title -->
                <div class="product-price">
                    {{ number_format($item->price, 0, ',', '.') }}₫
                </div>
                <!-- End .product-price -->

            </div>

        </div>
        <!-- End .product -->
    </div>
@endforeach
