<header>
    <div class="header-block d-flex align-items-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-md-6">
                    <div class="header-left d-flex flex-column flex-md-row align-items-center">
                        <p class="d-flex align-items-center"><i class="fas fa-envelope"></i>hanoitaphoa.jp@gmail.com
                        </p>
                        <p class="d-flex align-items-center"><i class="fas fa-phone"></i>080-5316-7125</p>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div
                            class="header-right d-flex flex-column flex-md-row justify-content-md-end justify-content-center align-items-center">
                        <div class="social-link d-flex">
                            <a href=""><i class="fab fa-facebook-f color-fb"> </i></a>
                            <a href=""><i class="fab fa-twitter color-tw"></i></a>
                        </div>
                        <div class="header__user">
                            <div class="header__user-menu">
                                @if(empty(Auth::user()))
                                    <div class="login d-flex"><a href="{{ route('login') }}"><i class="fas fa-user"></i>Đăng
                                            nhập</a></div>
                                @else
                                    <div class="login d-flex">
                                        <a href="#" class=" header__dropdown--user dropdown-toggle" role="button"
                                           id="headerUserDropdown" data-toggle="dropdown"
                                           aria-haspopup="true"
                                           aria-expanded="false">{{ Auth::user()->name }}</a>
                                        <div class="header__dropdown--menu dropdown-menu dropdown-menu-right"
                                             aria-labelledby="headerUserDropdown">
                                            @include('includes.shop-menu')
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--<nav class="navigation d-flex align-items-center m-t-25">--}}
        {{--<div class="container">--}}
            {{--<div class="row">--}}
                {{--<div class="col-12">--}}
                    {{--<div class="navgition-menu d-flex align-items-center justify-content-center">--}}
                        {{--<ul class="mb-0">--}}
                            {{--<li class="toggleable"><a class="menu-item" href="{{ route('home') }}">Trang chủ</a></li>--}}
                            {{--<li class="toggleable"><a class="menu-item"--}}
                                                      {{--href="{{ route('cate.view', 'tat-ca-san-pham') }}">Cửa hàng</a>--}}
                            {{--</li>--}}
                            {{--<li class="toggleable"><a class="menu-item"--}}
                                                      {{--href="{{ route('cate.view', 'san-pham-giam-gia') }}">Sản phẩm giảm--}}
                                    {{--giá</a>--}}
                            {{--</li>--}}

                            {{--                            <li class="toggleable"><a class="menu-item" href="blog_list_sidebar.html">Blog</a>--}}
                            {{--                                <ul class="sub-menu">--}}
                            {{--                                    <li><a href="blog_list_sidebar.html">Blog List Sidebar</a></li>--}}
                            {{--                                    <li><a href="blog_grid_2col.html">Blog Grid 2 column</a></li>--}}
                            {{--                                    <li><a href="blog_grid_sidebar.html">Blog Grid sidebar</a></li>--}}
                            {{--                                    <li><a href="blog_masonry.html">Blog masonry</a></li>--}}
                            {{--                                    <li><a href="blog_grid_1col.html">Blog Grid 1 column sidebar</a></li>--}}
                            {{--                                    <li><a href="blog_detail_sidebar.html">Blog detail sidebar</a></li>--}}
                            {{--                                </ul>--}}
                            {{--                            </li>--}}
                            {{--<li class="toggleable"><a class="menu-item" href="about_us.html">Về Hà Nội Tạp Hóa</a></li>--}}
                        {{--</ul>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</nav>--}}
    <div id="mobile-menu">
        <div class="container">
            <div class="row">
                <div class="col-3">
                    <div class="mobile-menu_block d-flex align-items-center"><a class="mobile-menu--control" href="#"><i
                                    class="fas fa-bars"></i></a>
                        <div id="ogami-mobile-menu">
                            <button class="no-round-btn" id="mobile-menu--closebtn">Đóng menu</button>
                            <div class="department-menu_block">
                                <ul class="ul-parent">
                                    @foreach($allCategories as $menu)
                                        <li class="menu-toggle menu-parent">
                                            <a  href="{{ route('cate.view', $menu->alias) }}" class="department-link link-parent">
                                                <img src="{{ url('storage/tmp/thumbnail_'.$menu->image) }}"
                                                     alt="{{ $menu->image }}" style="width:3em;">
                                                <span>{{ $menu->name }}</span></a>
                                        </li>
                                    @endforeach
                                        @if(empty(Auth::user()))
                                            <li class="menu-toggle menu-parent">
                                                <a  href="{{ route('login') }}" class="department-link link-parent">
                                                    <i class="fas fa-user" style="font-size: 25px; padding: 7px;"></i>
                                                    <span>Đăng nhập</span></a>
                                            </li>
                                        @else
                                            <div class="login d-flex">
                                                <a href="#" class=" header__dropdown--user dropdown-toggle" role="button"
                                                   id="headerUserDropdown" data-toggle="dropdown"
                                                   aria-haspopup="true"
                                                   aria-expanded="false">{{ Auth::user()->name }}</a>
                                                <div class="header__dropdown--menu dropdown-menu dropdown-menu-right"
                                                     aria-labelledby="headerUserDropdown">
                                                    @include('includes.shop-menu')
                                                </div>
                                            </div>
                                        @endif
                                </ul>
                            </div>
                        </div>
                        <div class="ogamin-mobile-menu_bg"></div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="mobile-menu_logo text-center d-flex justify-content-center align-items-center"><a
                                href="{{ route('home') }}"><img src="{{ asset('images/logo.png') }}" alt=""></a></div>
                </div>
                <div class="col-3">
                    <div class="mobile-product_function d-flex align-items-center justify-content-end apus-topcart">
                        <a class="dropdown-toggle mini-cart" data-toggle="dropdown" aria-expanded="false" href="#"
                           title="View your shopping cart">
                            <i class="icon_bag_alt"></i>
                            <span class="count cart_count">{{ $count }}</span>
                            <div class="total-minicart">
                                <span class="woocommerce-Price-amount amount cart_money">
                                    <span class="woocommerce-Price-currencySymbol">¥</span>
                                    {{ number_format($total) }}
                                </span>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="widget_shopping_cart_content">
                                <div class="shopping_cart_content">
                                    <div class="cart_list ">
                                        <p class="buttons clearfix">
                                            <a href="{{ route('cart.index') }}"
                                               class="no-round-btn btn-continue-shopping wc-forward">Xem giỏ
                                                hàng</a>
                                        </p>
                                        <br>
                                        <p class="buttons clearfix">
                                            <a href="{{ route('cate.view', 'tat-ca-san-pham') }}"
                                               class="no-round-btn btn-continue-shopping wc-forward">Tiếp tục
                                                mua sắm</a>
                                        </p>
                                    </div><!-- end product list -->
                                    <div class="cart-bottom">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="navigation-filter">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-2 d-none d-lg-block">
                    <a class="logo" href="{{ route('home') }}">
                        <img src="/images/logo.png" alt="">
                    </a>
                </div>
                <div class="col-9 d-none d-lg-block"></div>
                <div class="col-1 d-none d-lg-block">
                    <div class="product-function d-flex align-items-center justify-content-end">
                        <div class="apus-topcart">
                            <div id="cart">
                                <a class="dropdown-toggle mini-cart" data-toggle="dropdown" aria-expanded="false"
                                   href="#"
                                   title="View your shopping cart"> <i class="icon_bag_alt"></i>
                                    <span class="count cart_count"> {{ $count }} </span>
                                    <div class="total-minicart">
                                        <span class="woocommerce-Price-amount amount cart_money">
                                            <span class="woocommerce-Price-currencySymbol">¥</span>
                                            {{ number_format($total) }}
                                        </span>
                                    </div>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right">
                                    <div class="widget_shopping_cart_content">
                                        <div class="shopping_cart_content">
                                            <div class="cart_list ">
                                                <p class="buttons clearfix">
                                                    <a href="{{ route('cart.index') }}"
                                                       class="no-round-btn btn-continue-shopping wc-forward">Xem giỏ
                                                        hàng</a>
                                                </p>
                                                <br>
                                                <p class="buttons clearfix">
                                                    <a href="{{ route('cate.view', 'tat-ca-san-pham') }}"
                                                       class="no-round-btn btn-continue-shopping wc-forward">Tiếp tục
                                                        mua sắm</a>
                                                </p>
                                            </div><!-- end product list -->
                                            <div class="cart-bottom">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="navigation-filter">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-4 col-lg-4 col-xl-3 order-2 order-md-1 menu-desktop category-desktop">
                    <div class="department-menu_block">
                        <div class="department-menu d-flex justify-content-between align-items-center">
                            <i class="fas fa-bars"></i>Danh mục sản phẩm<span><i class="arrow_carrot-down"></i></span></div>
                        <div class="department-dropdown-menu">
                            <ul class="ul-parent">
                                @foreach($allCategories as $menu)
                                    <li class="menu-toggle menu-parent">
                                        <a  href="{{ route('cate.view', $menu->alias) }}" class="department-link link-parent">
                                            <img src="{{ url('storage/tmp/thumbnail_'.$menu->image) }}"
                                                 alt="{{ $menu->image }}" style="width:3em;">
                                            <span>{{ $menu->name }}</span></a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-8 col-lg-8 col-xl-9 order-1 order-md-2">
                    <input type="hidden" value="{{ route('search') }}" id="search_url">
                    <div class="row no-gutters">
                        <div class="col-10 col-md-10 col-lg-10 col-xl-10">
                            <div class="search-input">
                                <input class="no-round-input" id="search_input" type="text" value="{{ $search }}"
                                       placeholder="Bạn muốn tìm gì?">
                            </div>
                        </div>
                        <div class="col-2 col-md-2 col-lg-2 col-xl-2">
                            <button class="no-round-btn" id="btn_search_all"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                    {{--<div class="clearfix search-mobile">--}}
                    {{--<div class="apus-search-form search-fix clearfix">--}}
                    {{--<div class="inner-search">--}}
                    {{--<form action="https://demoapus.com/ogami/" method="get">--}}
                    {{--<div class="main-search">--}}
                    {{--<div class="autocompleate-wrapper"><input type="text"--}}
                    {{--placeholder="Search products here..."--}}
                    {{--name="s"--}}
                    {{--class="apus-search form-control apus-autocompleate-input"--}}
                    {{--autocomplete="off"></div>--}}
                    {{--</div>--}}
                    {{--<input type="hidden" name="post_type" value="product" class="post_type">--}}
                    {{--<button type="submit" class="btn btn-theme radius-0"><i class="fa fa-search"></i>--}}
                    {{--</button>--}}
                    {{--</form>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                </div>
            </div>
        </div>
    </div>
</header>
