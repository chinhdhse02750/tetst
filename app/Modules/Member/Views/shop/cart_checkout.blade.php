@extends('layouts.shop')

@section('content')
    <div id="main">
        <div class="shop-layout">
            <div class="container">
                @include('shop.bread_crumb')
                <div id="loader" class="display-none"></div>
                <div class="order-step">
                    <div class="container">
                        @include('shop.step_menu')
                    </div>
                </div>
                <!-- End breadcrumb-->
                <div class="shop-checkout">
                    <div class="container">
                        <form method="post" id="form-order" action="{{ url('api/v1/cart/order') }}">
                            <div class="row">
                                <div class="col-12 col-lg-7">
                                    <h2 class="form-title">THÔNG TIN THANH TOÁN</h2>
                                    <p class="red" style="margin-bottom: 10px">Đánh dấu (*) là các trường bắt buộc</p>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputName">Họ và tên <span class="red">*</span></label>
                                            <input class="no-round-input-bg" name="full_name" id="inputName" type="text" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputFacebook">Tên Facebook</label>
                                            <input class="no-round-input-bg" name="facebook" id="inputFacebook" type="text"
                                                   placeholder="Bỏ trống nếu không dùng facebook">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputTel">Số điện thoại <span class="red">*</span></label>
                                        <input class="no-round-input-bg" name="phone" id="inputTel" type="text"
                                               placeholder="Nhập số điện thoại ở Nhật hoặc ở Việt Nam">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail">Email <span class="red">*</span></label>
                                        <input class="no-round-input-bg" name="email" id="inputEmail" type="text" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputAddress">Địa chỉ <span class="red">*</span></label>
                                        <input class="no-round-input-bg" name="address" id="inputAddress" type="text" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPostcode">Mã bưu điện: (VD: 544-0001 hoặc 5440001) *</label>
                                        <input class="no-round-input-bg" name="postcode" id="inputPostcode" type="text">
                                    </div>
                                    <div class="form-group select-city">
                                        <label for="inputCountry">Tỉnh - Thành Phố <span class="red">*</span></label>
                                        <select class="form-control no-round-input-bg" name="pref_id" id="select2-dropdown" required>
                                            @foreach($pref as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group select-city">
                                        <label for="inputTimeShipping">Thời gian giao hàng <span class="red">*</span></label>
                                        <select class="form-control no-round-input-bg" id="inputTimeShipping" name="time_shipping" id="select-time-dropdown" required>
                                            @foreach($selectTime as $key => $item)
                                                <option value="{{ $key }}">{{ $item }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    {{--<div class="form-group">--}}
                                        {{--<input id="differentAddress" type="checkbox">--}}
                                        {{--<label for="differentAddress">Giao hàng tới địa chỉ khác?</label>--}}
                                    {{--</div>--}}
                                    <div class="form-group">
                                        <label for="inputComment">Ghi chú đơn hàng (tùy chọn)</label>
                                        <textarea class="textarea-form-bg" id="inputComment" name="comment" cols="30" rows="7"></textarea>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-5" id="cart-information">
                                    <h2 class="form-title bold-price">ĐƠN HÀNG CỦA BẠN</h2>
                                    <div class="shopping-cart">
                                        <div class="cart-total_block">
                                            <table class="table">
                                                <colgroup>
                                                    <col span="1" style="width: 50%">
                                                    <col span="1" style="width: 50%">
                                                </colgroup>
                                                <tbody>
                                                @foreach($cartCollection as $key => $value)
                                                    <tr>
                                                        <th class="name">{{ $value->name }} × <span>{{ $value->quantity }}</span></th>
                                                        <td class="price bold-price" style="border-top: 0"> ￥<span>{{ number_format( $value->price) }}</span>
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <th class="bold-price">Tạm tính</th>
                                                    <td class="price bold-price"> ￥<span>{{ number_format($totalWtCondition) }}</span></td>
                                                </tr>
                                                <tr>
                                                    <th class="bold-price">Giao hàng</th>
                                                    @if(isset($shipping))
                                                        <td class="text-has-shipping">
                                                            <p class="text-card-shipping_2">Chuyển đến
                                                                <span class="bold-price">{{ ($shipping->getAttributes())['name'] }}: </span>
                                                                <span class="bold-price">￥{{ ($shipping->getValue()) }}</span>
                                                            </p>
                                                        </td>
                                                    @else
                                                        <td class="text-no-shipping">
                                                            <p class="text-card-shipping_2">Nhập địa chỉ của bạn để xem các tùy chọn vận chuyển</p>
                                                        </td>
                                                    @endif
                                                </tr>
                                                <tr class="daibiky_fee    @if(!isset($daibiky))display-none @endif">
                                                    <th class="bold-price">Phí Daibiki</th>
                                                    @if(isset($daibiky))
                                                        <td class="price bold-price"> ￥<span class="response_daibiky">{{ $daibiky->getValue() }}</span></td>
                                                    @else
                                                        <td class="price bold-price"> ￥<span class="response_daibiky"></span></td>
                                                    @endif
                                                </tr>
                                                <tr>
                                                    <th class="bold-price">Tổng</th>
                                                    <td class="price bold-price "> ￥<span class="total_price">{{ number_format($total) }}</span></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="payment">
                                            <div class="form-group reset-margin">
                                                <input type="radio" name="payment_method" id="cash-on" value="cash-on"  @if(isset($daibiky)) checked @endif>
                                                <label for="cash-on" class="title-text-payment">Trả tiền mặt khi nhận hàng</label>
                                                <p class="text-payment text-cash-on  @if(!isset($daibiky)) display-none @endif ">
                                                    Phí daibiki thay đổi theo số tiền thu hộ<br>
                                                    – Dưới 1 man: 330 yên<br>
                                                    – Trên 1 man: 440 yên<br>
                                                    Chuyển khoản ngân hàng sẽ không mất phí daibiki.</p>
                                            </div>
                                            <div class="form-group">
                                                <input type="radio" name="payment_method" id="bank-transfer" value="bank-transfer" @if(!isset($daibiky)) checked @endif>
                                                <label for="bank-transfer" class="title-text-payment">Thanh toán chuyển khoản</label>
                                                <p class="text-payment text-bank-transfer @if(isset($daibiky)) display-none @endif ">Khách hàng có thể chuyển khoản tại
                                                    Nhật qua ngân hàng bưu điện hoặc chuyển khoản qua tài khoản tại
                                                    Việt Nam là Techcombank (Tỉ giá tính theo giá SBI).
                                                    Vui lòng sử dụng Mã đơn hàng của bạn trong phần Nội dung thanh toán.
                                                    Đơn hàng sẽ đươc giao sau khi xác nhận đã chuyển tiền.</p>
                                            </div>
                                        </div>
                                        <div class="normal-btn submit-btn" id="button-checkout">ĐẶT HÀNG</div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.min.js"></script>
    {!! script(('js/validator/jquery.validate.min.js')) !!}
    <script>
        $(document).ready(function () {
            $('#clear-cart').on('click', function () {
                console.log("cccc");
            });

            $('#cash-on').on('change', function() {
                $('.text-cash-on').removeClass('display-none');
                $('.text-bank-transfer').addClass('display-none');
                let id = 'cash_on';
                let url = "{{ url("api/v1/cart/get-daibiki-shipping")}}";
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
                        if(data.status === "success"){
                            $('.daibiky_fee').removeClass('display-none');
                            $('.response_daibiky').text(data.daiBiKyFee);
                            $('.total_price').text(data.total);
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

            $('#bank-transfer').on('change', function() {
                $('.text-cash-on').addClass('display-none');
                $('.text-bank-transfer').removeClass('display-none');
                let id = 'bank';
                let url = "{{ url("api/v1/cart/get-daibiki-shipping")}}";
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
                        if(data.status === "success"){
                            $('.daibiky_fee').addClass('display-none');
                            $('.response_daibiky').text(data.daiBiKyFee);
                            $('.total_price').text(data.total);
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
            let id = {{ isset($shipping) ? ($shipping->getAttributes())['id'] : 0 }}
            $('#select2-dropdown').select2().val(id).trigger('change.select2');
            $('#select-time-dropdown').select2({
                    minimumResultsForSearch: -1
            });

            $('#select2-dropdown').on('select2:select', function (e) {
                let id = $("#select2-dropdown").val();
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
                            $('.text-card-shipping_2').text('Chuyển đến  ')
                                .append('<span class="bold-price">' + data.name + ': </span><span class="bold-price">￥' + data.shippingPrice + '</span>');
                            $('.total_price').text(data.total);
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


            const message = {
                "full_name": {
                    required: "Tên không được để trống",
                },
                "phone": {
                    required: "Số điện thoại không được để trống",
                },
                "email": {
                    required: 'Email không được để trống.',
                    email: "Sai định dạng email!",
                },
                "address": {
                    required: 'Bạn chưa điền địa chỉ giao hàng.',
                } ,
                "pref_id": {
                    required: 'Bạn chưa chọn Tỉnh - Thành phố.',
                }
            };
            $('#form-order').validate({
                ignore: [],
                rules: {
                    "full_name": {
                        required: true,
                    },
                    "phone": {
                        required: true,
                    },
                    "email": {
                        required: true,
                        email: true
                    },
                    "address": {
                        required: true,
                    },
                    "pref_id" :{
                        required: true,
                    },
                    "time_shipping" :{
                        required: true,
                    }
                },
                messages: message,
            });



            $('#button-checkout').on('click', function() {
                if ($("#form-order").valid()) {
                    let url = "{{ url("api/v1/cart/order")}}";
                    // stringify the parameter

                    let data = $("#form-order").serialize();
                    console.log(data);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        type: 'POST',
                        url: url,
                        data: {'data':data},
                        success: function (data) {
                            if(data.status === "success"){
                                window.location.href = "{{ route('cart.success')}}";
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
                }
            });
        });

    </script>
@endpush
