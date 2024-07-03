      <div class="toolbox">
          <div class="toolbox-left">
              <div class="toolbox-info">
                  Hiển thị <span>{{ $product->total() }} /{{ $product->perPage() }}</span> Sản phẩm
              </div>
          </div>

          <div class="toolbox-right">
              <div class="toolbox-sort">
                  <label for="sortby">Sắp xếp:</label>
                  <div class="select-custom">
                      <select name="sortby" id="sortby" class="form-control ChangeSortBy">
                          <option value="hot" selected="selected">Nổi bật</option>
                          <option value="price_asc">Giá cao đến thấp</option>
                          <option value="price_desc">Giá thấp đến cao</option>
                      </select>
                  </div>
              </div>
          </div>
      </div>
      <div class="products mb-3">
          <div class="row ">
              @foreach ($product as $item)
                  @php
                      $image = $item->singleImage($item->id);
                  @endphp
                  <div class="col-6 col-md-4 col-lg-4">
                      <div class="product product-7 text-center">
                          <figure class="product-media">
                              <span class="product-label label-new">Mới</span>
                              <a href="{{ url($item->slug) }}">
                                  @if (!empty($image) && $image->checkImage())
                                      <img src="{{ $image->checkImage() }}" alt="{{ $item->title }}"
                                          class="product-image">
                                  @endif
                              </a>

                              <div class="product-action-vertical">
                                  <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>Thêm
                                          danh sách yêu thích</span></a>
                              </div>
                          </figure>

                          <div class="product-body">
                              <div class="product-cat">
                                  <a href="{{ url($item->category_slug) }}">{{ $item->category_name }}</a>
                              </div>

                              <h3 class="product-title">
                                  <a href="{{ url($item->slug) }}">{{ Illuminate\Support\Str::limit($item->title, 20, '...') }}
                                  </a>
                              </h3>

                              <div class="product-price">
                                  {{ number_format($item->price, 0, ',', '.') }}₫
                              </div>
                              <div class="ratings-container">
                                  <div class="ratings">
                                      <div class="ratings-val" style="width: 20%;"></div>
                                  </div>
                                  <span class="ratings-text">( 2 đánh giá )</span>
                              </div>
                          </div>
                      </div>
                  </div>
              @endforeach

          </div>
      </div>

      {{-- {{ $product->links() }} --}}
      {{-- Phân trang --}}
      
      @if ( $product->total() > 9)
          <nav aria-label="Page navigation">
              <ul class="pagination justify-content-center">
                  @if ($product->onFirstPage())
                      <li class="page-item disabled">
                          <a class="page-link page-link-prev" href="#" aria-label="Previous" tabindex="-1"
                              aria-disabled="true">
                              <span aria-hidden="true"><i class="icon-long-arrow-left"></i></span>Lùi
                          </a>
                      </li>
                  @else
                      <li class="page-item">
                          <a class="page-link page-link-prev" href="{{ $product->previousPageUrl() }}"
                              aria-label="Previous">
                              <span aria-hidden="true"><i class="icon-long-arrow-left"></i></span>Prev
                          </a>
                      </li>
                  @endif

                  <!-- Hiển thị trang đầu tiên -->
                  <li class="page-item {{ $product->currentPage() == 1 ? 'active' : '' }}">
                      <a class="page-link" href="{{ $product->url(1) }}">1</a>
                  </li>

                  <!-- Hiển thị dấu ... nếu cần -->
                  @if ($product->currentPage() > 3)
                      <li class="page-item "><span class="page-link">...</span></li>
                  @endif

                  <!-- Hiển thị trang trước trang hiện tại nếu không phải là trang đầu tiên -->
                  @if ($product->currentPage() > 2)
                      <li class="page-item">
                          <a class="page-link"
                              href="{{ $product->url($product->currentPage() - 1) }}">{{ $product->currentPage() - 1 }}</a>
                      </li>
                  @endif

                  <!-- Hiển thị trang hiện tại -->
                  @if ($product->currentPage() != 1 && $product->currentPage() != $product->lastPage())
                      <li class="page-item active">
                          <a class="page-link" href="#">{{ $product->currentPage() }}</a>
                      </li>
                  @endif

                  <!-- Hiển thị trang sau trang hiện tại nếu không phải là trang cuối cùng -->
                  @if ($product->currentPage() < $product->lastPage() - 1)
                      <li class="page-item">
                          <a class="page-link"
                              href="{{ $product->url($product->currentPage() + 1) }}">{{ $product->currentPage() + 1 }}</a>
                      </li>
                  @endif

                  <!-- Hiển thị dấu ... nếu cần -->
                  @if ($product->currentPage() < $product->lastPage() - 2)
                      <li class="page-item "><span class="page-link">...</span></li>
                  @endif

                  <!-- Hiển thị trang cuối cùng -->
                  @if ($product->lastPage() > 1)
                      <li class="page-item {{ $product->currentPage() == $product->lastPage() ? 'active' : '' }}">
                          <a class="page-link"
                              href="{{ $product->url($product->lastPage()) }}">{{ $product->lastPage() }}</a>
                      </li>
                  @endif

                  @if ($product->hasMorePages())
                      <li class="page-item">
                          <a class="page-link page-link-next" href="{{ $product->nextPageUrl() }}" aria-label="Next">
                              Tiến <span aria-hidden="true"><i class="icon-long-arrow-right"></i></span>
                          </a>
                      </li>
                  @else
                      <li class="page-item disabled">
                          <a class="page-link page-link-next" href="#" aria-label="Next" tabindex="-1"
                              aria-disabled="true">
                              Tiến <span aria-hidden="true"><i class="icon-long-arrow-right"></i></span>
                          </a>
                      </li>
                  @endif
              </ul>
          </nav>
      @endif

      