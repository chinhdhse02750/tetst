@extends('layouts.shop')

@section('content')
    <div id="main">
        <div class="shop-layout">
            <div class="container">
                <div class="ogami-breadcrumb">
                    <div class="container">
                        <ul>
                            <li><a class="breadcrumb-link" href="index.html"> <i class="fas fa-home"></i>Home</a></li>
                            <li><a class="breadcrumb-link" href="index.html">Shop</a></li>
                            <li><a class="breadcrumb-link active" href="index.html">Shoping cart</a></li>
                        </ul>
                    </div>
                </div>
                <!-- End breadcrumb-->
                <div class="order-step">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="order-step_block">
                                    <div class="row no-gutters">
                                        <div class="col-12 col-md-4">
                                            <div class="step-block active">
                                                <div class="step">
                                                    <h2>Giỏ hàng</h2><span>01</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <div class="step-block">
                                                <div class="step">
                                                    <h2>Thông tin thanh toán</h2><span>02</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <div class="step-block">
                                                <div class="step">
                                                    <h2>Hoàn tất đặt hàng</h2><span>03</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End order step-->
                <div class="shopping-cart">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="product-table">
                                    <table class="table table-responsive">
                                        <colgroup>
                                            <col span="1" style="width: 15%">
                                            <col span="1" style="width: 30%">
                                            <col span="1" style="width: 15%">
                                            <col span="1" style="width: 15%">
                                            <col span="1" style="width: 15%">
                                            <col span="1" style="width: 10%">
                                        </colgroup>
                                        <thead>
                                        <tr>
                                            <th class="product-iamge" scope="col">Ảnh</th>
                                            <th class="product-name" scope="col">Sản phẩm</th>
                                            <th class="product-price" scope="col">Giá</th>
                                            <th class="product-quantity" scope="col">Số lượng</th>
                                            <th class="product-total" scope="col">Tạm tính</th>
                                            <th class="product-clear" scope="col">
                                                <button class="no-round-btn"><i class="icon_close"></i></button>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($cartCollection as $key => $value)
                                            <tr>
                                                <td class="product-iamge">
                                                    <div class="img-wrapper">
                                                        <img src="{{ url('storage/tmp/'.$value->associatedModel->first_image) }}"
                                                             alt="{{ $value->associatedModel->first_image }}">
                                                    </div>
                                                </td>
                                                <td class="product-name">{{ $value->name }}</td>
                                                <td class="product-price"> ¥{{ number_format($value->price) }}</td>
                                                <td class="product-quantity">
                                                    <input class="quantity no-round-input"
                                                           type="number" min="1" value="{{ $value->quantity }}">
                                                </td>
                                                <td class="product-total">
                                                    ¥{{ number_format((int)$value->quantity * $value->price) }}</td>
                                                <td class="product-clear">
                                                    <button class="no-round-btn"><i class="icon_close"></i></button>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-12 col-sm-8">
                                <div class="coupon">
                                    <form action="" method="post">
                                        <input class="no-round-input" type="text" placeholder="Mã khuyến mại">
                                        <button class="no-round-btn smooth">Áp dụng</button>
                                    </form>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4 text-right">
                                <button class="no-round-btn black cart-update">Cập nhật giỏ hàng</button>
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="col-12 col-md-6 col-lg-5">
                                <div class="cart-total_block">
                                    <h2>Cộng giỏ hàng</h2>
                                    <table class="table">
                                        <colgroup>
                                            <col span="1" style="width: 40%">
                                            <col span="1" style="width: 60%">
                                        </colgroup>
                                        <tbody>
                                        <tr>
                                            <th>Tạm tính</th>
                                            <td>¥{{ number_format($total) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Giao hàng</th>
                                            <td>
                                                <p>Nhập địa chỉ của bạn để xem các tùy chọn vận chuyển.</p>
                                                <a href="#" class="shipping-calculator-button">Điền địa chỉ</a>
                                            </td>
                                            {{--<section class="shipping-calculator-form" style="display: block;">--}}
                                                {{--<p class="form-row form-row-wide" id="calc_shipping_country_field">--}}
                                                    {{--<select name="calc_shipping_country" id="calc_shipping_country"--}}
                                                            {{--class="country_to_state country_select select2-hidden-accessible"--}}
                                                            {{--rel="calc_shipping_state" tabindex="-1" aria-hidden="true">--}}
                                                        {{--<option value="default">Select a country / region…</option>--}}
                                                        {{--<option value="JP">Nhật Bản</option>--}}
                                                    {{--</select><span--}}
                                                            {{--class="select2 select2-container select2-container--default"--}}
                                                            {{--dir="ltr" style="width: 100%;"><span class="selection"><span--}}
                                                                    {{--class="select2-selection select2-selection--single"--}}
                                                                    {{--aria-haspopup="true" aria-expanded="false"--}}
                                                                    {{--tabindex="0"--}}
                                                                    {{--aria-labelledby="select2-calc_shipping_country-container"--}}
                                                                    {{--role="combobox"><span--}}
                                                                        {{--class="select2-selection__rendered"--}}
                                                                        {{--id="select2-calc_shipping_country-container"--}}
                                                                        {{--role="textbox" aria-readonly="true"--}}
                                                                        {{--title="Select a country / region…">Select a country / region…</span><span--}}
                                                                        {{--class="select2-selection__arrow"--}}
                                                                        {{--role="presentation"><b role="presentation"></b></span></span></span><span--}}
                                                                {{--class="dropdown-wrapper"--}}
                                                                {{--aria-hidden="true"></span></span>--}}
                                                {{--</p>--}}

                                                {{--<p class="form-row form-row-wide" id="calc_shipping_state_field">--}}
                                                    {{--<input type="text" class="input-text" value=""--}}
                                                           {{--placeholder="Bang / Hạt" name="calc_shipping_state"--}}
                                                           {{--id="calc_shipping_state">--}}
                                                {{--</p>--}}

                                                {{--<p class="form-row form-row-wide" id="calc_shipping_city_field">--}}
                                                    {{--<input type="text" class="input-text" value=""--}}
                                                           {{--placeholder="Thành phố" name="calc_shipping_city"--}}
                                                           {{--id="calc_shipping_city">--}}
                                                {{--</p>--}}

                                                {{--<p class="form-row form-row-wide" id="calc_shipping_postcode_field">--}}
                                                    {{--<input type="text" class="input-text" value=""--}}
                                                           {{--placeholder="Mã bưu điện" name="calc_shipping_postcode"--}}
                                                           {{--id="calc_shipping_postcode">--}}
                                                {{--</p>--}}

                                                {{--<p>--}}
                                                    {{--<button type="submit" name="calc_shipping" value="1" class="button">--}}
                                                        {{--Cập nhật--}}
                                                    {{--</button>--}}
                                                {{--</p>--}}
                                                {{--<input type="hidden" id="woocommerce-shipping-calculator-nonce"--}}
                                                       {{--name="woocommerce-shipping-calculator-nonce"--}}
                                                       {{--value="0bba624c00"><input type="hidden" name="_wp_http_referer"--}}
                                                                                 {{--value="/cart/"></section>--}}
                                        </tr>
                                        <tr>
                                            <th>Tổng</th>
                                            <td>¥{{ number_format($total) }}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <div class="checkout-method">
                                        <button class="normal-btn">Tiến hành thanh toán</button>
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
@endsection
@push('script')
@endpush
