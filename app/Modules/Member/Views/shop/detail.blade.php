@extends('layouts.shop')

@section('content')
    <div id="main">
    {!! Breadcrumbs::render('shop.detail', $cateData, $subData) !!}
    <!-- End breadcrumb-->
        <!-- End breadcrumb-->
        <div class="shop-layout">
            <div class="container">
                <div class="row">
                    <div class="col-xl-3">
                        <div class="shop-sidebar">
                            <button class="no-round-btn" id="filter-sidebar--closebtn">Close sidebar</button>
                            <div class="shop-sidebar_department">
                                <input type="hidden" value="{{ url('api/v1/cart') }} " id="url-cart">
                                <div class="department_top mini-tab-title underline">
                                    <h2 class="title">Departments</h2>
                                </div>
                                <div class="department_bottom">
                                    <ul>
                                        <li><a class="department-link" href="shop_grid+list_3col.html">Fresh Meat</a>
                                        </li>
                                        <li><a class="department-link" href="shop_grid+list_3col.html">Vegetables</a>
                                        </li>
                                        <li><a class="department-link" href="shop_grid+list_3col.html">Fruit & Nut
                                                Gifts</a></li>
                                        <li><a class="department-link" href="shop_grid+list_3col.html">Fresh Berries</a>
                                        </li>
                                        <li><a class="department-link" href="shop_grid+list_3col.html">Ocean Foods</a>
                                        </li>
                                        <li><a class="department-link" href="shop_grid+list_3col.html">Butter & Eggs</a>
                                        </li>
                                        <li><a class="department-link" href="shop_grid+list_3col.html">Fastfood</a></li>
                                        <li><a class="department-link" href="shop_grid+list_3col.html">Fresh Onion</a>
                                        </li>
                                        <li><a class="department-link" href="shop_grid+list_3col.html">Papayaya &
                                                Crisps</a></li>
                                        <li><a class="department-link" href="shop_grid+list_3col.html">Oatmeal</a></li>
                                        <li><a class="department-link" href="shop_grid+list_3col.html">Fresh Bananas</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="shop-sidebar_tag">
                                <div class="tag_top mini-tab-title underline">
                                    <h2 class="title">Từ khóa</h2>
                                </div>
                                <div class="tag_bottom">
                                    @foreach($tags as $key => $value)
                                        <a class="tag-btn" href="{{ route('shop.view', ['alias' => $value->alias]) }}">{{ $value->name }}</a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="filter-sidebar--background" style="display: none"></div>
                    </div>
                    <div class="col-xl-9">
                        <div class="shop-detail">
                            <div class="row">
                                <div class="col-12">
                                    <div id="show-filter-sidebar">
                                        <h5><i class="fas fa-bars"></i>Show sidebar</h5>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="shop-detail_img">
                                        <button class="round-icon-btn" id="zoom-btn"><i class="icon_zoom-in_alt"></i>
                                        </button>
                                        <div class="big-img big-img_qv">
                                            @foreach($images as $key => $value)
                                                <div class="big-img_block">
                                                    <img src="{{ url('storage/tmp/'.$value) }}" alt="{{ $value }}">
                                                </div>
                                            @endforeach

                                        </div>
                                        <div class="slide-img slide-img_qv">
                                            @foreach($images as $key => $value)
                                                <div class="slide-img_block">
                                                    <img src="{{ url('storage/tmp/'.$value) }}" alt="{{ $value }}">
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="img_control"></div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="shop-detail_info">
                                        <h5 class="product-type color-type">{{$cateData->name}}</h5>
                                        <h2 class="product-name">{{$subData->name}}</h2>
                                        <p class="product-describe">{{ $subData->description }}</p>
{{--                                        <p class="delivery-status">Free delivery</p>--}}
                                        <div class="price-rate">
                                            <h3 class="product-price">
                                                <del>¥{{ $subData->price }}</del>
                                                ¥{{ $subData->discount_price }}
                                            </h3>
{{--                                            <h5 class="product-rated"><i class="icon_star"></i><i class="icon_star"></i><i--}}
{{--                                                    class="icon_star"></i><i class="icon_star"></i><i--}}
{{--                                                    class="icon_star-half"></i><span>(15)</span></h5>--}}
                                        </div>
{{--                                        <div class="color-select">--}}
{{--                                            <h5>Select Color:</h5><a class="color bg-danger" href="#"></a><a--}}
{{--                                                class="color bg-success" href="#"></a><a class="color bg-info"--}}
{{--                                                                                         href="#"></a>--}}
{{--                                        </div>--}}
                                        <div class="quantity-select"> <label for="quantity">Số lượng:</label>
                                            <input class="no-round-input" id="quantity" type="number" min="0" value="1">
                                            <label class="total_product_view"><span class="count_stock">{{ $subData->stock }}
                                                </span> @lang('product.label.in_stock')</label>
                                        </div>

                                        <div class="product-select" data-id="{{ $subData->id }}"
                                             data-name="{{ $subData->name }}" data-price="{{ $subData->price }}"
                                             data-discount_price="{{ $subData->discount_price }}">
                                            <button class="add-to-cart normal-btn outline">@lang('product.label.add_to_cart')</button>
                                            <button class="add-to-compare normal-btn outline">+ Add to Compare</button>
                                        </div>
                                        <div class="product-share">
                                            <h5>Share link:</h5><a href=""><i class="fab fa-facebook-f"> </i></a><a
                                                href=""><i class="fab fa-twitter"></i></a><a href=""><i
                                                    class="fab fa-invision"> </i></a><a href=""><i
                                                    class="fab fa-pinterest-p"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="shop-detail_more-info">
                                        <div id="tab-so3">
                                            <ul class="mb-0">
                                                <li class="active"><a href="#tab-1">DESCRIPTION</a></li>
                                                <li><a href="#tab-2">Customer Reviews (02)</a></li>
                                            </ul>
                                            <div id="tab-1">
                                                <div class="description-block">
                                                    <div class="description-item_block">
                                                        <div class="row align-items-center">
                                                            <div class="col-12 col-md-6">
                                                                <div class="description-item_img"><img class="img-fluid"
                                                                                                       src="assets/images/shop/shop_detail_img.png"
                                                                                                       alt="description image">
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-6">
                                                                <div class="description-item_text">
                                                                    <h2>Product information</h2>
                                                                    <p>Lorem ipsum dolor sit amet, consectetur
                                                                        adipisicing elit, sed do eiusmod tempor
                                                                        incididunt ut labore et dolore magna aliqua.</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="description-item_block">
                                                        <div class="row align-items-center">
                                                            <div class="col-md-6">
                                                                <div class="description-item_img"><img class="img-fluid"
                                                                                                       src="assets/images/shop/shop_detail_img_2.png"
                                                                                                       alt="description image">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="description-item_text">
                                                                    <h2>An incredible view</h2>
                                                                    <p>Lorem ipsum dolor sit amet, consectetur
                                                                        adipisicing elit, sed do eiusmod tempor
                                                                        incididunt ut labore et dolore magna
                                                                        aliqua. </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="tab-2">
                                                <div class="customer-reviews_block">
                                                    <div class="customer-review">
                                                        <div class="row">
                                                            <div class="col-12 col-sm-3 col-lg-2">
                                                                <div class="customer-review_left">
                                                                    <div class="customer-review_img text-center"><img
                                                                            class="img-fluid"
                                                                            src="assets/images/shop/reviewer_01.png"
                                                                            alt="customer image"></div>
                                                                    <div class="customer-rate"><i class="icon_star"></i><i
                                                                            class="icon_star"></i><i
                                                                            class="icon_star"></i><i
                                                                            class="icon_star"></i><i
                                                                            class="icon_star-half"></i></div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-sm-9 col-lg-10">
                                                                <div class="customer-comment">
                                                                    <h5 class="comment-date">27 Aug 2016</h5>
                                                                    <h3 class="customer-name">Jenney Kelley</h3>
                                                                    <p class="customer-commented">Lorem ipsum dolor sit
                                                                        amet, consectetur adipisicing elit, sed do
                                                                        eiusmod tempor incididunt ut labore et dolore
                                                                        magna alation uidem dolore eu fugiat nulla
                                                                        pariatur. </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="customer-review">
                                                        <div class="row">
                                                            <div class="col-12 col-sm-3 col-lg-2">
                                                                <div class="customer-review_left">
                                                                    <div class="customer-review_img text-center"><img
                                                                            class="img-fluid"
                                                                            src="assets/images/shop/reviewer_02.png"
                                                                            alt="customer image"></div>
                                                                    <div class="customer-rate"><i class="icon_star"></i><i
                                                                            class="icon_star"></i><i
                                                                            class="icon_star"></i><i
                                                                            class="icon_star"></i><i
                                                                            class="icon_star-half"></i></div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-sm-9 col-lg-10">
                                                                <div class="customer-comment">
                                                                    <h5 class="comment-date">27 Aug 2016</h5>
                                                                    <h3 class="customer-name">Jenney Kelley</h3>
                                                                    <p class="customer-commented">Lorem ipsum dolor sit
                                                                        amet, consectetur adipisicing elit, sed do
                                                                        eiusmod tempor incididunt ut labore et dolore
                                                                        magna alation uidem dolore eu fugiat nulla
                                                                        pariatur. </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="add-review">
                                                        <div class="add-review_top">
                                                            <h2>Add Review</h2>
                                                        </div>
                                                        <div class="add-review_bottom">
                                                            <form action="" method="post">
                                                                <div class="row">
                                                                    <div class="col-12 col-md-6">
                                                                        <input class="no-round-input" type="text"
                                                                               placeholder="Name*">
                                                                    </div>
                                                                    <div class="col-12 col-md-6">
                                                                        <input class="no-round-input" type="text"
                                                                               placeholder="Email*">
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="rating">
                                                                            <h5>Your rating:</h5><span><i
                                                                                    class="icon_star"></i><i
                                                                                    class="icon_star"></i><i
                                                                                    class="icon_star"></i><i
                                                                                    class="icon_star"></i><i
                                                                                    class="icon_star"></i></span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <textarea class="textarea-form" id="review"
                                                                                  name="" cols="30" rows="4"
                                                                                  placeholder="Message"></textarea>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <button class="normal-btn">Submit Review
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </form>
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
        </div>
    </div>
    @include('shop.modal_add_success')
@endsection
@push('script')
    <script>
        $(document).ready(function () {
            $('#sort_product').on('change', function () {
                $('#sort_product').submit();
            });
        });
    </script>
@endpush
