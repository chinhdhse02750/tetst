@extends('layouts.shop')
@section('content')
    <div id="main">
        <div class="banner_v2">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-xl-12">
                        @if($banner)
                            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    @foreach($banner as $key => $val)
                                        <li data-target="#carouselExampleIndicators" data-slide-to="{{$key}}"
                                            @if($key == 0) class="active" @endif ></li>
                                    @endforeach

                                </ol>
                                <div class="carousel-inner">
                                    @foreach($banner as $key => $val)
                                        <div class="carousel-item @if($key == 0) active @endif">
                                            <img class="image-banner d-block w-100"  src="{{$val->image}}">
                                        </div>
                                    @endforeach
                                </div>

                                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        @else
                            <div class="banner-block">
                                <div class="row no-gutters justify-content-center align-items-md-center">
                                    <div class="img-block text-center"></div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- End banner v2-->
        {{--<div class="menu-slider" style="margin-top: 20px">--}}
            {{--<div class="container">--}}
                {{--<div class="row">--}}
                    {{--<div class="col-12 col-md-3">--}}
                        {{--<div class="quick-banner quick-banner-2">--}}
                            {{--<div class="row justify-content-center align-items-center">--}}
                                {{--<div class="col-6 col-md-5">--}}
                                    {{--<div class="bannner-img text-center"><img class="img-fluid" src="assets/images/homepage03/quick_banner_2_img.png" alt=""></div>--}}
                                {{--</div>--}}
                                {{--<div class="col-6 col-md-5">--}}
                                    {{--<div class="banner-text text-center text-md-left">--}}
                                        {{--<h3 class="day">Black Friday </h3>--}}
                                        {{--<h3 class="sale">Sale Off <span>60%</span></h3><a class="normal-btn pink" href="shop_grid+list_3col.html">Shop now</a>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="col-12 col-md-3">--}}
                        {{--<div class="quick-banner quick-banner-2">--}}
                            {{--<div class="row justify-content-center align-items-center">--}}
                                {{--<div class="col-6 col-md-5">--}}
                                    {{--<div class="bannner-img text-center"><img class="img-fluid" src="assets/images/homepage03/quick_banner_2_img.png" alt=""></div>--}}
                                {{--</div>--}}
                                {{--<div class="col-6 col-md-5">--}}
                                    {{--<div class="banner-text text-center text-md-left">--}}
                                        {{--<h3 class="day">Black Friday </h3>--}}
                                        {{--<h3 class="sale">Sale Off <span>60%</span></h3><a class="normal-btn pink" href="shop_grid+list_3col.html">Shop now</a>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="col-12 col-md-3">--}}
                        {{--<div class="quick-banner quick-banner-2">--}}
                            {{--<div class="row justify-content-center align-items-center">--}}
                                {{--<div class="col-6 col-md-5">--}}
                                    {{--<div class="bannner-img text-center"><img class="img-fluid" src="assets/images/homepage03/quick_banner_2_img.png" alt=""></div>--}}
                                {{--</div>--}}
                                {{--<div class="col-6 col-md-5">--}}
                                    {{--<div class="banner-text text-center text-md-left">--}}
                                        {{--<h3 class="day">Black Friday </h3>--}}
                                        {{--<h3 class="sale">Sale Off <span>60%</span></h3><a class="normal-btn pink" href="shop_grid+list_3col.html">Shop now</a>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="col-12 col-md-3">--}}
                        {{--<div class="quick-banner quick-banner-2">--}}
                            {{--<div class="row justify-content-center align-items-center">--}}
                                {{--<div class="col-6 col-md-5">--}}
                                    {{--<div class="bannner-img text-center"><img class="img-fluid" src="assets/images/homepage03/quick_banner_2_img.png" alt=""></div>--}}
                                {{--</div>--}}
                                {{--<div class="col-6 col-md-5">--}}
                                    {{--<div class="banner-text text-center text-md-left">--}}
                                        {{--<h3 class="day">Black Friday </h3>--}}
                                        {{--<h3 class="sale">Sale Off <span>60%</span></h3><a class="normal-btn pink" href="shop_grid+list_3col.html">Shop now</a>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}

        <div class="home3-product-block">
            <div class="container">
                <div class="row">
                    <input type="hidden" value="{{ url('api/v1/product/cart') }} " id="url-cart">
                    <input type="hidden" value="{{ url('/review') }} " id="url-view">
                    <div class="col-12 col-xl-3">
                        <div class="deal-of-week_slide">
                            <div class="week-deal_top mini-tab-title underline pink">
                                <h2 class="title">S???n ph???m c???a tu???n</h2>
                                <div class="week-deal_control"></div>
                            </div>
                            <div class="week-deal_bottom">
                                @foreach($dealOfWeekProduct as $key => $value)
                                    @if($key < 5)
                                        <div class="deal-block">
                                            <div class="deal-block_detail">
                                                @if($value->discount_price)
                                                    <h5 class="deal-discount">
                                                        - {{ number_format($value->percent_sale, 2) }}%</h5>
                                                @endif
                                                <div class="deal-img">
                                                    <a href="{{ route('product.detail', ['product' => $value->alias]) }}">
                                                        <img src="{{ url('storage/tmp/thumbnail_'.$value->first_image) }}"
                                                             alt="{{ $value->first_image }}">
                                                    </a>
                                                </div>
                                                <div class="deal-countdown">
                                                    <div class="event-countdown deal_of_week_count"></div>
                                                </div>
                                                <div class="deal-info text-center">
                                                    {{--                                                    <h5 class="color-type pink deal-type">Oranges</h5><a--}}
                                                    {{--                                                        class="deal-name"--}}
                                                    {{--                                                        href="shop_detail.html">Pure--}}
                                                    {{--
                                                                                                           Pinapple</a>--}}
                                                    @if($value->discount_price)
                                                        <h3 class="deal-price">
                                                            ??{{ number_format($value->discount_price) }}
                                                            <del>??{{ number_format($value->price) }}</del>
                                                        </h3>
                                                    @else
                                                        <h3 class="deal-price"> ??{{ $value->price }}</h3>
                                                    @endif

                                                </div>
                                                <div class="deal-select text-center product-select"
                                                     data-id="{{ $value->id }}"
                                                     data-name="{{ $value->name }}" data-price="{{ $value->price }}"
                                                     data-discount_price="{{ $value->discount_price }}">
                                                    <button class="add-to-cart round-icon-btn pink pink"><i
                                                            class="icon_bag_alt"></i></button>
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
                                                    <h5 class="benefit-title">MI???N PH?? SHIP H??NG</h5>
                                                    <p class="benefit-describle">Cho t???t c??? ????n h??ng tr??n ???9990</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-12">
                                            <div class="benefit-detail d-flex flex-row align-items-center"><img
                                                    class="benefit-img" src="/images/homepage02/benefit-icon2.png"
                                                    alt="">
                                                <div class="benefit-detail_info">
                                                    <h5 class="benefit-title">GIAO H??NG</h5>
                                                    <p class="benefit-describle">Giao h??ng nhanh, r???, ????ng h???n</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-12">
                                            <div class="benefit-detail d-flex flex-row align-items-center"><img
                                                    class="benefit-img" src="/images/homepage02/benefit-icon3.png"
                                                    alt="">
                                                <div class="benefit-detail_info">
                                                    <h5 class="benefit-title">B???O M???T THANH TO??N</h5>
                                                    <p class="benefit-describle">100% b???o m???t</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-12">
                                            <div class="benefit-detail boderless d-flex flex-row align-items-center">
                                                <img class="benefit-img" src="/images/homepage02/benefit-icon4.png"
                                                     alt="">
                                                <div class="benefit-detail_info">
                                                    <h5 class="benefit-title">H??? TR??? 24/7!</h5>
                                                    <p class="benefit-describle">H??? tr??? t???n t??m</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{--<div class="customer-satisfied text-center">--}}
                        {{--<div class="customer-satisfied_border">--}}
                        {{--<div class="customer-satisfied_wrapper">--}}
                        {{--<div class="customer-satisfied_block">--}}
                        {{--<div class="customer-img mx-auto"><img--}}
                        {{--src="/images/homepage03/customer_img_1.png" alt="customer"></div>--}}
                        {{--<div class="customer-info">--}}
                        {{--<h5 class="customer-name">Steven Ady</h5>--}}
                        {{--<p class="customer-comment">Lorem ipsum dolor sit amet consectetur--}}
                        {{--adipisicing elit, sed do accusantium </p>--}}
                        {{--<div class="customer-rate"><i class="icon_star"></i><i--}}
                        {{--class="icon_star"></i><i class="icon_star"></i><i--}}
                        {{--class="icon_star"></i><i class="icon_star-half"></i></div>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="customer-satisfied_block">--}}
                        {{--<div class="customer-img mx-auto"><img--}}
                        {{--src="/images/homepage03/customer_img_1.png" alt="customer"></div>--}}
                        {{--<div class="customer-info">--}}
                        {{--<h5 class="customer-name">Steven Ady</h5>--}}
                        {{--<p class="customer-comment">Lorem ipsum dolor sit amet consectetur--}}
                        {{--adipisicing elit, sed do accusantium </p>--}}
                        {{--<div class="customer-rate"><i class="icon_star"></i><i--}}
                        {{--class="icon_star"></i><i class="icon_star"></i><i--}}
                        {{--class="icon_star"></i><i class="icon_star-half"></i></div>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="customer-satisfied_block">--}}
                        {{--<div class="customer-img mx-auto"><img--}}
                        {{--src="/images/homepage03/customer_img_1.png" alt="customer"></div>--}}
                        {{--<div class="customer-info">--}}
                        {{--<h5 class="customer-name">Steven Ady</h5>--}}
                        {{--<p class="customer-comment">Lorem ipsum dolor sit amet consectetur--}}
                        {{--adipisicing elit, sed do accusantium </p>--}}
                        {{--<div class="customer-rate"><i class="icon_star"></i><i--}}
                        {{--class="icon_star"></i><i class="icon_star"></i><i--}}
                        {{--class="icon_star"></i><i class="icon_star-half"></i></div>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="customer-satisfied_control"></div>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                    </div>
                    <div class="col-12 col-xl-9">
                        <div id="tab">
                            <div class="best-seller_top mini-tab-title underline pink">
                                <div class="row align-items-md-center">
                                    <div class="col-12 col-md-4">
                                        <h2 class="title"> S???n ph???m n???i b???t </h2>
                                    </div>
                                </div>
                            </div>
                            <div class="best-seller_bottom">
                                <div class="tab1">
                                    <div class="row responsive">
                                        @foreach($featuredProduct as $key => $value)
                                            @if($key < 12)
                                                <div class="col-6 col-md-3 {{$key%2? 'p-l-sm':'p-r-sm'}}">
                                                    <div class="product pink"><a class="product-img"
                                                                                 href="{{ route('product.detail', ['product' => $value->alias]) }}"><img
                                                                src="{{ url('storage/tmp/thumbnail_'.$value->first_image) }}"
                                                                alt="{{ $value->first_image }}"></a>
                                                        <h3 class="product-name">{{ $value->name }}</h3>
                                                        @if($value->discount_price !== null)
                                                            <h3 class="product-price">
                                                                ??{{ number_format($value->discount_price) }}
                                                                <del>??{{ number_format($value->price) }}</del>
                                                            </h3>
                                                        @else
                                                            <h3 class="product-price">
                                                                ??{{ number_format($value->price) }}
                                                            </h3>
                                                        @endif

                                                        @if($value->stock == 0)
                                                            <div class="out-of-stock-label">H???t h??ng</div>
                                                        @else
                                                            <div class="deal-select text-center product-select"
                                                                 data-id="{{ $value->id }}"
                                                                 data-name="{{ $value->name }}"
                                                                 data-price="{{ $value->price }}"
                                                                 data-discount_price="{{ $value->discount_price }}">
                                                                <button class="add-to-cart round-icon-btn pink pink"><i
                                                                        class="icon_bag_alt"></i></button>
                                                                <button class="quickview round-icon-btn pink"><i
                                                                        class="far fa-eye"></i>
                                                                </button>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{--<div class="quick-banner">--}}
                        {{--<div class="row justify-content-center align-items-center flex-column flex-md-row">--}}
                        {{--<div class="col-12 col-md-5">--}}
                        {{--<div class="bannner-img text-center"><img class="img-fluid"--}}
                        {{--src="/images/homepage03/quick_banner_1_img.png"--}}
                        {{--alt=""></div>--}}
                        {{--</div>--}}
                        {{--<div class="col-10 col-md-5">--}}
                        {{--<div class="banner-text text-center text-md-left">--}}
                        {{--<div--}}
                        {{--class="discount-block d-flex align-items-center justify-content-center justify-content-md-start text-left">--}}
                        {{--<h2 class="big-number">50</h2>--}}
                        {{--<h3>%OFF<br>Black <span>Friday</span></h3>--}}
                        {{--</div>--}}
                        {{--<p>Lorem ipsum dolor sit amet, consectetur oce omnis iste natus error sit </p><a--}}
                        {{--class="normal-btn pink" href="shop_grid+list_3col.html">Shop now</a>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        <div id="tab-so1">
                            <div class="best-seller_top mini-tab-title underline pink">
                                <div class="row align-items-md-center">
                                    <div class="col-12 col-md-4">
                                        <h2 class="title">S???n ph???m b??n ch???y nh???t</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="best-seller_bottom">
                                <div class="tab1">
                                    <div class="row responsive">
                                        @foreach($bestSeller as $key => $value)
                                            <div class="col-6 col-md-3 {{$key%2? 'p-l-sm':'p-r-sm'}}">
                                                <div class="product pink"><a class="product-img"
                                                                             href="{{ route('product.detail', ['product' => $value->alias]) }}"><img
                                                            src="{{ url('storage/tmp/thumbnail_'.$value->first_image) }}"
                                                            alt="{{ $value->first_image }}"></a>
                                                    <h3 class="product-name">{{ $value->name }}</h3>
                                                    @if($value->discount_price !== null)
                                                        <h3 class="product-price">
                                                            ??{{ number_format($value->discount_price) }}
                                                            <del>??{{ number_format($value->price) }}</del>
                                                        </h3>
                                                    @else
                                                        <h3 class="product-price">
                                                            ??{{ number_format($value->price) }}
                                                        </h3>
                                                    @endif
                                                    @if($value->stock == 0)
                                                        <div class="out-of-stock-label">H???t h??ng</div>
                                                    @else
                                                        <div class="deal-select text-center product-select"
                                                             data-id="{{ $value->id }}"
                                                             data-name="{{ $value->name }}"
                                                             data-price="{{ $value->price }}"
                                                             data-discount_price="{{ $value->discount_price }}">
                                                            <button class="add-to-cart round-icon-btn pink pink"><i
                                                                    class="icon_bag_alt"></i></button>
                                                            <button class="quickview round-icon-btn pink"><i
                                                                    class="far fa-eye"></i>
                                                            </button>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if(!$saleProduct)
                            <div id="tab-so2">
                            <div class="sale-product_top mini-tab-title underline pink">
                                <div class="row align-items-md-center">
                                    <div class="col-12 col-md-4">
                                        <h2 class="title">S???n ph???m khuy???n m??i</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="best-product_bottom">
                                <div class="tab1">
                                    <div class="row responsive">
                                        @foreach($saleProduct as $key => $value)
                                            <div class="col-6 col-md-3 {{$key%2? 'p-l-sm':'p-r-sm'}}">
                                                <div class="product pink"><a class="product-img"
                                                                             href="{{ route('product.detail', ['product' => $value->alias]) }}"><img
                                                            src="{{ url('storage/tmp/thumbnail_'.$value->first_image) }}"
                                                            alt="{{ $value->first_image }}"></a>
                                                    <h3 class="product-name">{{ $value->name }}</h3>
                                                    @if($value->discount_price !== null)
                                                        <h3 class="product-price">
                                                            ??{{ number_format($value->discount_price) }}
                                                            <del>??{{ number_format($value->price) }}</del>
                                                        </h3>
                                                    @else
                                                        <h3 class="product-price">
                                                            ??{{ number_format($value->price) }}
                                                        </h3>
                                                    @endif
                                                    @if($value->stock == 0)
                                                        <div class="out-of-stock-label">H???t h??ng</div>
                                                    @else
                                                        <div class="deal-select text-center product-select"
                                                             data-id="{{ $value->id }}"
                                                             data-name="{{ $value->name }}"
                                                             data-price="{{ $value->price }}"
                                                             data-discount_price="{{ $value->discount_price }}">
                                                            <button class="add-to-cart round-icon-btn pink pink"><i
                                                                    class="icon_bag_alt"></i></button>
                                                            <button class="quickview round-icon-btn pink"><i
                                                                    class="far fa-eye"></i>
                                                            </button>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        <div id="tab-so3">
                            <div class="best-seller_top mini-tab-title underline pink">
                                <div class="row align-items-md-center">
                                    <div class="col-12 col-md-4">
                                        <h2 class="title">S???n ph???m m???i nh???t</h2>
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
                                <div class="tab1">
                                    <div class="row">
                                        @foreach($products as $key => $value)
                                            @if($key < 12)
                                                <div class="col-6 col-md-3 {{$key%2? 'p-l-sm':'p-r-sm'}}">
                                                    <div class="product pink"><a class="product-img"
                                                                                 href="{{ route('product.detail', ['product' => $value->alias]) }}">
                                                            <img
                                                                src="{{ url('storage/tmp/thumbnail_'.$value->first_image) }}"
                                                                alt="{{ $value->first_image }}"></a>
                                                        <h3 class="product-name">{{ $value->name }}</h3>
                                                        @if($value->discount_price !== null)
                                                            <h3 class="product-price">
                                                                ??{{ number_format($value->discount_price) }}
                                                                <del>??{{ number_format($value->price) }}</del>
                                                            </h3>
                                                        @else
                                                            <h3 class="product-price">
                                                                ??{{ number_format($value->price) }} </h3>
                                                        @endif
                                                        @if($value->stock == 0)
                                                            <div class="out-of-stock-label">H???t h??ng</div>
                                                        @else
                                                            <div class="deal-select text-center product-select"
                                                                 data-id="{{ $value->id }}"
                                                                 data-name="{{ $value->name }}"
                                                                 data-price="{{ $value->price }}"
                                                                 data-discount_price="{{ $value->discount_price }}">
                                                                <button class="add-to-cart round-icon-btn pink pink"><i
                                                                        class="icon_bag_alt"></i></button>
                                                                <button class="quickview round-icon-btn pink"><i
                                                                        class="far fa-eye"></i>
                                                                </button>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            {{--<div class="row">--}}
                            {{--<div class="col-12 col-md-6">--}}
                            {{--<div class="quick-banner quick-banner-2">--}}
                            {{--<div class="row justify-content-center align-items-center">--}}
                            {{--<div class="col-6 col-md-5">--}}
                            {{--<div class="bannner-img text-center"><img class="img-fluid"--}}
                            {{--src="/images/homepage03/quick_banner_2_img.png"--}}
                            {{--alt=""></div>--}}
                            {{--</div>--}}
                            {{--<div class="col-6 col-md-5">--}}
                            {{--<div class="banner-text text-center text-md-left">--}}
                            {{--<h3 class="day">Black Friday </h3>--}}
                            {{--<h3 class="sale">Sale Off <span>60%</span></h3><a--}}
                            {{--class="normal-btn pink" href="shop_grid+list_3col.html">Shop--}}
                            {{--now</a>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="col-12 col-md-6">--}}
                            {{--<div class="quick-banner quick-banner-3">--}}
                            {{--<div class="row justify-content-center align-items-center">--}}
                            {{--<div class="col-6 col-md-5">--}}
                            {{--<div class="bannner-img text-center"><img class="img-fluid"--}}
                            {{--src="/images/homepage03/quick_banner_3_img.png"--}}
                            {{--alt=""></div>--}}
                            {{--</div>--}}
                            {{--<div class="col-6 col-md-5">--}}
                            {{--<div class="banner-text text-center text-md-left">--}}
                            {{--<h3 class="day">Summer</h3>--}}
                            {{--<h3 class="sale">Sale Off <span>50%</span></h3><a--}}
                            {{--class="normal-btn pink" href="shop_grid+list_3col.html">Shop--}}
                            {{--now</a>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                        </div>
                    </div>
                </div>
            </div>
            @include('shop.modal_add_success')
            @include('includes.slide_footer')

        </div>
        @endsection
        @push('script')
            <script>
                $(document).ready(function () {
                    var maxHeight = 0;

                    $('.product').each(function () {
                        var thisH = $(this).find('.product-name').height();

                        if (thisH > maxHeight) {
                            maxHeight = thisH;
                        }
                    });
                    if (maxHeight > 48) {
                        $('.product').find('.product-name').css({
                            'height': '54px',
                            'margin-top': '5px',
                            'overflow': 'hidden',
                            'display': '-webkit-box',
                            '-webkit-line-clamp': '2',
                            '-webkit-box-orient': 'vertical',
                            'text-overflow': 'ellipsis'
                        });
                    } else {
                        $('.product').find('.product-name').css({
                            'height': maxHeight,
                            'margin-top': '5px',
                            'overflow': 'hidden',
                        });
                    }

                    $('.responsive').slick({
                        dots: false,
                        infinite: true,
                        speed: 300,
                        slidesToShow: 4,
                        slidesToScroll: 4,
                        responsive: [
                            {
                                breakpoint: 1024,
                                settings: {
                                    slidesToShow: 3,
                                    slidesToScroll: 3,
                                    infinite: true,
                                    dots: false
                                }
                            },
                            {
                                breakpoint: 600,
                                settings: {
                                    slidesToShow: 2,
                                    slidesToScroll: 2
                                }
                            },
                            {
                                breakpoint: 480,
                                settings: {
                                    slidesToShow: 2,
                                    slidesToScroll: 2
                                }
                            }
                            // You can unslick at a given breakpoint now by adding:
                            // settings: "unslick"
                            // instead of a settings object
                        ]
                    });


                })
            </script>
    @endpush
