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
                <div class="order-step">
                    <div class="container">
                        @include('shop.step_menu')
                    </div>
                </div>
                <!-- End breadcrumb-->
                <div class="shop-success order-complete">
                    <div class="container">
                        <div class="col-12 justify-content-center align-items-center text-center">
                            <h1>Chúc mừng! Bạn vừa <span>đặt hàng </span>thành công.
                            </br>
                            <span>Chúng tôi sẽ liên lạc lại bạn theo thông tin liên hệ để xác nhận đơn hàng</span>
                            </br>
                            <span>Hà Nội Shop xin chân thành cám ơn!</span>
                            </h1>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="benefit-block">
                        <div class="our-benefits shadowless benefit-border">
                            <div class="row no-gutters">
                                <div class="col-12 col-md-6 col-lg-3">
                                    <div class="benefit-detail d-flex flex-column align-items-center">
                                        <img class="benefit-img" src="/images/benefit-icon1.png" alt="">
                                        <h5 class="benefit-title">Miễn phí ship hàng</h5>
                                        <p class="benefit-describle">Cho tất cả đơn hàng trên ￥9999</p>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-3">
                                    <div class="benefit-detail d-flex flex-column align-items-center">
                                        <img class="benefit-img" src="/images/benefit-icon2.png" alt="">
                                        <h5 class="benefit-title">Giao hàng</h5>
                                        <p class="benefit-describle">Giao hàng nhanh, rẻ , đúng hẹn</p>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-3">
                                    <div class="benefit-detail d-flex flex-column align-items-center">
                                        <img class="benefit-img" src="/images/benefit-icon3.png" alt="">
                                        <h5 class="benefit-title">Bảo mật thanh toán</h5>
                                        <p class="benefit-describle">100% bảo mật</p>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-3">
                                    <div class="benefit-detail boderless boderless d-flex flex-column align-items-center">
                                        <img class="benefit-img" src="/images/benefit-icon4.png" alt="">
                                        <h5 class="benefit-title">Hỗ trợ 24/7!</h5>
                                        <p class="benefit-describle">Hỗ trợ tận tâm</p>
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
                "country": {
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
                    "country" :{
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
