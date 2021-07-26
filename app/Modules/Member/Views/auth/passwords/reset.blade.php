@extends('layouts.shop')

@section('content')
    <div id="main">
        <!-- End header-->
        <div class="ogami-breadcrumb">
            <div class="container">
                <ul>
                    <li><a class="breadcrumb-link" href="{{ route('home') }}"> <i class="fas fa-home"></i>Trang chủ</a></li>
                    <li><a class="breadcrumb-link active" >Đăng ký</a></li>
                </ul>
            </div>
        </div>
        <!-- End breadcrumb-->
        <div class="account">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-6 mx-auto">
                        <h1 class="title">Cập nhật mật khẩu</h1>
                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="form-group">
                                <div class="form-input">
                                    <label for="user-name">Email *</label>
                                    <input
                                        id="email"
                                        type="email"
                                        class="no-round-input form-control form-input__username @error('email') is-invalid @enderror"
                                        name="email"
                                        value="{{ $email ?? old('email') }}"
                                        placeholder="@lang('labels.form.email')">
                                    @error('email')
                                    <span class="button__clear-content js-button__clear-content"></span>
                                    @enderror
                                </div>
                                @error('email')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>


                            <div class="form-group">
                                <div class="form-input">
                                    <label for="user-name">Mật khẩu *</label>
                                    <input
                                        id="password"
                                        type="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        name="password"
                                        minlength="8"
                                        required
                                        placeholder="@lang('labels.form.password')"
                                        autocomplete="new-password">
                                    @error('email')
                                    <span class="button__clear-content js-button__clear-content"></span>
                                    @enderror
                                </div>
                                @error('email')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <div class="form-input">
                                    <label for="user-name">Nhập lại mật khẩu *</label>
                                    <input
                                        id="password-confirm"
                                        type="password"
                                        minlength="8"
                                        class="form-control"
                                        name="password_confirmation"
                                        required
                                        placeholder="@lang('users.label.password_confirm')"
                                        autocomplete="new-password">
                                    @error('email')
                                    <span class="button__clear-content js-button__clear-content"></span>
                                    @enderror
                                </div>
                                @error('email')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="account-function">
                                <button type="submit" class="no-round-btn">{{ __('Cập nhật mật khẩu') }}</button>
                                <a class="create-account" href="{{ route('login') }}">Quay lại đăng nhập</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- End account-->
        <div class="partner">
            <div class="container">
                <div class="partner_block d-flex justify-content-between" data-slick="{&quot;slidesToShow&quot;: 6}">
                    <div class="partner--logo" href=""><a href="#"><img src="/images/partner/partner_01.png"
                                                                        alt="partner logo"></a></div>
                    <div class="partner--logo" href=""><a href="#"><img src="/images/partner/partner_02.png"
                                                                        alt="partner logo"></a></div>
                    <div class="partner--logo" href=""><a href="#"><img src="/images/partner/partner_01.png"
                                                                        alt="partner logo"></a></div>
                    <div class="partner--logo" href=""><a href="#"><img src="/images/partner/partner_02.png"
                                                                        alt="partner logo"></a></div>
                    <div class="partner--logo" href=""><a href="#"><img src="/images/partner/partner_01.png"
                                                                        alt="partner logo"></a></div>
                    <div class="partner--logo" href=""><a href="#"><img src="/images/partner/partner_02.png"
                                                                        alt="partner logo"></a></div>
                    <div class="partner--logo" href=""><a href=""><img src="/images/partner/partner_01.png"
                                                                       alt="partner logo"></a></div>
                </div>
            </div>
        </div>
        <!-- End partner-->

    </div>
@endsection
