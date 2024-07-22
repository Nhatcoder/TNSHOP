  <header class="header">
      <div class="header-top">
          <div class="container">
              <div class="header-left">

                  <div class="header-dropdown">
                      <a href="#">VN</a>
                      <div class="header-menu">
                          <ul>
                              <li><a href="#">Việt Nam</a></li>
                              <li><a href="#">English</a></li>
                          </ul>
                      </div>
                      <!-- End .header-menu -->
                  </div>
                  <!-- End .header-dropdown -->
              </div>
              <!-- End .header-left -->

              <div class="header-right">
                  <ul class="top-menu">
                      <li>
                          <a href="#">Links</a>

                          <ul>
                              @if (Auth::check())
                                  @php
                                      $wishlists = \App\Models\Wishlist::wishlistAll();
                                  @endphp
                                  <li><a href="tel:#"><i class="icon-phone"></i>Call: +0123 456 789</a></li>
                                  <li><a href="{{ route('wishlist') }}"><i class="icon-heart-o"></i>Sản phẩm yêu thích
                                          <span class="wishlist-count">({{ count($wishlists) }})</span>
                                      </a>
                                  </li>
                              @endif

                              <li><a href="about.html">Về chúng tôi</a></li>
                              <li><a href="contact.html">Liên hệ</a></li>
                              @if (Auth::check())
                                  <li>
                                      <a href="{{ route('acount') }}"><i class="icon-user"></i>{{ Auth::user()->name }}
                                      </a>
                                  </li>
                              @else
                                  <li><a href="#signin-modal" data-toggle="modal"><i class="icon-user"></i>Đăng nhập</a>
                                  </li>
                              @endif

                          </ul>
                      </li>
                  </ul>
                  <!-- End .top-menu -->
              </div>
              <!-- End .header-right -->
          </div>
          <!-- End .container -->
      </div>
      <!-- End .header-top -->

      <div class="header-middle sticky-header">
          <div class="container">
              <div class="header-left">
                  <button class="mobile-menu-toggler">
                      <span class="sr-only">Toggle mobile menu</span>
                      <i class="icon-bars"></i>
                  </button>

                  <a href="{{ '/' }}" class="logo">
                      <img src="{{ asset('/') }}assets_fe/images/logo_tn.png" alt="" width="105"
                          height="25">
                  </a>

                  <nav class="main-nav">
                      <ul class="menu sf-arrows">
                          <li class="megamenu-container active">
                              <a href="{{ '/' }}">Trang chủ</a>
                          </li>
                          <li>

                              @php
                                  $category = \App\Models\Category::with('sub_category')->get();
                              @endphp

                              <a href="{{ route('getProducts') }}">Sản phẩm</a>

                              <div class="megamenu megamenu-md">
                                  <div class="row no-gutters">
                                      <div class="col-md-12">
                                          <div class="menu-col">
                                              <div class="row">
                                                  @foreach ($category as $ct)
                                                      <div class="col-md-4 mb-3">
                                                          <a href="{{ url($ct->slug) }}"
                                                              class="menu-title">{{ $ct->name }}</a>
                                                          <ul>
                                                              @foreach ($ct->sub_category as $sub_ct)
                                                                  <li>
                                                                      <a
                                                                          href="{{ url($ct->slug . '/' . $sub_ct->slug) }}">
                                                                          {{ $sub_ct->name }}
                                                                      </a>
                                                                  </li>
                                                              @endforeach
                                                          </ul>
                                                      </div>
                                                  @endforeach

                                              </div>
                                          </div>
                                      </div>

                                  </div>
                              </div>
                          </li>

                          {{-- @foreach ($category as $item)
                              <li>
                                  <a href="#" class="sf-with-ul">{{ $item->name }}</a>

                                  <ul>
                                      <li><a href="login.html">Login</a></li>
                                      <li><a href="faq.html">FAQs</a></li>
                                      <li><a href="404.html">Error 404</a></li>
                                      <li><a href="coming-soon.html">Coming Soon</a></li>
                                  </ul>
                              </li>
                          @endforeach --}}


                      </ul>
                      <!-- End .menu -->
                  </nav>
                  <!-- End .main-nav -->
              </div>
              <!-- End .header-left -->

              <div class="header-right">
                  <div class="header-search">
                      <a href="#" class="search-toggle" role="button" title="Search"><i
                              class="icon-search"></i></a>
                      <form action="{{ url('tim-kiem') }}" method="get">
                          <div class="header-search-wrapper">
                              <label for="q" class="sr-only">Search</label>
                              <input type="search" class="form-control" name="kw" id="q"
                                  value="{{ Request::get('kw') ?? '' }}" placeholder="Search in..." required>
                          </div>
                          <!-- End .header-search-wrapper -->
                      </form>
                  </div>
                  <!-- End .header-search -->

                  <div id="cart_render">
                      @include('user.product.add_cart')
                  </div>

                  <!-- End .cart-dropdown -->
              </div>
              <!-- End .header-right -->
          </div>
          <!-- End .container -->
      </div>
      <!-- End .header-middle -->
  </header>
