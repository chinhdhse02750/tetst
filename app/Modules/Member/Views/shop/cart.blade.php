@extends('layouts.shop')

@section('content')
    <div id="main">
        <div class="shop-layout">
            <div class="container">
                    @include('shop.bread_crumb')
                <div id="loader" class="display-none"></div>
                <!-- End breadcrumb-->
                <div class="order-step">
                    @include('shop.step_menu')
                </div>
                <!-- End order step-->
                @if($count > 0)
                    <div class="shopping-cart">
                        <div class="">
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
                                                    <button class="no-round-btn" id="clear-cart"><i
                                                                class="icon_close"></i></button>
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
                                                    <td class="product-price">
                                                        <span>￥{{ number_format($value->price) }}</span></td>
                                                    <td class="product-quantity">
                                                        <input class="quantity no-round-input change-input-quantity"
                                                               data-id="{{ $value->id }}"
                                                               type="number" min="1" value="{{ $value->quantity }}">
                                                    </td>
                                                    <td class="product-total">
                                                        <span class="price_{{$value->id}}">￥{{ number_format((int)$value->quantity * $value->price) }}</span>
                                                    </td>
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
                                <div class="col-12 col-sm-4 d-flex align-items-end text-center">
                                    <a href="{{ route('cate.view', 'tat-ca-san-pham') }}"
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
                                                <col span="1" style="width: 20%">
                                                <col span="1" style="width: 80%">
                                            </colgroup>
                                            <tbody>
                                            <tr>
                                                <th>Tạm tính</th>
                                                <td class="all_product_price bold-price"><span>￥{{ number_format($totalWithoutCondition) }}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Giao hàng</th>
                                                <td>
                                                    @if(isset($shipping))
                                                        @if($totalWithoutCondition >= 10000)
                                                            <p class="text-card-shipping_1">Bạn được miễn phí ship thường</p>
                                                        @else
                                                            <p class="text-card-shipping_1">Phí ship thường khi mua hàng
                                                                dưới ￥9.999:
                                                                <span class="bold-price">￥{{ $shipping->getValue() }}</span>
                                                            </p>
                                                        @endif

                                                        <p class="text-card-shipping_2">Vận chuyển đến:
                                                            <span class="bold-price">{{( $shipping->getAttributes())['name']}}</span>
                                                        </p>
                                                        <button class="shipping-calculator-button btn btn-link">Đổi địa chỉ</button>
                                                    @else
                                                        <p class="text-card-shipping_1">Nhập địa chỉ của bạn </p>
                                                        <p class="text-card-shipping_2">để xem các tùy chọn vận
                                                            chuyển.</p>
                                                        <button class="shipping-calculator-button btn btn-link">Điền địa
                                                            chỉ
                                                        </button>
                                                    @endif

                                                    <div class="shipping-calculator-form display-none">
                                                        <select class="form-row form-row-wide"
                                                                id="calc_shipping_state_field">
                                                            @foreach($pref as $item)
                                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                            @endforeach
                                                        </select>

                                                        <p class="form-row-wide" id="calc_shipping_city_field">
                                                            <input type="text" class="input-text" value=""
                                                                   placeholder="Thành phố" name="calc_shipping_city"
                                                                   id="calc_shipping_city">
                                                        </p>

                                                        <p class="form-row-wide" id="calc_shipping_postcode_field">
                                                            <input type="text" class="input-text" value=""
                                                                   placeholder="Mã bưu điện"
                                                                   name="calc_shipping_postcode"
                                                                   id="calc_shipping_postcode">
                                                        </p>

                                                        <p>
                                                        <div id="shipping-update"
                                                             class="button no-round-btn shiping-update">
                                                            Cập nhật
                                                        </div>
                                                        </p>
                                                    </div>
                                                </td>

                                            </tr>

                                            <tr>
                                                <th>Tổng</th>

                                                <td class="total_all_price bold-price">
                                                    @if(isset($daibiky))
                                                        <span>￥{{ number_format($total - $daibiky->getValue()) }}</span></td>
                                                    @else
                                                        <span>￥{{ number_format($total) }}</span></td>
                                                    @endif
                                            </tr>
                                            </tbody>
                                        </table>
                                        <div class="checkout-method">
                                            <a class="normal-btn" id="" href="{{ url('cart-checkout') }}">Tiến hành
                                                thanh toán</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="cart-empty display-none">
                        <div class="text-empty-cart">Chưa có sản phẩm nào trong giỏ hàng.</div>
                        <div class="button-empty-cart">
                            <a href="{{ route('cate.view', 'tat-ca-san-pham') }}"
                               class="no-round-btn black cart-update wc-forward">Quay trở lại cửa hàng</a>
                        </div>
                    </div>
                @else
                    <div class="cart-empty">
                        <div class="text-empty-cart">Chưa có sản phẩm nào trong giỏ hàng.</div>
                    </div>
                    <div class="button-empty-cart">
                        <a href="{{ route('cate.view', 'tat-ca-san-pham') }}"
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

            $('.button-delete-product').on('click', function () {
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
                        if (data.status === "success" && data.message) {
                            $('.shopping-cart').hide();
                            $('.cart-empty').removeClass('display-none');
                        } else {
                            if(data.totalWithoutCondition >= 10000){
                                $('.text-card-shipping_1').text('Bạn được miễn phí ship thường');
                            }else{
                                $('.text-card-shipping_1').text('Phí ship thường khi mua hàng dưới ¥9.999:  ')
                                    .append('<span class="bold-price">￥' + data.shipping + '</span>');
                            }

                            $('.cart_money').text(new Intl.NumberFormat('ja-JP', {
                                style: 'currency',
                                currency: 'JPY'
                            }).format(data.totalWithoutCondition));
                            $('.row-product-' + id).remove();
                            $('.all_product_price span').text((new Intl.NumberFormat('ja-JP', {
                                style: 'currency',
                                currency: 'JPY'
                            }).format(data.totalWithoutCondition)));
                            $('.total_all_price span').text((new Intl.NumberFormat('ja-JP', {
                                style: 'currency',
                                currency: 'JPY'
                            }).format(data.total - data.daiBiKyFee)));
                        }
                    },
                    beforeSend: function () {
                        $('#loader').show();
                    },
                    complete: function () {
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
                if (qty > 0) {
                    $.ajax({
                        type: 'POST',
                        url: url,
                        data: {id: id, quantity: qty},
                        success: function (data) {
                            if (data.status === "success") {
                                if(data.totalWithoutCondition >= 10000){
                                    $('.text-card-shipping_1').text('Bạn được miễn phí ship thường');
                                }else{
                                    $('.text-card-shipping_1').text('Phí ship thường khi mua hàng dưới ¥9.999:  ')
                                        .append('<span class="bold-price">￥' + data.shipping + '</span>');
                                }

                                $('.cart_money').text(new Intl.NumberFormat('ja-JP', {
                                    style: 'currency',
                                    currency: 'JPY'
                                }).format(data.totalWithoutCondition));
                                $('.price_' + id).text((new Intl.NumberFormat('ja-JP', {
                                    style: 'currency',
                                    currency: 'JPY'
                                }).format(data.product.price * data.product.quantity)));
                                $('.all_product_price span').text((new Intl.NumberFormat('ja-JP', {
                                    style: 'currency',
                                    currency: 'JPY'
                                }).format(data.totalWithoutCondition)));
                                $('.total_all_price span').text((new Intl.NumberFormat('ja-JP', {
                                    style: 'currency',
                                    currency: 'JPY'
                                }).format(data.total - data.daiBiKyFee)));
                            }
                        },
                        beforeSend: function () {
                            $('#loader').show();
                        },
                        complete: function () {
                            $('#loader').hide();
                        },
                        error: function (exception) {
                            alert('Exeption:' + exception);
                        }
                    });
                } else if (parseInt(qty) === 0) {
                    $('.button-delete-product_' + id).trigger("click");
                }

            });

            let id = {{ isset($shipping) ? ($shipping->getAttributes())['id'] : 0 }}
            $('#calc_shipping_state_field').select2().val(id).trigger('change.select2');
            $('.shipping-calculator-button').on('click', function () {
                $('.shipping-calculator-form').toggle("linear");
            });

            $('#shipping-update').on('click', function () {
                let id = $("#calc_shipping_state_field").val();
                let url = "{{ url("api/v1/cart/get-fee-shipping/:id")  }}".replace(':id', id);
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
                        if (data.status === "success") {
                            if(data.totalNotFormat >= 10000){
                                $('.text-card-shipping_1').text('Bạn được miễn phí ship thường');
                            }else{
                                $('.text-card-shipping_1').text('Phí ship thường khi mua hàng dưới ￥9.999:  ')
                                    .append('<span class="bold-price">￥' + data.price + '</span>');
                            }

                            $('.text-card-shipping_2').text('Vận chuyển đến:  ')
                                .append('<span class="bold-price">' + data.name + '</span>');
                            $('.shipping-calculator-button').text('Đổi địa chỉ');
                            $('.all_product_price span').text(data.totalWithoutCondition);
                            $('.total_all_price span').text(data.total);
                        }
                    },
                    beforeSend: function () {
                        $('#loader').show();
                    },
                    complete: function () {
                        $('#loader').hide();
                    },
                    error: function (exception) {
                        alert('Exeption:' + exception);
                    }
                });
            });
        });

    </script>
@endpush
