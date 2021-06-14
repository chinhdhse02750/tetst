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
                <div id="loader" class="display-none"></div>
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
                @if($count > 0)
                    <div class="shopping-cart">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="product-table">
                                    <table class="table table-responsive table-cart">
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
                                                <button class="no-round-btn" id="clear-cart"><i class="icon_close"></i></button>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($cartCollection as $key => $value)
                                            <tr class="row-product-{{ $value->id }}">
                                                <td class="product-iamge">
                                                    <div class="img-wrapper">
                                                        <img src="{{ url('storage/tmp/'.$value->associatedModel->first_image) }}"
                                                             alt="{{ $value->associatedModel->first_image }}">
                                                    </div>
                                                </td>
                                                <td class="product-name">{{ $value->name }}</td>
                                                <td class="product-price"><span>¥{{ number_format($value->price) }}</span></td>
                                                <td class="product-quantity">
                                                    <input class="quantity no-round-input change-input-quantity" data-id="{{ $value->id }}"
                                                           type="number" min="1" value="{{ $value->quantity }}">
                                                </td>
                                                <td class="product-total">
                                                    ¥<span class="price_{{$value->id}}">{{ number_format((int)$value->quantity * $value->price) }}</span></td>
                                                <td class="product-clear">
                                                    <button class="no-round-btn button-delete-product button-delete-product_{{ $value->id }}"
                                                            data-id="{{ $value->id }}">
                                                        <i class="icon_close"></i></button>
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
                                <a  href="{{ route('cate.view', 'tat-ca-san-pham') }}"
                                    class="no-round-btn black cart-update">Tiếp tục xem sản phẩm!
                                </a>
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
                                            <td class="all_product_price">¥<span>{{ number_format($total) }}</span></td>
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
                                            <td class="total_all_price">¥<span>{{ number_format($total) }}</span></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <div class="checkout-method">
                                        <a class="normal-btn" id="" href="{{ url('cart-checkout') }}">Tiến hành thanh toán</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                    <div class="text-empty-cart">Chưa có sản phẩm nào trong giỏ hàng.</div>
                    <div class="button-empty-cart">
                        <a  href="{{ route('cate.view', 'tat-ca-san-pham') }}"
                            class="no-round-btn black cart-update wc-forward">Quay trở lại cửa hàng</a>
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(document).ready(function () {
            $('#clear-cart').on('click', function () {
                console.log("cccc");
            });

            $('.button-delete-product').on('click', function() {
                let id = $(this).data("id");
                let url = "{{ url("api/v1/cart/delete-product/:id")  }}".replace(':id', id);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: {id: id},
                    success: function (data) {
                        console.log(data.total);
                        if(data.status === "success"){
                            $('.row-product-'+id).remove();
                            $('.all_product_price span').text(data.total);
                            $('.total_all_price span').text(data.total);
                        }
                    },
                    beforeSend: function(){
                        $('#loader').show();
                    },
                    complete: function(){
                        $('#loader').hide();
                    },
                    error: function (exception) {
                        alert('Exeption:' + exception);
                    }
                });
            });

            $('.change-input-quantity').bind('keyup change', function (e) {
                let qty = $(this).val();
                let id = $(this).data("id");
                let url = "{{ url("api/v1/cart/update-quantity/:id")  }}".replace(':id', id);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                if(qty > 0){
                    $.ajax({
                        type: 'POST',
                        url: url,
                        data: {id: id, quantity: qty },
                        success: function (data) {
                            if(data.status === "success"){
                                $('.price_'+id).text(data.product.price * data.product.quantity);
                                $('.all_product_price span').text(data.total);
                                $('.total_all_price span').text(data.total);
                            }
                        },
                        beforeSend: function(){
                            $('#loader').show();
                        },
                        complete: function(){
                            $('#loader').hide();
                        },
                        error: function (exception) {
                            alert('Exeption:' + exception);
                        }
                    });
                }else if(parseInt(qty) === 0){
                    $('.button-delete-product_'+id).trigger( "click" );
                }

            });

        });

    </script>
@endpush
