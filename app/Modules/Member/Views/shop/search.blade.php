@extends('layouts.shop')

@section('content')
    <div id="main">
    {!! Breadcrumbs::render('home') !!}
    <!-- End breadcrumb-->
        <div class="shop-layout">
            <div class="container">
                <div class="row">
                    <div class="col-xl-3">
                        <div class="shop-sidebar">

                            <button class="no-round-btn" id="filter-sidebar--closebtn">Close sidebar</button>
                            <div class="shop-sidebar_department">
                                <div class="department_top mini-tab-title underline">
                                    <h2 class="title">Danh mục sản phẩm</h2>
                                </div>
                                <div class="department_bottom">
                                    <ul class="ul-parent">
                                        @foreach($allCategories as $menu)
                                            <li class="menu-toggle menu-parent">
                                                <a class="department-link link-parent"
                                                   href="{{ route('cate.view', $menu->alias) }}">{{ $menu->name }}</a>
                                                @if(count($menu->childrenCategories))
                                                    <span data-toggle="collapse"
                                                          data-target="#{{ $menu->alias }}"
                                                          class="collapsed text-truncate submenu-indicator">
                                                            <i class="icon_minus-06"></i></span>
                                                @endif
                                                @if(count($menu->childrenCategories))
                                                    @include('includes.menu_sub_search',
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


                            <form action="{{ route('search') }}" method="GET"
                                  id="filter_price">
                                <div class="shop-sidebar_price-filter">
                                    <div class="price-filter_top mini-tab-title underline">
                                        <h2 class="title">Lọc theo giá</h2>
                                    </div>
                                    <div class="price-filter_bottom">
                                        <label for="amount">Khoảng giá:</label>
                                        <div class="filter-group">
                                            <input id="amount" type="text" readonly="">
                                            <button class="normal-btn">Lọc</button>
                                        </div>
                                        <div id="slider-range"></div>
                                        <input type="hidden" id="max-price" value="{{ $maxPrice }}">
                                        <input type="hidden" id="min-price" value="{{ $minPrice }}">
                                        @foreach($data as $key => $value)
                                            @if($key != "min-price" && $key != "max-price")
                                                <input type='hidden' name='{{ $key }}' value='{{ $value }}'/>
                                            @endif
                                        @endforeach
                                        <input type="hidden" name="min-price" id="filter-min-price"
                                               value="{{ isset($data['min-price']) ? $data['min-price'] : 0 }}">
                                        <input type="hidden" name="max-price" id="filter-max-price"
                                               value="{{ isset($data['max-price']) ? $data['max-price'] : $maxPrice }}">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="filter-sidebar--background" style="display: none"></div>
                    </div>
                    <div class="col-xl-9">
                        <input type="hidden" value="{{ url('api/v1/product/cart') }} " id="url-cart">
                        <input type="hidden" value="{{ url('/review') }} " id="url-view">
                        <div class="shop-grid-list">
                            <div class="shop-products">
                                <div class="shop-products_top mini-tab-title underline">
                                    <div class="row align-items-center">
                                        <div class="col-6 col-xl-4">
                                            <h2 class="title">Kết quả tìm kiếm cho " {{ $data['search'] }} "</h2>
                                        </div>
                                        <div class="col-6 text-right">
                                            <div id="show-filter-sidebar">
                                                <h5><i class="fas fa-bars"></i>Show sidebar</h5>
                                            </div>
                                        </div>
                                        <div class="col-12 col-xl-8">
                                            <div class="product-option product-option-custom">
                                                <form action="" method="GET"
                                                      id="sort_product">
                                                    @foreach( $data as $key => $value)
                                                        @if($key != "order_by")
                                                            <input type='hidden' name='{{ $key }}'
                                                                   value='{{ $value }}'/>
                                                        @endif
                                                    @endforeach
                                                    <div class="product-filter">
                                                        <select class="select-form select-custom" name="order_by">
                                                            <option @if(isset($data['order_by']) && $data['order_by'] === 'create_at') selected
                                                                    @endif
                                                                    value="create_at">Thứ tự mặc định
                                                            </option>
                                                            <option @if(isset($data['order_by']) && $data['order_by'] === 'name') selected
                                                                    @endif
                                                                    value="name">Thứ tự theo tên: A đến Z
                                                            </option>
                                                            <option @if(isset($data['order_by']) && $data['order_by'] === 'name-desc') selected
                                                                    @endif
                                                                    value="name-desc">Thứ tự theo tên: Z đến A
                                                            </option>
                                                            <option @if(isset($data['order_by']) && $data['order_by'] === 'price') selected
                                                                    @endif
                                                                    value="price">Thứ tự theo giá: Thấp đến cao
                                                            </option>
                                                            <option @if(isset($data['order_by']) && $data['order_by'] === 'price-desc') selected
                                                                    @endif
                                                                    value="price-desc">Thứ tự theo giá: Cao xuống thấp
                                                            </option>
                                                        </select>
                                                        {{--<select class="select-form" id="select_paginate" name="per_page">--}}
                                                        {{--<option @if(isset($data['page']) && $data['page'] === '10') selected @endif--}}
                                                        {{--value="1">Hiển thị 15</option>--}}
                                                        {{--<option  @if(isset($data['page']) && $data['page'] === '20') selected @endif--}}
                                                        {{--value="2">Hiển thị 60</option>--}}
                                                        {{--<option @if(isset($data['page']) && $data['page'] === '30') selected @endif--}}
                                                        {{--value="3">Hiển thị 90</option>--}}
                                                        {{--</select>--}}
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Using column-->
                                </div>
                                @if($products->count()  !== 0 )
                                    <div class="shop-products_bottom">
                                        <div class="row no-gutters-sm">
                                            @foreach($products as $key => $value)
                                                <div class="col-6 col-md-3">
                                                    <div class="product pink">
                                                        <a class="product-img"
                                                           href="{{ route('product.detail', ['product' => $value->alias]) }}">
                                                            <img src="{{ url('storage/tmp/'.$value->first_image) }}"
                                                                 alt="{{ $value->first_image }}"></a>
                                                        <h3 class="product-name">{{ $value->name }}</h3>
                                                        @if($value->discount_price !== null)
                                                            <h3 class="product-price">
                                                                ¥{{ number_format($value->discount_price) }}
                                                                <del>¥{{ number_format($value->price) }}</del>
                                                            </h3>
                                                        @else
                                                            <h3 class="product-price">
                                                                ¥{{ number_format($value->price) }} </h3>
                                                        @endif

                                                        @if($value->stock == 0)
                                                            <div class="out-of-stock-label">Hết hàng</div>
                                                        @else
                                                            <div class="product-select" data-id="{{ $value->id }}"
                                                                 data-name="{{ $value->name }}"
                                                                 data-price="{{ $value->price }}"
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
                                                        @endif
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    {{ $products->appends(request()->except('page'))->render('pagination.link') }}
                                @else
                                    <div class="col-12">
                                        <p>Không tìm thấy sản phẩm nào khớp với lựa chọn của bạn.</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                        @include('shop.modal_add_success')
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
@push('script')
    <script>
        $(document).ready(function () {
            $('#sort_product').on('change', function () {
                $('#sort_product').submit();
            });

            // $('.sort_product').on('submit',function(e){
            //     e.preventDefault();
            //     let formData=$(this).serialize();
            //     let fullUrl = window.location.href;
            //     window.location.href = fullUrl+"&"+formData;
            // })
        });
    </script>
@endpush
