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
                            <a href=""><i class="fab fa-invision color-in"> </i></a>
                            <a href=""><i class="fab fa-pinterest-p color-prin"> </i></a>
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
    <nav class="navigation d-flex align-items-center m-t-25">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="navgition-menu d-flex align-items-center justify-content-center">
                        <ul class="mb-0">
                            <li class="toggleable"><a class="menu-item" href="{{ route('home') }}">Trang chủ</a></li>
                            <li class="toggleable"><a class="menu-item"
                                                      href="{{ route('cate.view', 'tat-ca-san-pham') }}">Cửa hàng</a>
                            </li>
                            <li class="toggleable"><a class="menu-item" href="blog_list_sidebar.html">Blog</a>
                                <ul class="sub-menu">
                                    <li><a href="blog_list_sidebar.html">Blog List Sidebar</a></li>
                                    <li><a href="blog_grid_2col.html">Blog Grid 2 column</a></li>
                                    <li><a href="blog_grid_sidebar.html">Blog Grid sidebar</a></li>
                                    <li><a href="blog_masonry.html">Blog masonry</a></li>
                                    <li><a href="blog_grid_1col.html">Blog Grid 1 column sidebar</a></li>
                                    <li><a href="blog_detail_sidebar.html">Blog detail sidebar</a></li>
                                </ul>
                            </li>
                            <li class="toggleable"><a class="menu-item" href="about_us.html">Về Hà Nội Shop</a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </nav>
    <div id="mobile-menu">
        <div class="container">
            <div class="row">
                <div class="col-3">
                    <div class="mobile-menu_block d-flex align-items-center"><a class="mobile-menu--control" href="#"><i
                                    class="fas fa-bars"></i></a>
                        <div id="ogami-mobile-menu">
                            <button class="no-round-btn" id="mobile-menu--closebtn">Close menu</button>
                            <div class="mobile-menu_items">
                                <ul class="mb-0 d-flex flex-column">
                                    <li class="toggleable"><a class="menu-item active" href="/">Home</a>
                                        <span class="sub-menu--expander"><i class="icon_plus"></i></span>
                                        <ul class="sub-menu">
                                            <li><a href="index.html">Homepage 1</a></li>
                                            <li><a href="homepage02.html">Homepage 2</a></li>
                                            <li><a href="homepage03.html">Homepage 3</a></li>
                                            <li><a href="homepage04.html">Homepage 4</a></li>
                                            <li><a href="homepage05.html">Homepage 5</a></li>
                                        </ul>
                                    </li>
                                    <li class="toggleable"><a class="menu-item" href="shop_grid+list_3col.html">Shop</a><span
                                                class="sub-menu--expander"><i class="icon_plus"></i></span>
                                        <ul class="sub-menu">
                                            @foreach($categories as $menu)
                                                <li><a href="shop_grid+list_fullwidth.html">Shop grid fullwidth</a></li>
                                                {{--                                                @include('product.childItems', ['char' => $char."|---", 'menu' => $menu] )--}}
                                            @endforeach
                                        </ul>
                                    </li>
                                    <li class="toggleable"><a class="menu-item"
                                                              href="blog_list_sidebar.html">Blog</a><span
                                                class="sub-menu--expander"><i class="icon_plus"></i></span>
                                        <ul class="sub-menu">
                                            <li><a href="blog_list_sidebar.html">Blog List Sidebar</a></li>
                                            <li><a href="blog_grid_2col.html">Blog Grid 2 column</a></li>
                                            <li><a href="blog_grid_sidebar.html">Blog Grid sidebar</a></li>
                                            <li><a href="blog_masonry.html">Blog masonry</a></li>
                                            <li><a href="blog_grid_1col.html">Blog Grid 1 column sidebar</a></li>
                                            <li><a href="blog_detail_sidebar.html">Blog detail sidebar</a></li>
                                        </ul>
                                    </li>
                                    </li>
                                    <li class="toggleable"><a class="menu-item" href="#">Pages</a><span
                                                class="sub-menu--expander"><i class="icon_plus"></i></span>
                                        <ul class="sub-menu">
                                            <li><a href="login.html">login</a></li>
                                            <li><a href="register.html">register</a></li>
                                            <li><a href="faq.html">FAQ</a></li>
                                            <li><a href="coming_soon.html">coming soon</a></li>
                                            <li><a href="about_us.html">about us</a></li>
                                            <li><a href="contact_us.html">contact us</a></li>
                                            <li><a href="404_error.html">404 error</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <div class="mobile-login">
                                <h2>My account</h2><a href="login.html">Login</a><a href="register.html">Register</a>
                            </div>
                            <div class="mobile-social"><a href=""><i class="fab fa-facebook-f"> </i></a><a href=""><i
                                            class="fab fa-twitter"></i></a><a href=""><i
                                            class="fab fa-invision"> </i></a><a href=""><i
                                            class="fab fa-pinterest-p"> </i></a></div>
                        </div>
                        <div class="ogamin-mobile-menu_bg"></div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="mobile-menu_logo text-center d-flex justify-content-center align-items-center"><a
                                href=""><img src="{{ asset('images/logo.png') }}" alt=""></a></div>
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
                <div class="col-12 col-md-12 col-lg-9">
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
    </div>
</header>
