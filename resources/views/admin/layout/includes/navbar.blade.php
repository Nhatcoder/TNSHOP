 <aside class="app-navbar">
     <!-- begin sidebar-nav -->
     <div class="sidebar-nav scrollbar scroll_light">
         <ul class="metismenu " id="sidebarNav">
             <li class="nav-static-title">RIÊNG TƯ</li>
             {{-- <li class="{{ request()->is('admin/*') ? 'active' : '' }}"> --}}
             <li class="{{ request()->segment(2) == 'dashboard' ? 'active' : '' }}">
                 <a href="{{ route('dashboard') }}" aria-expanded="false">
                     <i class="nav-icon ti ti-rocket"></i>
                     <span class="nav-title">Dashboard</span>
                 </a>
             </li>
             <li class="{{ request()->segment(2) == 'user' ? 'active' : '' }}">
                 <a href="{{ route('user.index') }}" aria-expanded="false">
                     <i class="nav-icon fa fa-users"></i>
                     <span class="nav-title">Admin</span>
                 </a>
             </li>
             <li class="{{ request()->segment(2) == 'category' ? 'active' : '' }}">
                 <a href="{{ url('admin/category') }}" aria-expanded="false">
                     <i class="nav-icon ti ti-menu-alt"></i>
                     <span class="nav-title">Danh mục</span>
                 </a>
             </li>
             <li class="{{ request()->segment(2) == 'sub_category' ? 'active' : '' }}">
                 <a href="{{ route('sub_category.index') }}" aria-expanded="false">
                     <i class="nav-icon ti ti-menu"></i>
                     <span class="nav-title">Danh mục phụ</span>
                 </a>
             </li>
             <li class="{{ request()->segment(2) == 'brand' ? 'active' : '' }}">
                 <a href="{{ route('brand.index') }}" aria-expanded="false">
                     <i class="nav-icon ion ion-ios-megaphone"></i>
                     <span class="nav-title">Thương hiệu</span>
                 </a>
             </li>
             <li class="{{ request()->segment(2) == 'color' ? 'active' : '' }}">
                 <a href="{{ route('color.index') }}" aria-expanded="false">
                     <i class="nav-icon fa fa-eyedropper"></i>
                     <span class="nav-title">Màu</span>
                 </a>
             </li>
             <li class="{{ request()->segment(2) == 'product' ? 'active' : '' }}">
                 <a href="{{ route('product.index') }}" aria-expanded="false">
                     <i class="nav-icon fa fa-product-hunt"></i>
                     <span class="nav-title">Sản phẩm</span>
                 </a>
             </li>


         </ul>
     </div>
     <!-- end sidebar-nav -->
 </aside>
