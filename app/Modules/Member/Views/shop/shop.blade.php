@extends('layouts.shop')

@section('content')
    <div id="main">
        <div class="ogami-breadcrumb">
            <div class="container">
                <ul>
                    <li><a class="breadcrumb-link" href="index.html"> <i class="fas fa-home"></i>Home</a></li>
                    <li><a class="breadcrumb-link active" href="index.html">Shop</a></li>
                </ul>
            </div>
        </div>
        <!-- End breadcrumb-->
        <div class="shop-layout">
            <div class="container">
                <div class="row">
                    <div class="col-xl-3">
                        <div class="shop-sidebar">
                            <button class="no-round-btn" id="filter-sidebar--closebtn">Close sidebar</button>
                            <div class="shop-sidebar_department">
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
                            <div class="shop-sidebar_price-filter">
                                <div class="price-filter_top mini-tab-title underline">
                                    <h2 class="title">Filter By Price</h2>
                                </div>
                                <div class="price-filter_bottom">
                                    <label for="amount">Price range:</label>
                                    <div class="filter-group">
                                        <input id="amount" type="text" readonly="">
                                        <button class="normal-btn">Fiter</button>
                                    </div>
                                    <div id="slider-range"></div>
                                </div>
                            </div>
                            <div class="shop-sidebar_color-filter">
                                <div class="color-filter_top mini-tab-title underline">
                                    <h2 class="title">Color</h2>
                                </div>
                                <div class="color-filter_bottom">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="color">
                                                <div class="visible-color" style="background-color: black;"></div>
                                                <a href="shop_grid+list_3col.html">Black (12)</a>
                                            </div>
                                            <div class="color">
                                                <div class="visible-color" style="background-color: red;"></div>
                                                <a href="shop_grid+list_3col.html">Red (4)</a>
                                            </div>
                                            <div class="color">
                                                <div class="visible-color" style="background-color: orange;"></div>
                                                <a href="shop_grid+list_3col.html">Orange (8)</a>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="color">
                                                <div class="visible-color" style="background-color: blue;"></div>
                                                <a href="shop_grid+list_3col.html">Blue (4)</a>
                                            </div>
                                            <div class="color">
                                                <div class="visible-color" style="background-color: green;"></div>
                                                <a href="shop_grid+list_3col.html">Green (9)</a>
                                            </div>
                                            <div class="color">
                                                <div class="visible-color" style="background-color: pink;"></div>
                                                <a href="shop_grid+list_3col.html">Pink (12)</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="shop-sidebar_size">
                                <div class="size_top mini-tab-title underline">
                                    <h2 class="title">Popular size</h2>
                                </div>
                                <div class="size_bottom">
                                    <form>
                                        <div class="size">
                                            <input type="checkbox" id="large">
                                            <label for="large">Large</label>
                                        </div>
                                        <div class="size">
                                            <input type="checkbox" id="medium">
                                            <label for="medium">Medium</label>
                                        </div>
                                        <div class="size">
                                            <input type="checkbox" id="small">
                                            <label for="small">Small</label>
                                        </div>
                                        <div class="size">
                                            <input type="checkbox" id="tiny">
                                            <label for="tiny">Tiny</label>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="shop-sidebar_tag">
                                <div class="tag_top mini-tab-title underline">
                                    <h2 class="title">Product tag</h2>
                                </div>
                                <div class="tag_bottom"><a class="tag-btn" href="shop_grid+list_3col.html">organic</a><a
                                        class="tag-btn" href="shop_grid+list_3col.html">vegatable</a><a class="tag-btn"
                                                                                                        href="shop_grid+list_3col.html">fruits</a><a
                                        class="tag-btn" href="shop_grid+list_3col.html">fresh meat</a><a class="tag-btn"
                                                                                                         href="shop_grid+list_3col.html">fastfood</a><a
                                        class="tag-btn" href="shop_grid+list_3col.html">natural</a></div>
                            </div>
                        </div>
                        <div class="filter-sidebar--background" style="display: none"></div>
                    </div>
                    <div class="col-xl-9">
                        <div class="shop-grid-list">
                            <div class="shop-products">
                                <div class="shop-products_top mini-tab-title underline">
                                    <div class="row align-items-center">
                                        <div class="col-6 col-xl-4">
                                            <h2 class="title">Shop Grid 03 Col</h2>
                                        </div>
                                        <div class="col-6 text-right">
                                            <div id="show-filter-sidebar">
                                                <h5><i class="fas fa-bars"></i>Show sidebar</h5>
                                            </div>
                                        </div>
                                        <div class="col-12 col-xl-8">
                                            <div class="product-option">
                                                <form action="{{ route('shop.view', 'tat-ca-san-pham') }}" method="GET" id="sort_product">
                                                    <div class="product-filter">
                                                        <select class="select-form" name="order_by">
                                                            <option value="create_at">Thứ tự mặc định</option>
                                                            <option value="name">A to Z</option>
                                                            <option value="name-desc">Z to A</option>
                                                            <option value="price">Thứ tự theo giá: Thấp đến cao</option>
                                                            <option value="price-desc">Thứ tự theo giá: Cao xuống thấp
                                                            </option>
                                                        </select>
                                                        {{--                                                        <select class="select-form" id="sort" name="">--}}
                                                        {{--                                                            <option value="A-Z">Show 10</option>--}}
                                                        {{--                                                            <option value="Z-A">Show 20</option>--}}
                                                        {{--                                                            <option value="High to low price">Show 30</option>--}}
                                                        {{--                                                        </select>--}}
                                                    </div>
                                                </form>
                                                <div class="view-method">
                                                    <p class="active" id="grid-view"><i class="fas fa-th-large"></i></p>
                                                    <p id="list-view"><i class="fas fa-list"></i></p>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <!--Using column-->
                                </div>
                                <div class="shop-products_bottom">
                                    <div class="row no-gutters-sm">
                                        @foreach($products as $key => $value)
                                            <div class="col-6 col-md-4">
                                                <div class="product pink"><a class="product-img"
                                                                             href="shop_detail.html"><img
                                                            src="{{ url('storage/tmp/'.$value->first_image) }}"
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
                                        @endforeach
                                    </div>
                                </div>
                                <div class="shop-pagination">
                                    <ul>
                                        <li>
                                            <button class="no-round-btn smooth active">1</button>
                                        </li>
                                        <li>
                                            <button class="no-round-btn smooth">2</button>
                                        </li>
                                        <li>
                                            <button class="no-round-btn smooth">3</button>
                                        </li>
                                        <li>
                                            <button class="no-round-btn smooth"><i class="arrow_carrot-2right"></i>
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
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
        });

    </script>
@endpush
