  <div class="mobile-menu-container">
      <div class="mobile-menu-wrapper">
          <span class="mobile-menu-close"><i class="icon-close"></i></span>

          <form action="#" method="get" class="mobile-search">
              <label for="mobile-search" class="sr-only">Search</label>
              <input type="search" class="form-control" name="mobile-search" id="mobile-search"
                  placeholder="Search in..." required>
              <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
          </form>

          @php
              $category = \App\Models\Category::with('sub_category')->get();
          @endphp
          <nav class="mobile-nav">
              <ul class="mobile-menu">
                  <li class="active">
                      <a href="{{ url('/') }}">Trang chủ</a>
                  </li>

                  <li>
                      <a href="#" class="sf-with-ul">Cửa hàng</a>
                      <ul>
                          @foreach ($category as $ct)
                              <li>
                                  <a href="{{ url($ct->slug) }}">{{ $ct->name }}</a>
                                  <ul>
                                      @foreach ($ct->sub_category as $sub_ct)
                                          <li><a href="{{ url($ct->slug . '/' . $sub_ct->slug) }}">{{ $sub_ct->name }}</a>
                                          </li>
                                      @endforeach
                                  </ul>
                              </li>
                          @endforeach

                      </ul>
                  </li>
              </ul>
          </nav>

          <div class="social-icons">
              <a href="#" class="social-icon" target="_blank" title="Facebook"><i class="icon-facebook-f"></i></a>
              <a href="#" class="social-icon" target="_blank" title="Twitter"><i class="icon-twitter"></i></a>
              <a href="#" class="social-icon" target="_blank" title="Instagram"><i class="icon-instagram"></i></a>
              <a href="#" class="social-icon" target="_blank" title="Youtube"><i class="icon-youtube"></i></a>
          </div>
      </div>
  </div>
