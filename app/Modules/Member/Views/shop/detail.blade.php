@extends('layouts.shop')

@section('content')
    <div id="main" style="margin-top: 20px">
        <!-- End breadcrumb-->
        <!-- End breadcrumb-->
        <div class="shop-layout">
            <div class="container">
                <div class="row">
                    <div class="col-xl-3">
                        <div class="shop-sidebar">
                            <button class="no-round-btn" id="filter-sidebar--closebtn">Close sidebar</button>
                            <div class="shop-sidebar_department">
                                <input type="hidden" value="{{ url('api/v1/product/cart') }} " id="url-cart">
                                <input type="hidden" value="{{ url('api/v1/product/comment') }} " id="url-comment">
                                <div class="department_top mini-tab-title underline">
                                    <h2 class="title">Danh mục sản phẩm</h2>
                                </div>
                                <div class="department_bottom">
                                    <ul>
                                        @foreach($allCategories as $menu)
                                            <li class="menu-toggle">
                                                <a class="department-link"
                                                   href="{{ route('cate.view', $menu->alias) }}">{{ $menu->name }}</a>
                                                @if(count($menu->childrenCategories))
                                                    <span data-toggle="collapse"
                                                          data-target="#{{ $menu->alias }}"
                                                          class="collapsed text-truncate submenu-indicator"><i
                                                                class="icon_plus"></i></span>
                                                @endif
                                                @if(count($menu->childrenCategories))
                                                    @include('includes.menu_sub',['childs' => $menu->childrenCategories, 'target' => $menu->alias ])
                                                @endif
                                            </li>

                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            @if(!empty($tags))
                                <div class="shop-sidebar_tag">
                                    <div class="tag_top mini-tab-title underline">
                                        <h2 class="title">Từ khóa</h2>
                                    </div>
                                    <div class="tag_bottom">
                                        @foreach($tags as $key => $value)
                                            <a class="tag-btn"
                                               href="{{ route('tag.view', ['alias' => $value->alias]) }}">{{ $value->name }}</a>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            @if(!empty($categories))
                                <div class="shop-sidebar_tag">
                                    <div class="tag_top mini-tab-title underline">
                                        <h2 class="title">Danh mục</h2>
                                    </div>
                                    <div class="tag_bottom">
                                        @foreach($categories as $key => $value)
                                            <a class="tag-btn"
                                               href="{{ route('cate.view', ['category' => $value->alias]) }}">{{ $value->name }}</a>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
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
                                        <div class="quantity-select"><label for="quantity">Số lượng:</label>
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
                                                <li class="active"><a href="#tab-1">Mô tả</a></li>
                                                <li><a href="#tab-2">Đánh giá (02)</a></li>
                                            </ul>
                                            <div id="tab-1">
                                                <div class="description-block">
                                                    <div class="description-item_block">
                                                        <div class="row align-items-center">
                                                            <div class="col-12">
                                                                <div class="description-item_text">
                                                                    {!! $subData->content !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="tab-2">
                                                <div class="customer-reviews_block">
                                                    @if (!$reviews)
                                                        <div class="block-review">
                                                            <h3 class="reply-title">Hãy là người đầu tiên nhận xét
                                                                "{{ $subData->name }}"</h3>
                                                        </div>
                                                    @else
                                                        <div class="block-review">
                                                            <div class="customer-review">
                                                                <div class="row">
                                                                    <div class="col-12 col-sm-3 col-lg-2">
                                                                        <div class="customer-review_left">
                                                                            <div class="customer-review_img text-center">
                                                                                <img
                                                                                        class="img-fluid"
                                                                                        src="assets/images/shop/reviewer_01.png"
                                                                                        alt="customer image"></div>
                                                                            <div class="customer-rate"><i
                                                                                        class="icon_star"></i><i
                                                                                        class="icon_star"></i><i
                                                                                        class="icon_star"></i><i
                                                                                        class="icon_star"></i><i
                                                                                        class="icon_star-half"></i>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-sm-9 col-lg-10">
                                                                        <div class="customer-comment">
                                                                            <h5 class="comment-date">27 Aug 2016</h5>
                                                                            <h3 class="customer-name">Jenney Kelley</h3>
                                                                            <p class="customer-commented">Lorem ipsum
                                                                                dolor sit
                                                                                amet, consectetur adipisicing elit, sed
                                                                                do
                                                                                eiusmod tempor incididunt ut labore et
                                                                                dolore
                                                                                magna alation uidem dolore eu fugiat
                                                                                nulla
                                                                                pariatur. </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="customer-review">
                                                                <div class="row">
                                                                    <div class="col-12 col-sm-3 col-lg-2">
                                                                        <div class="customer-review_left">
                                                                            <div class="customer-review_img text-center">
                                                                                <img
                                                                                        class="img-fluid"
                                                                                        src="assets/images/shop/reviewer_02.png"
                                                                                        alt="customer image"></div>
                                                                            <div class="customer-rate"><i
                                                                                        class="icon_star"></i><i
                                                                                        class="icon_star"></i><i
                                                                                        class="icon_star"></i><i
                                                                                        class="icon_star"></i><i
                                                                                        class="icon_star-half"></i>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-sm-9 col-lg-10">
                                                                        <div class="customer-comment">
                                                                            <h5 class="comment-date">27 Aug 2016</h5>
                                                                            <h3 class="customer-name">Jenney Kelley</h3>
                                                                            <p class="customer-commented">Lorem ipsum
                                                                                dolor sit
                                                                                amet, consectetur adipisicing elit, sed
                                                                                do
                                                                                eiusmod tempor incididunt ut labore et
                                                                                dolore
                                                                                magna alation uidem dolore eu fugiat
                                                                                nulla
                                                                                pariatur. </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    <div class="add-review">
                                                        <div class="add-review_top">
                                                            <h2>Đánh giá của bạn</h2>
                                                        </div>
                                                        <div class="add-review_bottom">
                                                            <form action="" method="post">
                                                                <div class="row">
                                                                    <dic class="col-12">
                                                                        <div class="rating">
                                                                            <div class="comment-form-rating">
                                                                                <div class='rating-stars'>
                                                                                    <ul id='stars'>
                                                                                        <li class='star' title='Poor'
                                                                                            data-value='1'>
                                                                                            <i class='fa fa-star fa-fw'></i>
                                                                                        </li>
                                                                                        <li class='star' title='Fair'
                                                                                            data-value='2'>
                                                                                            <i class='fa fa-star fa-fw'></i>
                                                                                        </li>
                                                                                        <li class='star' title='Good'
                                                                                            data-value='3'>
                                                                                            <i class='fa fa-star fa-fw'></i>
                                                                                        </li>
                                                                                        <li class='star'
                                                                                            title='Excellent'
                                                                                            data-value='4'>
                                                                                            <i class='fa fa-star fa-fw'></i>
                                                                                        </li>
                                                                                        <li class='star' title='WOW!!!'
                                                                                            data-value='5'>
                                                                                            <i class='fa fa-star fa-fw'></i>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </dic>

                                                                    <div class="col-12 col-md-6">
                                                                        <input class="no-round-input" type="text"
                                                                               placeholder="Tên*">
                                                                    </div>
                                                                    <div class="col-12 col-md-6">
                                                                        <input class="no-round-input" type="text"
                                                                               placeholder="Email*">
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <textarea class="textarea-form" id="review"
                                                                                  name="" cols="30" rows="4"
                                                                                  placeholder="Nhận xét của bạn*"></textarea>
                                                                        <div id="comment-product" class="normal-btn">Gửi đi</div>
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

            $('#stars li').on('mouseover', function () {
                var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on

                // Now highlight all the stars that's not after the current hovered star
                $(this).parent().children('li.star').each(function (e) {
                    if (e < onStar) {
                        $(this).addClass('hover');
                    }
                    else {
                        $(this).removeClass('hover');
                    }
                });

            }).on('mouseout', function () {
                $(this).parent().children('li.star').each(function (e) {
                    $(this).removeClass('hover');
                });
            });


            /* 2. Action to perform on click */
            $('#stars li').on('click', function () {
                var onStar = parseInt($(this).data('value'), 10); // The star currently selected
                var stars = $(this).parent().children('li.star');

                for (i = 0; i < stars.length; i++) {
                    $(stars[i]).removeClass('selected');
                }

                for (i = 0; i < onStar; i++) {
                    $(stars[i]).addClass('selected');
                }

                // JUST RESPONSE (Not needed)
                var ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);
                var msg = "";
                if (ratingValue > 1) {
                    msg = "Thanks! You rated this " + ratingValue + " stars.";
                }
                else {
                    msg = "We will improve ourselves. You rated this " + ratingValue + " stars.";
                }
                responseMessage(msg);

            });

            function responseMessage(msg) {
                $('.success-box').fadeIn(200);
                $('.success-box div.text-message').html("<span>" + msg + "</span>");
            }

            $('#comment-product').on('click', function() {
                let url = $('#url-comment').val();
                return console.log(url);


                let id = $(this).closest('.product-select').attr('data-id');
                let product_name = $(this).closest('.product-select').attr('data-name');
                let product_price = $(this).closest('.product-select').attr('data-price');
                let product_discount_price = $(this).closest('.product-select').attr('data-discount_price');
                let quantity = $("#quantity").val();
                if (typeof quantity === 'undefined') {
                    quantity = 1;
                }
                let data = {
                    id: id, product_name: product_name,
                    product_price: product_price, product_discount_price: product_discount_price, quantity: quantity
                };

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
                        if (data.status === "success") {
                            $('.cart_money').text(new Intl.NumberFormat('ja-JP', {
                                style: 'currency',
                                currency: 'JPY'
                            }).format(data.total));
                            $('.cart_count').text(data.count);
                            $('.count_stock').text()
                            $('#modalAbandonedCart').modal('show')
                            setTimeout(function () {
                                $('#modalAbandonedCart').modal('hide')
                            }, 2000);
                        }
                    },
                    error: function (exception) {
                        alert('Exeption:' + exception);
                    }
                });
            });


        });



    </script>
@endpush
