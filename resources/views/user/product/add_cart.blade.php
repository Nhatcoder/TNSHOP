 <div class="dropdown cart-dropdown">
     <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true"
         aria-expanded="false" data-display="static">
         <i class="icon-shopping-cart"></i>
         <span class="cart-count" id="cartCount">{{ Cart::getContent()->count() }}</span>
     </a>
     <div class="dropdown-menu dropdown-menu-right">
         <div class="dropdown-cart-products" id="CartProductItem">
             @php
                 $cartItems = Cart::getContent()->sortByDesc('attributes.create_at')->take(4);
             @endphp

             @foreach ($cartItems as $header_cart)
                 @php
                     $getProductSingle = App\Models\Product::getProductSingle($header_cart->attributes->product_id);
                     $getProductImage = $getProductSingle->singleImage($getProductSingle->id);
                 @endphp
                 <div class="product">
                     <div class="product-cart-details">
                         <h4 class="product-title">
                             <a href="{{ $getProductSingle->slug }}">{{ Str::limit($header_cart->name, 20) }}</a>
                         </h4>
                         <span class="cart-product-info">
                             <span class="cart-product-qty">SL:{{ $header_cart->quantity }}</span>
                             x {{ number_format($header_cart->price, 0, ',', '.') }}₫
                         </span>
                         <p>Size:{{ $header_cart->attributes->name_size }}</p>
                         <p>{{ $header_cart->attributes->name_color }}</p>
                     </div>
                     <!-- End .product-cart-details -->

                     <figure class="product-image-container">
                         <a href="product.html" class="product-image">
                             <img src="{{ $getProductImage->checkImage() }}" alt="product">
                         </a>
                     </figure>
                 </div>
             @endforeach

         </div>
         <!-- End .cart-product -->

         @if (!Cart::isEmpty())
             <div class="dropdown-cart-total">
                 <span>tổng</span>

                 <span class="cart-total-price">{{ number_format(Cart::getTotal(), 0, ',', '.') }}₫</span>
             </div>
             <!-- End .dropdown-cart-total -->

             <div class="dropdown-cart-action">
                 <a href="{{ url('gio-hang') }}" class="btn btn-primary">Giỏ hàng</a>
                 <a href="{{ url('thanh-toan') }}" class="btn btn-outline-primary-2"><span>Thanh
                         toán</span><i class="icon-long-arrow-right"></i></a>
             </div>
         @else
         <div class="text-center">
            {{-- <img src="{{ asset('/') }}assets_fe/images/cart.jpg" alt=""> --}}
            <img src="{{ asset('/') }}assets_fe/images/no_cart.png" alt="">
         </div>
             <p class="text-center">Chưa có sản phẩm</p>
         @endif
     </div>
 </div>
