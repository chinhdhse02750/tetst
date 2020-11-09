@extends('layouts.shop')
@section('content')
    <div id="main">
        <div class="ogami-breadcrumb">
            <div class="container">
                <ul>
                    <li> <a class="breadcrumb-link" href="index.html"> <i class="fas fa-home"></i>Home</a></li>
                    <li> <a class="breadcrumb-link active" href="#">Login</a></li>
                </ul>
            </div>
        </div>
        <!-- End breadcrumb-->
        <div class="account">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-6 mx-auto">
                        <h1 class="title">Đăng nhập</h1>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <input type="hidden" name="remember" value="1">
                            <div class="form-group">
                                <div class="form-input">
                                    <label for="user-name">Tên tài khoản hoặc địa chỉ Email *</label>
                                    <input
                                            type="email"
                                            class="no-round-input form-control form-input__username @error('email') is-invalid @enderror"
                                            name="email"
                                            value="{{ old('email') }}"
                                            required
                                            autocomplete="email"
                                            placeholder="@lang('labels.form.email')"
                                            autofocus>
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

                            <div class="form-group mt-4">
                                <label for="password">Mật khẩu *</label>
                                <input
                                        type="password"
                                        class="no-round-input form-control @error('password') is-invalid @enderror"
                                        name="password"
                                        required
                                        placeholder="@lang('labels.form.password')"
                                        autocomplete="current-password">
                                @error('password')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="account-method">
                                <div class="account-save">
                                    <input id="savepass" type="checkbox">
                                    <label for="savepass">Save Password</label>
                                </div>
                                <div class="account-forgot"><a href="#">Forget your Password</a></div>
                            </div>
                            <div class="account-function">
                                <button class="no-round-btn">Sign in</button><a class="create-account" href="{{ route('member.register') }}">Or create an account</a>
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
                    <div class="partner--logo" href=""> <a href="#"><img src="/images/partner/partner_01.png" alt="partner logo"></a></div>
                    <div class="partner--logo" href=""> <a href="#"><img src="/images/partner/partner_02.png" alt="partner logo"></a></div>
                    <div class="partner--logo" href=""> <a href="#"><img src="/images/partner/partner_01.png" alt="partner logo"></a></div>
                    <div class="partner--logo" href=""> <a href="#"><img src="/images/partner/partner_02.png" alt="partner logo"></a></div>
                    <div class="partner--logo" href=""> <a href="#"><img src="/images/partner/partner_01.png" alt="partner logo"></a></div>
                    <div class="partner--logo" href=""> <a href="#"><img src="/images/partner/partner_02.png" alt="partner logo"></a></div>
                    <div class="partner--logo" href=""> <a href=""><img src="/images/partner/partner_01.png" alt="partner logo"></a></div>
                </div>
            </div>
        </div>
        <!-- End partner-->
    </div>
@endsection
