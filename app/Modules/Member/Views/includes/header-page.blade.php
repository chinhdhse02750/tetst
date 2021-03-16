<header>
    <div class="header-block d-flex align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="header-left d-flex flex-column flex-md-row align-items-center">
                        <p class="d-flex align-items-center"><i class="fas fa-envelope"></i>info.deercreative@gmail.com
                        </p>
                        <p class="d-flex align-items-center"><i class="fas fa-phone"></i>+65 11.188.888</p>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div
                        class="header-right d-flex flex-column flex-md-row justify-content-md-end justify-content-center align-items-center">
                        <div class="social-link d-flex">
                            <a href=""><i class="fab fa-facebook-f"> </i></a>
                            <a href=""><i class="fab fa-twitter"></i></a>
                            <a href=""><i class="fab fa-invision"> </i></a>
                            <a href=""><i class="fab fa-pinterest-p"> </i></a>
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
    <nav class="navigation d-flex align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-2"><a class="logo" href="{{ route('home') }}"><img src="/images/logo.png" alt=""></a>
                </div>
                <div class="col-8">
                    <div class="navgition-menu d-flex align-items-center justify-content-center">
                        <ul class="mb-0">
                            <li class="toggleable"><a class="menu-item" href="{{ route('home') }}">Trang chủ</a></li>
                            <li class="toggleable"><a class="menu-item"
                                                      href="{{ route('shop.view', 'tat-ca-san-pham') }}">Shop</a></li>
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
                            <li class="toggleable"><a class="menu-item active" href="#">Pages</a>
                                <ul class="sub-menu">
                                    <li><a href="login.html">login</a></li>
                                    <li><a href="register.html">register</a></li>
                                    <li><a href="FAQ.html">FAQ</a></li>
                                    <li><a href="coming_soon.html">coming soon</a></li>
                                    <li><a href="contact_us.html">contact us</a></li>
                                    <li><a href="404_error.html">404 error</a></li>
                                </ul>
                            </li>
                            <li class="toggleable"><a class="menu-item" href="about_us.html">About us</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-2">
                    <div class="product-function d-flex align-items-center justify-content-end">
                        {{--<div id="wishlist"><a class="wishlist-icon" href="https://demoapus.com/ogami/wishlist/"> <i--}}
                        {{--class="icon_heart_alt"></i> <span class="count"> {{ $count }}</span> </a></div>--}}
                        <div class="apus-topcart">
                            <div id="cart">
                                <a class="dropdown-toggle mini-cart" data-toggle="dropdown" aria-expanded="false"
                                   href="#"
                                   title="View your shopping cart"> <i class="icon_bag_alt"></i> <span
                                        class="count cart_count"> {{ $count }} </span>
                                    <div class="total-minicart"><span
                                            class="woocommerce-Price-amount amount cart_money"><span
                                                class="woocommerce-Price-currencySymbol">¥</span>{{ number_format($total) }}</span>
                                    </div>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right">
                                    <div class="widget_shopping_cart_content">
                                        <div class="shopping_cart_content">
                                            <div class="cart_list ">
                                                <p class="buttons clearfix">
                                                    <a href="https://demoapus.com/ogami/shop/"
                                                       class="no-round-btn btn-continue-shopping wc-forward">Xem giỏ
                                                        hàng</a>
                                                </p>
                                                <br>
                                                <p class="buttons clearfix">
                                                    <a href="https://demoapus.com/ogami/shop/"
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
                                    <li class="toggleable"><a class="menu-item active" href="index.html">Home</a><span
                                            class="sub-menu--expander"><i class="icon_plus"></i></span>
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
                            href=""><img src="/images/logo.png" alt=""></a></div>
                </div>
                <div class="col-3">
                    <div class="mobile-product_function d-flex align-items-center justify-content-end"><a
                            class="function-icon icon_heart_alt" href="wishlist.html"></a><a
                            class="function-icon icon_bag_alt" href="shop_cart.html"></a></div>
                </div>
            </div>
        </div>
    </div>
    <div class="navigation-filter">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-4 col-lg-4 col-xl-3 order-2 order-md-1">
                    <div class="department-menu_block">
                        <div class="department-menu d-flex justify-content-between align-items-center">
                            <i class="fas fa-bars"></i>Danh mục sản phẩm<span><i class="arrow_carrot-down arrow_carrot-up"></i></span></div>
                        <div id="jquery-accordion-menu" class="jquery-accordion-menu" style="display: none">
                            <ul>
                                @foreach($categories as $menu)
                                    <li><a href="{{ url('/') }}/{{ $menu->alias }}">{{ $menu->name }}
                                            @if(count($menu->childrenCategories))
                                                <span class="submenu-indicator">+</span>
                                            @endif
                                        </a>
                                        @if(count($menu->childrenCategories))
                                            @include('includes.menu_sub',['childs' => $menu->childrenCategories])
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        {{--                        <div class="department-dropdown-menu">--}}
                        {{--                            <ul>--}}
                        {{--                                <li><a href="shop_grid+list_3col.html"> <i class="icon-1"></i>Fresh Meat</a></li>--}}
                        {{--                                <li><a href="shop_grid+list_3col.html"> <i class="icon-2"></i>Vegetables</a></li>--}}
                        {{--                                <li><a href="shop_grid+list_3col.html"> <i class="icon-3"></i>Fruit & Nut Gifts</a></li>--}}
                        {{--                                <li><a href="shop_grid+list_3col.html"> <i class="icon-4"></i>Fresh Berries</a></li>--}}
                        {{--                                <li><a href="shop_grid+list_3col.html"> <i class="icon-5"></i>Ocean Foods</a></li>--}}
                        {{--                                <li><a href="shop_grid+list_3col.html"><i class="icon-6"></i>Butter & Eggs</a></li>--}}
                        {{--                                <li><a href="shop_grid+list_3col.html"><i class="icon-7"></i>Fastfood</a></li>--}}
                        {{--                                <li><a href="shop_grid+list_3col.html"> <i class="icon-8"></i>Fresh Onion</a></li>--}}
                        {{--                                <li><a href="shop_grid+list_3col.html"> <i class="icon-9"></i>Papayaya & Crisps</a></li>--}}
                        {{--                                <li><a href="shop_grid+list_3col.html"><i class="icon-10"></i>Oatmeal</a></li>--}}
                        {{--                                <li><a href="shop_grid+list_3col.html"> <i class="icon-11"></i>Fresh Bananas</a></li>--}}
                        {{--                            </ul>--}}
                        {{--                        </div>--}}
                    </div>
                </div>
                <div class="col-12 col-md-8 col-lg-8 col-xl-9 order-1 order-md-2">
                    <div class="website-search">
                        <div class="row no-gutters">
                            <div class="col-0 col-md-0 col-lg-4 col-xl-3">
                                <div class="filter-search">
                                    <div class="categories-select d-flex align-items-center justify-content-around">
                                        <span>All Categories</span><i class="arrow_carrot-down"></i></div>
                                    <div class="categories-select_box">
                                        <ul>
                                            <li>Fruit & Nut Gifts</li>
                                            <li>Fresh Berries</li>
                                            <li>Ocean Foods</li>
                                            <li>Butter & Eggs</li>
                                            <li>Ocean Foods</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-8 col-md-8 col-lg-5 col-xl-7">
                                <div class="search-input">
                                    <input class="no-round-input no-border" type="text" placeholder="What do you need">
                                </div>
                            </div>
                            <div class="col-4 col-md-4 col-lg-3 col-xl-2">
                                <button class="no-round-btn">Search</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
