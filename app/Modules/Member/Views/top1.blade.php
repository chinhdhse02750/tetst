@extends('layouts.shop')

@section('content')

    <div id="main">
        <div class="banner_v2">
            <div class="container">
                <div class="row">
                    <div class="col-xl-3"></div>
                    <div class="col-12 col-xl-9">
                        <div class="banner-block">
                            <div class="row no-gutters justify-content-center align-items-md-center">
                                <div class="col-10 col-md-5 col-xl-6">
                                    <div class="banner-text text-center text-md-left">
                                        <h5 class="color-subtitle pink">Butter & Eggs</h5>
                                        <h2 class="title">Spice 100% Organnic</h2>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do </p><a
                                            class="normal-btn pink" href="shop_grid+list_3col.html">Shop now</a>
                                    </div>
                                </div>
                                <div class="col-12 col-md-5 col-xl-5">
                                    <div class="banner-img">
                                        <div class="img-block text-center"><img class="mymove"
                                                                                src="/images/homepage03/banner_img.png"
                                                                                alt=""></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End banner v2-->
        <div class="home3-product-block">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-xl-3">
                        <div class="deal-of-week_slide">
                            <div class="week-deal_top mini-tab-title underline pink">
                                <h2 class="title">Sản phẩm của tuần</h2>
                                <div class="week-deal_control"></div>
                            </div>
                            <div class="week-deal_bottom">
                                @foreach($dealOfWeekProduct as $key => $value)
                                    @if($key < 5)
                                        <div class="deal-block">
                                            <div class="deal-block_detail">
                                                <h5 class="deal-discount">- {{ $value->percent_sale }}%</h5>
                                                <div class="deal-img">
                                                    <a href="shop_detail.html">
                                                        <img src="{{ url('storage/tmp/'.$value->first_image) }}"
                                                             alt="{{ $value->first_image }}">
                                                    </a>
                                                </div>
                                                <div class="deal-countdown">
                                                    <div class="event-countdown deal_of_week_count"></div>
                                                </div>
                                                <div class="deal-info text-center">
                                                    <h5 class="color-type pink deal-type">Oranges</h5><a
                                                        class="deal-name"
                                                        href="shop_detail.html">Pure
                                                        Pinapple</a>
                                                    <h3 class="deal-price">$14.00
                                                        <del>$35.00</del>
                                                    </h3>
                                                </div>
                                                <div class="deal-select text-center">
                                                    <button class="add-to-wishlist round-icon-btn pink"><i
                                                            class="icon_heart_alt"></i></button>
                                                    <button class="add-to-cart round-icon-btn pink pink"><i
                                                            class="icon_bag_alt"></i></button>
                                                    <button class="add-to-compare round-icon-btn pink"><i
                                                            class="fas fa-random"></i></button>
                                                    <button class="quickview round-icon-btn pink"><i
                                                            class="far fa-eye"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="sidebar-benefit">
                            <div class="benefit-block">
                                <div class="our-benefits column shadowless benefit-border">
                                    <div class="row">
                                        <div class="col-12 col-md-6 col-xl-12">
                                            <div class="benefit-detail d-flex flex-row align-items-center"><img
                                                    class="benefit-img" src="/images/homepage02/benefit-icon1.png"
                                                    alt="">
                                                <div class="benefit-detail_info">
                                                    <h5 class="benefit-title">Free Shipping</h5>
                                                    <p class="benefit-describle">For all order over 99$</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-12">
                                            <div class="benefit-detail d-flex flex-row align-items-center"><img
                                                    class="benefit-img" src="/images/homepage02/benefit-icon2.png"
                                                    alt="">
                                                <div class="benefit-detail_info">
                                                    <h5 class="benefit-title">Delivery On Time</h5>
                                                    <p class="benefit-describle">If good have prolems</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-12">
                                            <div class="benefit-detail d-flex flex-row align-items-center"><img
                                                    class="benefit-img" src="/images/homepage02/benefit-icon3.png"
                                                    alt="">
                                                <div class="benefit-detail_info">
                                                    <h5 class="benefit-title">Secure Payment</h5>
                                                    <p class="benefit-describle">100% secure payment</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-12">
                                            <div class="benefit-detail boderless d-flex flex-row align-items-center">
                                                <img class="benefit-img" src="/images/homepage02/benefit-icon4.png"
                                                     alt="">
                                                <div class="benefit-detail_info">
                                                    <h5 class="benefit-title">24/7 Support</h5>
                                                    <p class="benefit-describle">Dedicated support </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="sale-product">
                            <div class="sale-product_top mini-tab-title underline pink">
                                <h2 class="title"><a class="title" href="#">Sản phẩm khuyến mãi</a></h2>
                            </div>
                            <div class="sale-product_bottom">
                                <div class="row">
                                    @foreach($saleProduct as $key => $value)
                                        @if($key < 5)
                                            <div class="col-12">
                                                <div class="mini-product column">
                                                    <div class="mini-product_img" style="width: 100px; height: 100px">
                                                        <a class="product-img"
                                                           href="shop_detail.html"><img
                                                                src="{{ url('storage/tmp/'.$value->first_image) }}"
                                                                alt="{{ $value->first_image }}">
                                                        </a>
                                                    </div>
                                                    <div class="mini-product_info"><a
                                                            href="shop_detail.html">{{ $value->name }}</a>
                                                        <p>¥{{ $value->discount_price }}
                                                            <del>¥{{ $value->price }}</del>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="customer-satisfied text-center">
                            <div class="customer-satisfied_border">
                                <div class="customer-satisfied_wrapper">
                                    <div class="customer-satisfied_block">
                                        <div class="customer-img mx-auto"><img
                                                src="/images/homepage03/customer_img_1.png" alt="customer"></div>
                                        <div class="customer-info">
                                            <h5 class="customer-name">Steven Ady</h5>
                                            <p class="customer-comment">Lorem ipsum dolor sit amet consectetur
                                                adipisicing elit, sed do accusantium </p>
                                            <div class="customer-rate"><i class="icon_star"></i><i
                                                    class="icon_star"></i><i class="icon_star"></i><i
                                                    class="icon_star"></i><i class="icon_star-half"></i></div>
                                        </div>
                                    </div>
                                    <div class="customer-satisfied_block">
                                        <div class="customer-img mx-auto"><img
                                                src="/images/homepage03/customer_img_1.png" alt="customer"></div>
                                        <div class="customer-info">
                                            <h5 class="customer-name">Steven Ady</h5>
                                            <p class="customer-comment">Lorem ipsum dolor sit amet consectetur
                                                adipisicing elit, sed do accusantium </p>
                                            <div class="customer-rate"><i class="icon_star"></i><i
                                                    class="icon_star"></i><i class="icon_star"></i><i
                                                    class="icon_star"></i><i class="icon_star-half"></i></div>
                                        </div>
                                    </div>
                                    <div class="customer-satisfied_block">
                                        <div class="customer-img mx-auto"><img
                                                src="/images/homepage03/customer_img_1.png" alt="customer"></div>
                                        <div class="customer-info">
                                            <h5 class="customer-name">Steven Ady</h5>
                                            <p class="customer-comment">Lorem ipsum dolor sit amet consectetur
                                                adipisicing elit, sed do accusantium </p>
                                            <div class="customer-rate"><i class="icon_star"></i><i
                                                    class="icon_star"></i><i class="icon_star"></i><i
                                                    class="icon_star"></i><i class="icon_star-half"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="customer-satisfied_control"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-xl-9">
                        <div id="tab">
                            <div class="best-seller_top mini-tab-title underline pink">
                                <div class="row align-items-md-center">
                                    <div class="col-12 col-md-4">
                                        <h2 class="title"><a href="#" class="title">Sản phẩm nổi bật</a>
                                        </h2>
                                    </div>
                                </div>
                            </div>
                            <div class="best-seller_bottom">
                                <div id="tab1">
                                    <div class="row no-gutters-sm">
                                        @foreach($featuredProduct as $key => $value)
                                            @if($key < 6)
                                                <div class="col-6 col-md-4">
                                                    <div class="product pink"><a class="product-img"
                                                                                 href="shop_detail.html"><img
                                                                src="{{ url('storage/tmp/'.$value->first_image) }}"
                                                                alt="{{ $value->first_image }}"></a>
                                                        <h3 class="product-name">{{ $value->name }}</h3>
                                                        @if($value->discount_price !== null)
                                                            <h3 class="product-price">¥{{ $value->discount_price }}
                                                                <del>¥{{ $value->price }}</del>
                                                            </h3>
                                                        @else
                                                            <h3 class="product-price"> ¥{{ $value->price }}
                                                            </h3>
                                                        @endif
                                                        <div class="product-select" data-id="{{ $value->id }}"
                                                        data-name="{{ $value->name }}" data-price="{{ $value->price }}"
                                                        data-discount_price="{{ $value->discount_price }}">
                                                            <button class="add-to-wishlist round-icon-btn pink"><i
                                                                    class="icon_heart_alt"></i></button>
                                                            <button class="add-to-cart round-icon-btn pink"><i
                                                                    class="icon_bag_alt"></i></button>
                                                            <button class="add-to-compare round-icon-btn pink"><i
                                                                    class="fas fa-random"></i></button>
                                                            <button class="quickview round-icon-btn pink"><i
                                                                    class="far fa-eye"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="quick-banner">
                            <div class="row justify-content-center align-items-center flex-column flex-md-row">
                                <div class="col-12 col-md-5">
                                    <div class="bannner-img text-center"><img class="img-fluid"
                                                                              src="/images/homepage03/quick_banner_1_img.png"
                                                                              alt=""></div>
                                </div>
                                <div class="col-10 col-md-5">
                                    <div class="banner-text text-center text-md-left">
                                        <div
                                            class="discount-block d-flex align-items-center justify-content-center justify-content-md-start text-left">
                                            <h2 class="big-number">50</h2>
                                            <h3>%OFF<br>Black <span>Friday</span></h3>
                                        </div>
                                        <p>Lorem ipsum dolor sit amet, consectetur oce omnis iste natus error sit </p><a
                                            class="normal-btn pink" href="shop_grid+list_3col.html">Shop now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="tab-so1">
                            <div class="best-seller_top mini-tab-title underline pink">
                                <div class="row align-items-md-center">
                                    <div class="col-12 col-md-4">
                                        <h2 class="title">Best Seller</h2>
                                    </div>
                                    <div class="col-12 col-md-8 text-lg-right">
                                        <ul class="tab-control text-md-right">
                                            <li><a class="active" href="#tab1">All</a></li>
                                            <li><a href="#tab2">Oranges</a></li>
                                            <li><a href="#tab3">Fresh Meat</a></li>
                                            <li><a href="#tab4">Vegetables</a></li>
                                            <li><a href="#tab5">Fastfood</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="best-seller_bottom">
                                <div id="tab1">
                                    <div class="row no-gutters-sm">
                                        <div class="col-6 col-md-4">
                                            <div class="product pink"><a class="product-img"
                                                                         href="shop_detail.html"><img
                                                        src="/images/product/product01.png" alt="product image"></a>
                                                <h5 class="product-type">Oranges</h5>
                                                <h3 class="product-name">Pure Pineapple</h3>
                                                <h3 class="product-price">$14.00
                                                    <del>$35.00</del>
                                                </h3>
                                                <div class="product-select">
                                                    <button class="add-to-wishlist round-icon-btn pink"><i
                                                            class="icon_heart_alt"></i></button>
                                                    <button class="add-to-cart round-icon-btn pink"><i
                                                            class="icon_bag_alt"></i></button>
                                                    <button class="add-to-compare round-icon-btn pink"><i
                                                            class="fas fa-random"></i></button>
                                                    <button class="quickview round-icon-btn pink"><i
                                                            class="far fa-eye"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-4">
                                            <div class="product pink"><a class="product-img"
                                                                         href="shop_detail.html"><img
                                                        src="/images/product/product02.png" alt="product image"></a>
                                                <h5 class="product-type">Oranges</h5>
                                                <h3 class="product-name">Pure Pineapple</h3>
                                                <h3 class="product-price">$14.00
                                                    <del>$35.00</del>
                                                </h3>
                                                <div class="product-select">
                                                    <button class="add-to-wishlist round-icon-btn pink"><i
                                                            class="icon_heart_alt"></i></button>
                                                    <button class="add-to-cart round-icon-btn pink"><i
                                                            class="icon_bag_alt"></i></button>
                                                    <button class="add-to-compare round-icon-btn pink"><i
                                                            class="fas fa-random"></i></button>
                                                    <button class="quickview round-icon-btn pink"><i
                                                            class="far fa-eye"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-4">
                                            <div class="product pink"><a class="product-img"
                                                                         href="shop_detail.html"><img
                                                        src="/images/product/product03.png" alt="product image"></a>
                                                <h5 class="product-type">Oranges</h5>
                                                <h3 class="product-name">Apple</h3>
                                                <h3 class="product-price">$30.00
                                                    <del>$45.00</del>
                                                </h3>
                                                <div class="product-select">
                                                    <button class="add-to-wishlist round-icon-btn pink"><i
                                                            class="icon_heart_alt"></i></button>
                                                    <button class="add-to-cart round-icon-btn pink"><i
                                                            class="icon_bag_alt"></i></button>
                                                    <button class="add-to-compare round-icon-btn pink"><i
                                                            class="fas fa-random"></i></button>
                                                    <button class="quickview round-icon-btn pink"><i
                                                            class="far fa-eye"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="tab2">
                                    <div class="row no-gutters-sm">
                                        <div class="col-6 col-md-4">
                                            <div class="product pink"><a class="product-img"
                                                                         href="shop_detail.html"><img
                                                        src="/images/product/product04.png" alt="product image"></a>
                                                <h5 class="product-type">Oranges</h5>
                                                <h3 class="product-name">Pure Pineapple</h3>
                                                <h3 class="product-price">$14.00
                                                    <del>$35.00</del>
                                                </h3>
                                                <div class="product-select">
                                                    <button class="add-to-wishlist round-icon-btn pink"><i
                                                            class="icon_heart_alt"></i></button>
                                                    <button class="add-to-cart round-icon-btn pink"><i
                                                            class="icon_bag_alt"></i></button>
                                                    <button class="add-to-compare round-icon-btn pink"><i
                                                            class="fas fa-random"></i></button>
                                                    <button class="quickview round-icon-btn pink"><i
                                                            class="far fa-eye"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-4">
                                            <div class="product pink"><a class="product-img"
                                                                         href="shop_detail.html"><img
                                                        src="/images/product/product05.png" alt="product image"></a>
                                                <h5 class="product-type">Oranges</h5>
                                                <h3 class="product-name">Pure Pineapple</h3>
                                                <h3 class="product-price">$14.00
                                                    <del>$35.00</del>
                                                </h3>
                                                <div class="product-select">
                                                    <button class="add-to-wishlist round-icon-btn pink"><i
                                                            class="icon_heart_alt"></i></button>
                                                    <button class="add-to-cart round-icon-btn pink"><i
                                                            class="icon_bag_alt"></i></button>
                                                    <button class="add-to-compare round-icon-btn pink"><i
                                                            class="fas fa-random"></i></button>
                                                    <button class="quickview round-icon-btn pink"><i
                                                            class="far fa-eye"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-4">
                                            <div class="product pink"><a class="product-img"
                                                                         href="shop_detail.html"><img
                                                        src="/images/product/product02.png" alt="product image"></a>
                                                <h5 class="product-type">Oranges</h5>
                                                <h3 class="product-name">Apple</h3>
                                                <h3 class="product-price">$30.00
                                                    <del>$45.00</del>
                                                </h3>
                                                <div class="product-select">
                                                    <button class="add-to-wishlist round-icon-btn pink"><i
                                                            class="icon_heart_alt"></i></button>
                                                    <button class="add-to-cart round-icon-btn pink"><i
                                                            class="icon_bag_alt"></i></button>
                                                    <button class="add-to-compare round-icon-btn pink"><i
                                                            class="fas fa-random"></i></button>
                                                    <button class="quickview round-icon-btn pink"><i
                                                            class="far fa-eye"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="tab3">
                                    <div class="row no-gutters-sm">
                                        <div class="col-6 col-md-4">
                                            <div class="product pink"><a class="product-img"
                                                                         href="shop_detail.html"><img
                                                        src="/images/product/product03.png" alt="product image"></a>
                                                <h5 class="product-type">Oranges</h5>
                                                <h3 class="product-name">Pure Pineapple</h3>
                                                <h3 class="product-price">$14.00
                                                    <del>$35.00</del>
                                                </h3>
                                                <div class="product-select">
                                                    <button class="add-to-wishlist round-icon-btn pink"><i
                                                            class="icon_heart_alt"></i></button>
                                                    <button class="add-to-cart round-icon-btn pink"><i
                                                            class="icon_bag_alt"></i></button>
                                                    <button class="add-to-compare round-icon-btn pink"><i
                                                            class="fas fa-random"></i></button>
                                                    <button class="quickview round-icon-btn pink"><i
                                                            class="far fa-eye"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-4">
                                            <div class="product pink"><a class="product-img"
                                                                         href="shop_detail.html"><img
                                                        src="/images/product/product02.png" alt="product image"></a>
                                                <h5 class="product-type">Oranges</h5>
                                                <h3 class="product-name">Pure Pineapple</h3>
                                                <h3 class="product-price">$14.00
                                                    <del>$35.00</del>
                                                </h3>
                                                <div class="product-select">
                                                    <button class="add-to-wishlist round-icon-btn pink"><i
                                                            class="icon_heart_alt"></i></button>
                                                    <button class="add-to-cart round-icon-btn pink"><i
                                                            class="icon_bag_alt"></i></button>
                                                    <button class="add-to-compare round-icon-btn pink"><i
                                                            class="fas fa-random"></i></button>
                                                    <button class="quickview round-icon-btn pink"><i
                                                            class="far fa-eye"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-4">
                                            <div class="product pink"><a class="product-img"
                                                                         href="shop_detail.html"><img
                                                        src="/images/product/product05.png" alt="product image"></a>
                                                <h5 class="product-type">Oranges</h5>
                                                <h3 class="product-name">Apple</h3>
                                                <h3 class="product-price">$30.00
                                                    <del>$45.00</del>
                                                </h3>
                                                <div class="product-select">
                                                    <button class="add-to-wishlist round-icon-btn pink"><i
                                                            class="icon_heart_alt"></i></button>
                                                    <button class="add-to-cart round-icon-btn pink"><i
                                                            class="icon_bag_alt"></i></button>
                                                    <button class="add-to-compare round-icon-btn pink"><i
                                                            class="fas fa-random"></i></button>
                                                    <button class="quickview round-icon-btn pink"><i
                                                            class="far fa-eye"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="tab4">
                                    <div class="row no-gutters-sm">
                                        <div class="col-6 col-md-4">
                                            <div class="product pink"><a class="product-img"
                                                                         href="shop_detail.html"><img
                                                        src="/images/product/product01.png" alt="product image"></a>
                                                <h5 class="product-type">Oranges</h5>
                                                <h3 class="product-name">Pure Pineapple</h3>
                                                <h3 class="product-price">$14.00
                                                    <del>$35.00</del>
                                                </h3>
                                                <div class="product-select">
                                                    <button class="add-to-wishlist round-icon-btn pink"><i
                                                            class="icon_heart_alt"></i></button>
                                                    <button class="add-to-cart round-icon-btn pink"><i
                                                            class="icon_bag_alt"></i></button>
                                                    <button class="add-to-compare round-icon-btn pink"><i
                                                            class="fas fa-random"></i></button>
                                                    <button class="quickview round-icon-btn pink"><i
                                                            class="far fa-eye"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-4">
                                            <div class="product pink"><a class="product-img"
                                                                         href="shop_detail.html"><img
                                                        src="/images/product/product02.png" alt="product image"></a>
                                                <h5 class="product-type">Oranges</h5>
                                                <h3 class="product-name">Pure Pineapple</h3>
                                                <h3 class="product-price">$14.00
                                                    <del>$35.00</del>
                                                </h3>
                                                <div class="product-select">
                                                    <button class="add-to-wishlist round-icon-btn pink"><i
                                                            class="icon_heart_alt"></i></button>
                                                    <button class="add-to-cart round-icon-btn pink"><i
                                                            class="icon_bag_alt"></i></button>
                                                    <button class="add-to-compare round-icon-btn pink"><i
                                                            class="fas fa-random"></i></button>
                                                    <button class="quickview round-icon-btn pink"><i
                                                            class="far fa-eye"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-4">
                                            <div class="product pink"><a class="product-img"
                                                                         href="shop_detail.html"><img
                                                        src="/images/product/product03.png" alt="product image"></a>
                                                <h5 class="product-type">Oranges</h5>
                                                <h3 class="product-name">Apple</h3>
                                                <h3 class="product-price">$30.00
                                                    <del>$45.00</del>
                                                </h3>
                                                <div class="product-select">
                                                    <button class="add-to-wishlist round-icon-btn pink"><i
                                                            class="icon_heart_alt"></i></button>
                                                    <button class="add-to-cart round-icon-btn pink"><i
                                                            class="icon_bag_alt"></i></button>
                                                    <button class="add-to-compare round-icon-btn pink"><i
                                                            class="fas fa-random"></i></button>
                                                    <button class="quickview round-icon-btn pink"><i
                                                            class="far fa-eye"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="tab5">
                                    <div class="row no-gutters-sm">
                                        <div class="col-6 col-md-4">
                                            <div class="product pink"><a class="product-img"
                                                                         href="shop_detail.html"><img
                                                        src="/images/product/product04.png" alt="product image"></a>
                                                <h5 class="product-type">Oranges</h5>
                                                <h3 class="product-name">Pure Pineapple</h3>
                                                <h3 class="product-price">$14.00
                                                    <del>$35.00</del>
                                                </h3>
                                                <div class="product-select">
                                                    <button class="add-to-wishlist round-icon-btn pink"><i
                                                            class="icon_heart_alt"></i></button>
                                                    <button class="add-to-cart round-icon-btn pink"><i
                                                            class="icon_bag_alt"></i></button>
                                                    <button class="add-to-compare round-icon-btn pink"><i
                                                            class="fas fa-random"></i></button>
                                                    <button class="quickview round-icon-btn pink"><i
                                                            class="far fa-eye"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-4">
                                            <div class="product pink"><a class="product-img"
                                                                         href="shop_detail.html"><img
                                                        src="/images/product/product05.png" alt="product image"></a>
                                                <h5 class="product-type">Oranges</h5>
                                                <h3 class="product-name">Pure Pineapple</h3>
                                                <h3 class="product-price">$14.00
                                                    <del>$35.00</del>
                                                </h3>
                                                <div class="product-select">
                                                    <button class="add-to-wishlist round-icon-btn pink"><i
                                                            class="icon_heart_alt"></i></button>
                                                    <button class="add-to-cart round-icon-btn pink"><i
                                                            class="icon_bag_alt"></i></button>
                                                    <button class="add-to-compare round-icon-btn pink"><i
                                                            class="fas fa-random"></i></button>
                                                    <button class="quickview round-icon-btn pink"><i
                                                            class="far fa-eye"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-4">
                                            <div class="product pink"><a class="product-img"
                                                                         href="shop_detail.html"><img
                                                        src="/images/product/product02.png" alt="product image"></a>
                                                <h5 class="product-type">Oranges</h5>
                                                <h3 class="product-name">Apple</h3>
                                                <h3 class="product-price">$30.00
                                                    <del>$45.00</del>
                                                </h3>
                                                <div class="product-select">
                                                    <button class="add-to-wishlist round-icon-btn pink"><i
                                                            class="icon_heart_alt"></i></button>
                                                    <button class="add-to-cart round-icon-btn pink"><i
                                                            class="icon_bag_alt"></i></button>
                                                    <button class="add-to-compare round-icon-btn pink"><i
                                                            class="fas fa-random"></i></button>
                                                    <button class="quickview round-icon-btn pink"><i
                                                            class="far fa-eye"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="tab-so2">
                            <div class="best-seller_top mini-tab-title underline pink">
                                <div class="row align-items-md-center">
                                    <div class="col-12 col-md-4">
                                        <h2 class="title">Sản phẩm mới nhất</h2>
                                    </div>
                                    {{--                                    <div class="col-12 col-md-8 text-lg-right">--}}
                                    {{--                                        <ul class="tab-control text-md-right">--}}
                                    {{--                                            <li><a class="active" href="#tab1">All</a></li>--}}
                                    {{--                                            <li><a href="#tab2">Oranges</a></li>--}}
                                    {{--                                            <li><a href="#tab3">Fresh Meat</a></li>--}}
                                    {{--                                            <li><a href="#tab4">Vegetables</a></li>--}}
                                    {{--                                            <li><a href="#tab5">Fastfood</a></li>--}}
                                    {{--                                        </ul>--}}
                                    {{--                                    </div>--}}
                                </div>
                            </div>
                            <div class="best-seller_bottom">
                                <div id="tab1">
                                    <div class="row no-gutters-sm">
                                        @foreach($products as $key => $value)
                                            @if($key < 3 )
                                                <div class="col-6 col-md-4">
                                                    <div class="product pink"><a class="product-img"
                                                                                 href="shop_detail.html"><img
                                                                src="{{ url('storage/tmp/'.$value->first_image) }}"
                                                                alt="{{ $value->first_image }}"></a>
                                                        <h3 class="product-name">{{ $value->name }}</h3>
                                                        @if($value->discount_price !== null)
                                                            <h3 class="product-price">¥{{ $value->discount_price }}
                                                                <del>¥{{ $value->price }}</del>
                                                            </h3>
                                                        @else
                                                            <h3 class="product-price"> ¥{{ $value->price }} </h3>
                                                        @endif
                                                        <div class="product-select">
                                                            <button class="add-to-wishlist round-icon-btn pink"><i
                                                                     class="icon_heart_alt"></i></button>
                                                            <button class="add-to-cart round-icon-btn pink"><i
                                                                    class="icon_bag_alt"></i></button>
                                                            <button class="add-to-compare round-icon-btn pink"><i
                                                                    class="fas fa-random"></i></button>
                                                            <button class="quickview round-icon-btn pink"><i
                                                                    class="far fa-eye"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="quick-banner quick-banner-2">
                                        <div class="row justify-content-center align-items-center">
                                            <div class="col-6 col-md-5">
                                                <div class="bannner-img text-center"><img class="img-fluid"
                                                                                          src="/images/homepage03/quick_banner_2_img.png"
                                                                                          alt=""></div>
                                            </div>
                                            <div class="col-6 col-md-5">
                                                <div class="banner-text text-center text-md-left">
                                                    <h3 class="day">Black Friday </h3>
                                                    <h3 class="sale">Sale Off <span>60%</span></h3><a
                                                        class="normal-btn pink" href="shop_grid+list_3col.html">Shop
                                                        now</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="quick-banner quick-banner-3">
                                        <div class="row justify-content-center align-items-center">
                                            <div class="col-6 col-md-5">
                                                <div class="bannner-img text-center"><img class="img-fluid"
                                                                                          src="/images/homepage03/quick_banner_3_img.png"
                                                                                          alt=""></div>
                                            </div>
                                            <div class="col-6 col-md-5">
                                                <div class="banner-text text-center text-md-left">
                                                    <h3 class="day">Summer</h3>
                                                    <h3 class="sale">Sale Off <span>50%</span></h3><a
                                                        class="normal-btn pink" href="shop_grid+list_3col.html">Shop
                                                        now</a>
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
            <!-- End product block-->
            <div class="partner">
                <div class="container">
                    <div class="partner_block d-flex justify-content-between"
                         data-slick="{&quot;slidesToShow&quot;: 6}">
                        <div class="partner--logo" href=""><a href="#"><img src="/images/partner/partner_01.png"
                                                                            alt="partner" title="partner logo"></a>
                        </div>
                        <div class="partner--logo" href=""><a href="#"><img src="/images/partner/partner_02.png"
                                                                            alt="partner" title="partner logo"></a>
                        </div>
                        <div class="partner--logo" href=""><a href="#"><img src="/images/partner/partner_01.png"
                                                                            alt="partner" title="partner logo"></a>
                        </div>
                        <div class="partner--logo" href=""><a href="#"><img src="/images/partner/partner_02.png"
                                                                            alt="partner" title="partner logo"></a>
                        </div>
                        <div class="partner--logo" href=""><a href="#"><img src="/images/partner/partner_01.png"
                                                                            alt="partner" title="partner logo"></a>
                        </div>
                        <div class="partner--logo" href=""><a href="#"><img src="/images/partner/partner_02.png"
                                                                            alt="partner" title="partner logo"></a>
                        </div>
                        <div class="partner--logo" href=""><a href=""><img src="/images/partner/partner_01.png"
                                                                           alt="partner" title="partner logo"></a></div>
                    </div>
                </div>
            </div>
            <!-- End partner-->
        </div>
@endsection
@push('script')
    <script>
        $( document ).ready(function() {
           $(".add-to-cart").on( "click", function() {
               let id = $(this).closest('.product-select').attr('data-id');
               let product_name = $(this).closest('.product-select').attr('data-name')
               let product_price = $(this).closest('.product-select').attr('data-price')
               let product_discount_price = $(this).closest('.product-select').attr('data-discount_price');
               let url = '{{ url('/cart') }}';
               let data = {id: id, product_name: product_name,
                   product_price: product_price, product_discount_price: product_discount_price};
               $.ajaxSetup({
                   headers: {
                       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   }
               });
               $.ajax({
                   type: 'POST',
                   url: url,
                   data: data,
                   success: function (data) {
                       console.log(data);
                       $('.cart_money').text(data.total);
                   },
                   error: function (exception) {
                       alert('Exeption:' + exception);
                   }
               });

           });
        });

    </script>
@endpush
