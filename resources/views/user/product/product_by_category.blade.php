    <div class="products">
        <div class="row justify-content-center" id="product-by-category">
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
                            <h3 class="product-title"><a
                                    href="{{ url($item->slug) }}">{{ Str::limit($item->title, 25) }}</a>
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
        </div>
        <!-- End .row -->
    </div>

    @if (count($countProductByCategoryId) > 8)
        <div class="more-container text-center">
            <button class="btn btn-outline-darker btn-more" id="btnMoreProductByCategoryId"
                data-category-id="{{ $categoryId }}"><span>Xem thêm</span><i class="icon-long-arrow-down"></i>
            </button>
        </div>
    @endif

    <script>
        // see more
        $(document).ready(function() {
            var limitOld = 8;
            $("#btnMoreProductByCategoryId").click(function() {
                var id = $(this).attr('data-category-id');
                var limit = limitOld + 8
                var url = "{{ route('getSeeMoreProductCategoryById') }}";
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        category_id: id,
                        limit: limit
                    },
                    success: function(response) {
                        console.log(response);
                        limitOld += 8;

                        $('#product-by-category').html(response.view);

                        if (limitOld >= {{ count($countProductByCategoryId) }}) {
                            $("#btnMoreProductByCategoryId").hide();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(
                            'There was a problem with the AJAX request:',
                            status, error);
                    }
                })
            })
        })
    </script>
