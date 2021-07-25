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
                                            <li class="menu-toggle menu-parent {{ ($alias == $menu->alias) ? 'active' : '' }}" >
                                                <a class="department-link link-parent"
                                                   href="{{ route('cate.view', $menu->alias) }}">{{ $menu->name }}</a>
                                                @if(count($menu->childrenCategories))
                                                    <span data-toggle="collapse"
                                                          data-target="#{{ $menu->alias }}"
                                                          class="collapsed text-truncate submenu-indicator">
                                                            {{--<i class="{{ ($menu->alias == $alias--}}
                                                            {{--|| $menu->childrenCategories->pluck('alias')->contains($alias))--}}
                                                            {{--? 'icon_plus' : 'icon_minus-06' }} "></i>--}}
                                                    </span>
                                                @endif
                                                @if(count($menu->childrenCategories))
                                                    @include('includes.menu_sub',
                                                    ['childs' => $menu->childrenCategories,
                                                     'target' => $menu->alias,
                                                     'pluck' => $menu->childrenCategories->pluck('alias')]
)
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
                                        <h5><i class="fas fa-bars"></i>Menu</h5>
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
                                        <input type="hidden" id="product_id" value="{{ $subData->id }}">
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

                                        @if($subData->stock == 0)
                                            <div class="product-select" data-id="{{ $subData->id }}"
                                                 data-name="{{ $subData->name }}" data-price="{{ $subData->price }}"
                                                 data-discount_price="{{ $subData->discount_price }}">
                                                <button class="normal-btn outline">Liên hệ chúng tôi</button>
                                            </div>
                                        @else
                                            <div class="product-select" data-id="{{ $subData->id }}"
                                                 data-name="{{ $subData->name }}" data-price="{{ $subData->price }}"
                                                 data-discount_price="{{ $subData->discount_price }}">
                                                <button class="add-to-cart normal-btn outline">@lang('product.label.add_to_cart')</button>
                                                <button class="add-to-compare normal-btn outline">+ Add to Compare</button>
                                            </div>
                                        @endif

                                        <div class="product-share">
                                            <h5>Chia sẻ:</h5><a href=""><i class="fab fa-facebook-f"> </i></a><a
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
                                                <li><a href="#tab-2">Đánh giá ({{ $countComment }})</a></li>
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
                                                    @if ($countComment == 0)
                                                        <div class="block-review">
                                                            <h3 class="reply-title">Hãy là người đầu tiên nhận xét
                                                                "{{ $subData->name }}"</h3>
                                                        </div>
                                                    @else
                                                        <div class="block-review">
                                                            @foreach($comments as $key => $value)
                                                                @if($value->status == 1)
                                                                    <div class="customer-review">
                                                                        <div class="row">
                                                                            <div class="col-12 col-sm-3 col-lg-2">
                                                                                <div class="customer-review_left">
                                                                                    <div class="customer-review_img text-center">
                                                                                        <img class="img-fluid"
                                                                                                src="/images/profile.png"
                                                                                                alt="customer image"></div>
                                                                                    <div class="customer-rate">
                                                                                        @for($i = 0; $i < $value->rating; $i++)
                                                                                            <i class="icon_star"></i>
                                                                                        @endfor
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-12 col-sm-9 col-lg-10">
                                                                                <div class="customer-comment">
                                                                                    <h5 class="comment-date">
                                                                                        {{\Carbon\Carbon::parse($value->created_at)->format('d/m/Y') }}</h5>
                                                                                    <h3 class="customer-name">{{ $value->name }}</h3>
                                                                                    <p class="customer-commented">{{ $value->description }} </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                    <div class="add-review">
                                                        <div class="add-review-status display-none">
                                                            <h2>Cảm ơn bạn đã gửi đánh giá, đánh giá của bạn sẽ được hiển thị sau khi kiểm duyệt.</h2>
                                                        </div>

                                                        <div class="add-review_top">
                                                            <h2>Đánh giá của bạn</h2>
                                                        </div>
                                                        <div class="add-review_bottom">
                                                            <form method="post" id="rate_form">
                                                                <div class="row">
                                                                    <div class="col-12">
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
                                                                            <input type="hidden" name="rate-star" id="rate_star">
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-12 col-md-6">
                                                                        <input class="no-round-input" type="text"
                                                                               name="rate_name" id="rate_name"
                                                                               placeholder="Tên*">
                                                                    </div>
                                                                    <div class="col-12 col-md-6">
                                                                        <input class="no-round-input" type="text"
                                                                               name="rate_email" id="rate_email"
                                                                               placeholder="Email*">
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <textarea class="textarea-form" id="rate_comment"
                                                                                  name="rate_comment" cols="30" rows="4"
                                                                                  placeholder="Nhận xét của bạn*"></textarea>
                                                                        <div id="comment-product" class="normal-btn">Gửi
                                                                            đi
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
    {!! script(('js/validator/jquery.validate.min.js')) !!}
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
                $("#rate_star").val(ratingValue);
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


            const message = {
                "rate_name": {
                    required: "Tên không được để trống",
                },
                "rate_comment": {
                    required: "Nội dung không được để trống",
                },
                "rate_email": {
                    required: 'Email không được để trống.',
                    email: "Sai định dạng email!",
                },
                "rate-star": {
                    required: 'Bạn chưa chọn số sao.',
                }
            };
            $('#rate_form').validate({
                ignore: [],
                rules: {
                    "rate_name": {
                        required: true,
                    },
                    "rate_email": {
                        required: true,
                        email: true
                    },
                    "rate_comment": {
                        required: true,
                    },
                    "rate-star" :{
                        required: true,
                    }
                },
                messages: message,
            });


            $('#comment-product').on('click', function () {
                if ($("#rate_form").valid()) {
                    let url = $('#url-comment').val();
                    let id = $('#product_id').val();
                    let name = $('#rate_name').val();
                    let email = $('#rate_email').val();
                    let comment = $('#rate_comment').val();
                    let star = $('#rate_star').val();

                    let data = {
                        product_id: id, name: name,
                        email: email, description: comment, rating: star
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
                                $(".add-review-status").removeClass('display-none');
                                $("#rate_star").val(0);
                                $('#rate_name').val('');
                                $('#rate_email').val('');
                                $('#rate_comment').val('');
                                $('.star').removeClass('selected');
                            }
                        },
                        error: function (exception) {
                            alert('Exeption:' + exception);
                        }
                    });
                }
            });
        });
    </script>
@endpush
