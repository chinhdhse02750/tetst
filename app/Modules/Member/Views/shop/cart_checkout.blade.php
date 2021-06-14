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

                <div class="order-step">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="order-step_block">
                                    <div class="row no-gutters">
                                        <div class="col-12 col-md-4">
                                            <div class="step-block ">
                                                <div class="step">
                                                    <h2>Giỏ hàng</h2><span>01</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <div class="step-block active">
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
                <!-- End breadcrumb-->
                <div class="shop-checkout">
                    <div class="container">
                        <form action="" method="post">
                            <div class="row">
                                <div class="col-12 col-lg-8">
                                    <h2 class="form-title">THÔNG TIN THANH TOÁN</h2>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputFirstName">Họ và tên *</label>
                                            <input class="no-round-input-bg" id="inputFirstName" type="text" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputLastName">Tên Facebook *</label>
                                            <input class="no-round-input-bg" id="inputLastName" type="text" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputCompanyName">Số điện thoại:</label>
                                        <span class="red">(Khách hàng có thể nhập sđt tại Nhật hoặc dùng sđt đăng ký facebook tại Việt Nam) *</span>
                                        <input class="no-round-input-bg" id="inputCompanyName" type="text">
                                    </div>

                                    <div class="form-group">
                                        <label for="inputStreet">Địa chỉ *</label>
                                        <input class="no-round-input-bg" id="inputStreet" type="text" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputZip">Mã bưu điện: (VD: 544-0001 hoặc 5440001) *</label>
                                        <input class="no-round-input-bg" id="inputZip" type="text">
                                    </div>
                                    <div class="form-group select-city">
                                        <label for="inputCity">Tỉnh - Thành Phố *</label>
                                        <select class="form-control no-round-input-bg" id="select2-dropdown" required>
                                            @foreach($pref as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group select-city">
                                        <label for="inputCity">Thời gian giao hàng *</label>
                                        <select class="form-control no-round-input-bg" id="select-time-dropdown" required>
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
                                        <label for="inputNote">Ghi chú đơn hàng (tùy chọn)</label>
                                        <textarea class="textarea-form-bg" id="inputNote" name="" cols="30" rows="7"></textarea>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-4" id="cart-information">
                                    <h2 class="form-title">ĐƠN HÀNG CỦA BẠN</h2>
                                    <div class="shopping-cart">
                                        <div class="cart-total_block">
                                            <table class="table">
                                                <colgroup>
                                                    <col span="1" style="width: 50%">
                                                    <col span="1" style="width: 50%">
                                                </colgroup>
                                                <tbody>
                                                <tr>
                                                    <th class="name">Australian Kiwi × <span>1</span></th>
                                                    <td class="price black" style="border-top: 0">$169.00</td>
                                                </tr>
                                                <tr>
                                                    <th>TẠM TÍNH</th>
                                                    <td class="price">$169.00</td>
                                                </tr>
                                                <tr>
                                                    <th>GIAO HÀNG</th>
                                                    <td>
                                                        <p>Free shipping</p>
                                                        <p>Calculate shipping</p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>TỔNG</th>
                                                    <td class="total">$169.00</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="payment">
                                            <div class="form-group reset-margin">
                                                <input type="radio" name="paymethod" id="cash-on" value="option1">
                                                <label for="cash-on" class="title-text-payment">Trả tiền mặt khi nhận hàng</label>
                                                <p class="text-payment text-cash-on display-none">Phí daibiki thay đổi theo số tiền thu hộ<br>
                                                    – Dưới 1 man: 330 yên<br>
                                                    – Trên 1 man: 440 yên<br>
                                                    Chuyển khoản ngân hàng sẽ không mất phí daibiki.</p>
                                            </div>
                                            <div class="form-group">
                                                <input type="radio" name="paymethod" id="bank-transfer" value="option2" checked>
                                                <label for="bank-transfer" class="title-text-payment">Thanh toán chuyển khoản</label>
                                                <p class="text-payment text-bank-transfer">Khách hàng có thể chuyển khoản tại
                                                    Nhật qua ngân hàng bưu điện hoặc chuyển khoản qua tài khoản tại
                                                    Việt Nam là Techcombank (Tỉ giá tính theo giá SBI).
                                                    Vui lòng sử dụng Mã đơn hàng của bạn trong phần Nội dung thanh toán.
                                                    Đơn hàng sẽ đươc giao sau khi xác nhận đã chuyển tiền.</p>
                                            </div>
                                        </div>
                                        <button class="normal-btn submit-btn" id="button-checkout">ĐẶT HÀNG</button>
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
    <script>
        $(document).ready(function () {
            $('#clear-cart').on('click', function () {
                console.log("cccc");
            });

            $('#cash-on').on('change', function() {
                $('.text-cash-on').removeClass('display-none');
                $('.text-bank-transfer').addClass('display-none');
            });

            $('#bank-transfer').on('change', function() {
                $('.text-cash-on').addClass('display-none');
                $('.text-bank-transfer').removeClass('display-none');
            });

            $('#select2-dropdown').select2();
            $('#select-time-dropdown').select2({
                    minimumResultsForSearch: -1
            });


            $('#button-checkout').on('click', function() {
                let id = $(this).data("id");
                let url = "{{ url("api/v1/cart/order")}}";

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
            // $('#select2-dropdown').on('change', function (e) {
            //     var data = $('#select2-dropdown').select2("val");
            // @this.set('ottPlatform', data);
            // });

        });

    </script>
@endpush
