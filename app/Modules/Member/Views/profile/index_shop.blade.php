@extends('layouts.shop')

@section('title', app_name() . ' | ' . __('title.member.detail'))

@section('content')
    <div class="ogami-breadcrumb">
        <div class="container">
            <ul>
                <li><a class="breadcrumb-link" href="{{ route('home') }}"> <i class="fas fa-home"></i>Trang chủ</a></li>
                <li><a class="breadcrumb-link active" >Thông tin tài khoản</a></li>
            </ul>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xl-3 border-side-menu">
                @include('profile.sidebar_profile')
            </div>
            <div class="col-xl-9">
                <div class="mx-auto">
                    <form id="memberForm">
                        <div class="balance-title">
                            <div class="department_top mini-tab-title underline">
                                <h2 class="title">Thông tin đăng ký</h2>
                            </div>
                            <div class="detail__balance--description">
                                <span>Cập nhật thông tin đăng ký đễ tiện cho việc mua hàng hơn!</span>
                            </div>
                        </div>
                        <fieldset>
                            <legend>Thông tin bắt buộc</legend>
                            <p class="form-group form-row form-row-first">
                                <label for="account_uuid">ID tài khoản </label>
                                <input type="text" class="input-text form-control" disabled
                                       id="account_uuid" value="{{ $user->uuid }}">
                            </p>

                            <p class="form-group form-row form-row-last">
                                <label for="registed_date">Ngày tham gia </label>
                                <input type="text" class="input-text form-control" disabled
                                       id="registed_date" value="{{ date('d-m-Y', strtotime($user->created )) }}">
                            </p>

                            <p class="form-group form-row form-row-first">
                                <label for="account_full_name">Họ và Tên </label>
                                <input type="text" class="input-text form-control" disabled
                                       id="account_full_name" value="{{ $user->name }}">
                            </p>

                            <p class="form-group form-row form-row-last">
                                <label for="account_email">Email </label>
                                <input type="text" class="input-text form-control" disabled
                                       id="account_email" value="{{ $user->email }}">
                            </p>
                        </fieldset>

                        <fieldset>
                            <legend>Thông tin cá nhân</legend>
                            <p class="form-group form-row form-row-thirds">
                                <label for="phone">Số điện thoại</label>
                                <input type="text" class="input-text form-control phone" name="phone" id="phone"
                                       value="{{ isset($user->userProfile->phone)?  $user->userProfile->phone : "" }}">
                            </p>

                            <p class="form-group form-row form-row-thirds">
                                <label for="facebook">Tên facebook</label>
                                <input type="text" class="input-text form-control facebook" name="facebook" id="facebook"
                                       value="{{ isset($user->userProfile->facebook)?  $user->userProfile->facebook : "" }}">
                            </p>
                        </fieldset>

                        <fieldset>
                            <legend>Thông tin địa chỉ ship hàng</legend>
                            <p class="form-group form-row form-row-thirds">
                                <label for="address">Địa chỉ</label>
                                <input type="text" class="input-text form-control address" name="address" id="address"
                                       value="{{ isset($user->userProfile->address)?  $user->userProfile->address : "" }}">
                            </p>
                            <p class="form-group form-row form-row-thirds">
                                <label for="postcode">Mã bưu điện: (VD: 544-0001 hoặc 5440001) </label>
                                <input type="text" class="input-text form-control postcode" name="postcode" id="postcode"
                                       value="{{ isset($user->userProfile->postcode)?  $user->userProfile->postcode : "" }}">
                            </p>
                            <p class="form-group form-row form-row-thirds">
                                <label for="postcode">Tỉnh - Thành Phố</label>
                                <select class="form-control no-round-input-bg pref_id" name="pref_id" id="pref_id" required>
                                    <option value="0">Lựa chọn tỉnh - thành phố</option>
                                    @foreach($pref as $item)
                                        <option value="{{ $item->id }}" @if($user->userProfile->pref_id == $item->id) selected @endif>
                                            {{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </p>
                            <p class="form-group form-row form-row-thirds">
                                <label for="postcode">Lựa chọn thời gian giao hàng</label>
                                <select class="form-control no-round-input-bg time_shipping" id="time_shipping" name="time_shipping" id="select-time-dropdown" required>
                                    @foreach($selectTime as $key => $item)
                                        <option @if($user->userProfile->time_shipping == $key) selected @endif
                                                value="{{ $key }}">{{ $item }}</option>
                                    @endforeach
                                </select>
                            </p>
                        </fieldset>


                        <fieldset>
                            <div class="form-group mb-5">
                                <div class="d-flex justify-content-center">
                                    <input type="button" class="btn btn-outline-secondary btn-change-password"
                                           id="btn-change-profile"
                                           value="Thay Đổi"/>
                                    <input type="hidden" id="url-change-profile" value="{{ route('profile.update') }}">
                                </div>
                            </div>
                        </fieldset>


                        <div class="modal fade" id="edit-profile-success" tabindex="-1" role="dialog"
                             aria-labelledby="confirm-modal-change-password" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title"
                                            id="confirm-modal-change-password">Đăng ký thành công!</h6>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body gray mb-5">
                                        <p>Thông tin cá nhân của bạn đã đăng ký thành công.</p>
                                        <br>
                                        <p>Bạn có thể tiếp tục mua sắm.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- End account-->
    {{--<div class="partner">--}}
        {{--<div class="container">--}}
            {{--<div class="partner_block d-flex justify-content-between" data-slick="{&quot;slidesToShow&quot;: 6}">--}}
                {{--<div class="partner--logo" href=""><a href="#"><img src="/images/partner/partner_01.png"--}}
                                                                    {{--alt="partner logo"></a></div>--}}
                {{--<div class="partner--logo" href=""><a href="#"><img src="/images/partner/partner_02.png"--}}
                                                                    {{--alt="partner logo"></a></div>--}}
                {{--<div class="partner--logo" href=""><a href="#"><img src="/images/partner/partner_01.png"--}}
                                                                    {{--alt="partner logo"></a></div>--}}
                {{--<div class="partner--logo" href=""><a href="#"><img src="/images/partner/partner_02.png"--}}
                                                                    {{--alt="partner logo"></a></div>--}}
                {{--<div class="partner--logo" href=""><a href="#"><img src="/images/partner/partner_01.png"--}}
                                                                    {{--alt="partner logo"></a></div>--}}
                {{--<div class="partner--logo" href=""><a href="#"><img src="/images/partner/partner_02.png"--}}
                                                                    {{--alt="partner logo"></a></div>--}}
                {{--<div class="partner--logo" href=""><a href=""><img src="/images/partner/partner_01.png"--}}
                                                                   {{--alt="partner logo"></a></div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
@endsection

@section('custom_script')
    <script>
        let locate = '{{ config('app.locale') }}';
    </script>
    {!! script(('js/validator/jquery.validate.min.js')) !!}
    {!! script(('js/profile.js')) !!}
@stop
