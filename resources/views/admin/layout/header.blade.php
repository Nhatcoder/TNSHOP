 <header class="app-header top-bar">
     <!-- begin navbar -->
     <nav class="navbar navbar-expand-md">
         <!-- begin navbar-header -->
         <div class="navbar-header d-flex align-items-center">
             <a href="#" class="mobile-toggle"><i class="ti ti-align-right"></i></a>
             <a class="navbar-brand" href="{{ url('admin/dashboard') }}">
                 <img src="{{ asset('/') }}assets_ad/img/logo.png" class="img-fluid logo-desktop" alt="logo" />
                 <img src="{{ asset('/') }}assets_ad/img/logo-icon.png" class="img-fluid logo-mobile" alt="logo" />
             </a>
         </div>
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
             aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
             <i class="ti ti-align-left"></i>
         </button>
         <!-- end navbar-header -->
         <!-- begin navigation -->
         <div class="collapse navbar-collapse" id="navbarSupportedContent">
             <div class="navigation d-flex">
                 <ul class="navbar-nav nav-left">
                     <li class="nav-item">
                         <a href="javascript:void(0)" class="nav-link sidebar-toggle">
                             <i class="ti ti-align-right"></i>
                         </a>
                     </li>

                     <li class="nav-item full-screen d-none d-lg-block" id="btnFullscreen">
                         <a href="javascript:void(0)" class="nav-link expand">
                             <i class="icon-size-fullscreen"></i>
                         </a>
                     </li>
                 </ul>
                 <ul class="navbar-nav nav-right ml-auto">
                     <li class="nav-item dropdown">
                         <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="navbarDropdown2"
                             role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                             <i class="ti ti-email"></i>
                         </a>
                         <div class="dropdown-menu extended animated fadeIn" aria-labelledby="navbarDropdown">
                             <ul>
                                 <li class="dropdown-header bg-gradient p-4 text-white text-left">Messages
                                     <label class="label label-info label-round">6</label>
                                     <a href="#" class="float-right btn btn-square btn-inverse-light btn-xs m-0">
                                         <span class="font-13"> Mark all as read</span></a>
                                 </li>
                                 <li class="dropdown-body">
                                     <ul class="scrollbar scroll_dark max-h-240">
                                         <li>
                                             <a href="javascript:void(0)">
                                                 <div class="notification d-flex flex-row align-items-center">
                                                     <div class="notify-icon bg-img align-self-center">
                                                         <img class="img-fluid"
                                                             src="{{ asset('/') }}assets_ad/img/avtar/03.jpg"
                                                             alt="user3">
                                                     </div>
                                                     <div class="notify-message">
                                                         <p class="font-weight-bold">Brianing Leyon</p>
                                                         <small>You will sail along until you...</small>
                                                     </div>
                                                 </div>
                                             </a>
                                         </li>
                                         <li>
                                             <a href="javascript:void(0)">
                                                 <div class="notification d-flex flex-row align-items-center">
                                                     <div class="notify-icon bg-img align-self-center">
                                                         <img class="img-fluid"
                                                             src="{{ asset('/') }}assets_ad/img/avtar/01.jpg"
                                                             alt="user">
                                                     </div>
                                                     <div class="notify-message">
                                                         <p class="font-weight-bold">Jimmyimg Leyon</p>
                                                         <small>Okay</small>
                                                     </div>
                                                 </div>
                                             </a>
                                         </li>
                                         <li>
                                             <a href="javascript:void(0)">
                                                 <div class="notification d-flex flex-row align-items-center">
                                                     <div class="notify-icon bg-img align-self-center">
                                                         <img class="img-fluid"
                                                             src="{{ asset('/') }}assets_ad/img/avtar/02.jpg"
                                                             alt="user2">
                                                     </div>
                                                     <div class="notify-message">
                                                         <p class="font-weight-bold">Brainjon Leyon</p>
                                                         <small>So, make the decision...</small>
                                                     </div>
                                                 </div>
                                             </a>
                                         </li>
                                         <li>
                                             <a href="javascript:void(0)">
                                                 <div class="notification d-flex flex-row align-items-center">
                                                     <div class="notify-icon bg-img align-self-center">
                                                         <img class="img-fluid"
                                                             src="{{ asset('/') }}assets_ad/img/avtar/04.jpg"
                                                             alt="user4">
                                                     </div>
                                                     <div class="notify-message">
                                                         <p class="font-weight-bold">Smithmin Leyon</p>
                                                         <small>Thanks</small>
                                                     </div>
                                                 </div>
                                             </a>
                                         </li>
                                         <li>
                                             <a href="javascript:void(0)">
                                                 <div class="notification d-flex flex-row align-items-center">
                                                     <div class="notify-icon bg-img align-self-center">
                                                         <img class="img-fluid"
                                                             src="{{ asset('/') }}assets_ad/img/avtar/05.jpg"
                                                             alt="user5">
                                                     </div>
                                                     <div class="notify-message">
                                                         <p class="font-weight-bold">Jennyns Leyon</p>
                                                         <small>How are you</small>
                                                     </div>
                                                 </div>
                                             </a>
                                         </li>
                                         <li>
                                             <a href="javascript:void(0)">
                                                 <div class="notification d-flex flex-row align-items-center">
                                                     <div class="notify-icon bg-img align-self-center">
                                                         <img class="img-fluid"
                                                             src="{{ asset('/') }}assets_ad/img/avtar/06.jpg"
                                                             alt="user6">
                                                     </div>
                                                     <div class="notify-message">
                                                         <p class="font-weight-bold">Demian Leyon</p>
                                                         <small>I like your themes</small>
                                                     </div>
                                                 </div>
                                             </a>
                                         </li>
                                     </ul>
                                 </li>
                                 <li class="dropdown-footer">
                                     <a class="font-13" href="javascript:void(0)"> View All messages </a>
                                 </li>
                             </ul>
                         </div>
                     </li>
                     <li class="nav-item dropdown">
                         <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="navbarDropdown3"
                             role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                             <i class="fe fe-bell"></i>
                             <span class="notify">
                                 <span class="blink"></span>
                                 <span class="dot"></span>
                             </span>
                         </a>
                         <div class="dropdown-menu extended animated fadeIn" aria-labelledby="navbarDropdown">
                             <ul>
                                 <li class="dropdown-header bg-gradient p-4 text-white text-left">
                                     Notifications
                                     <a href="#"
                                         class="float-right btn btn-square btn-inverse-light btn-xs m-0">
                                         <span class="font-13"> Clear all</span></a>
                                 </li>
                                 <li class="dropdown-body min-h-240 nicescroll">
                                     <ul class="scrollbar scroll_dark max-h-240">
                                         <li>
                                             <a href="javascript:void(0)">
                                                 <div class="notification d-flex flex-row align-items-center">
                                                     <div class="notify-icon bg-img align-self-center">
                                                         <div class="bg-type bg-type-md">
                                                             <span>HY</span>
                                                         </div>
                                                     </div>
                                                     <div class="notify-message">
                                                         <p class="font-weight-bold">New registered user</p>
                                                         <small>Just now</small>
                                                     </div>
                                                 </div>
                                             </a>
                                         </li>
                                         <li>
                                             <a href="javascript:void(0)">
                                                 <div class="notification d-flex flex-row align-items-center">
                                                     <div class="notify-icon bg-img align-self-center">
                                                         <div class="bg-type bg-type-md bg-success">
                                                             <span>GM</span>
                                                         </div>
                                                     </div>
                                                     <div class="notify-message">
                                                         <p class="font-weight-bold">New invoice received
                                                         </p>
                                                         <small>22 min</small>
                                                     </div>
                                                 </div>
                                             </a>
                                         </li>
                                         <li>
                                             <a href="javascript:void(0)">
                                                 <div class="notification d-flex flex-row align-items-center">
                                                     <div class="notify-icon bg-img align-self-center">
                                                         <div class="bg-type bg-type-md bg-danger">
                                                             <span>FR</span>
                                                         </div>
                                                     </div>
                                                     <div class="notify-message">
                                                         <p class="font-weight-bold">Server error report</p>
                                                         <small>7 min</small>
                                                     </div>
                                                 </div>
                                             </a>
                                         </li>
                                         <li>
                                             <a href="javascript:void(0)">
                                                 <div class="notification d-flex flex-row align-items-center">
                                                     <div class="notify-icon bg-img align-self-center">
                                                         <div class="bg-type bg-type-md bg-info">
                                                             <span>HT</span>
                                                         </div>
                                                     </div>
                                                     <div class="notify-message">
                                                         <p class="font-weight-bold">Database report</p>
                                                         <small>1 day</small>
                                                     </div>
                                                 </div>
                                             </a>
                                         </li>
                                         <li>
                                             <a href="javascript:void(0)">
                                                 <div class="notification d-flex flex-row align-items-center">
                                                     <div class="notify-icon bg-img align-self-center">
                                                         <div class="bg-type bg-type-md">
                                                             <span>DE</span>
                                                         </div>
                                                     </div>
                                                     <div class="notify-message">
                                                         <p class="font-weight-bold">Order confirmation</p>
                                                         <small>2 day</small>
                                                     </div>
                                                 </div>
                                             </a>
                                         </li>
                                     </ul>
                                 </li>
                                 <li class="dropdown-footer">
                                     <a class="font-13" href="javascript:void(0)"> View All Notifications
                                     </a>
                                 </li>
                             </ul>
                         </div>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link search" href="javascript:void(0)">
                             <i class="ti ti-search"></i>
                         </a>
                         <div class="search-wrapper">
                             <div class="close-btn">
                                 <i class="ti ti-close"></i>
                             </div>
                             <div class="search-content">
                                 <form>
                                     <div class="form-group">
                                         <i class="ti ti-search magnifier"></i>
                                         <input type="text" class="form-control autocomplete"
                                             placeholder="Search Here" id="autocomplete-ajax" autofocus="autofocus">
                                     </div>
                                 </form>
                             </div>
                         </div>
                     </li>
                     <li class="nav-item dropdown user-profile">
                         <a href="javascript:void(0)" class="nav-link dropdown-toggle " id="navbarDropdown4"
                             role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                             <img src="{{ asset('/') }}assets_ad/img/avtar/02.jpg" alt="avtar-img">
                             <span class="bg-success user-status"></span>
                         </a>
                         <div class="dropdown-menu animated fadeIn" aria-labelledby="navbarDropdown">
                             <div class="bg-gradient px-4 py-3">
                                 <div class="d-flex align-items-center justify-content-between">
                                     <div class="mr-1">
                                         <h4 class="text-white mb-0">Admin</h4>
                                         <small class="text-white">{{ Auth::user()->email }}</small>
                                     </div>
                                     <form action="{{ route('logout') }}" method="post">
                                         @csrf
                                         <button type="submit"
                                             class="btn btn-primary  text-white font-20 tooltip-wrapper"
                                             data-toggle="tooltip" data-placement="top" title=""
                                             data-original-title="Đăng xuất"> <i class="zmdi zmdi-power"></i>
                                         </button>
                                     </form>
                                 </div>
                             </div>
                             <div class="p-4">
                                 <a class="dropdown-item d-flex nav-link" href="javascript:void(0)">
                                     <i class="fa fa-user pr-2 text-success"></i> Profile</a>
                                 <a class="dropdown-item d-flex nav-link" href="javascript:void(0)">
                                     <i class="fa fa-envelope pr-2 text-primary"></i> Inbox
                                     <span class="badge badge-primary ml-auto">6</span>
                                 </a>
                                 <a class="dropdown-item d-flex nav-link" href="javascript:void(0)">
                                     <i class=" ti ti-settings pr-2 text-info"></i> Settings
                                 </a>
                                 <a class="dropdown-item d-flex nav-link" href="{{ url('/') }}">
                                     <i class=" zmdi zmdi-airplane pr-2 text-info"></i> Chuyển trang người dùng
                                 </a>
                                 {{-- <a class="dropdown-item d-flex nav-link" href="javascript:void(0)">
                                     <i class="fa fa-compass pr-2 text-warning"></i> Need help?
                                 </a> --}}
                                 <div class="row mt-2">
                                     <div class="col">
                                         <a class="bg-light p-3 text-center d-block" href="#">
                                             <i class="fe fe-mail font-20 text-primary"></i>
                                             <span class="d-block font-13 mt-2">My messages</span>
                                         </a>
                                     </div>
                                     <div class="col">
                                         <a class="bg-light p-3 text-center d-block" href="#">
                                             <i class="fe fe-plus font-20 text-primary"></i>
                                             <span class="d-block font-13 mt-2">Compose new</span>
                                         </a>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </li>
                 </ul>
             </div>
         </div>
         <!-- end navigation -->
     </nav>
     <!-- end navbar -->
 </header>
