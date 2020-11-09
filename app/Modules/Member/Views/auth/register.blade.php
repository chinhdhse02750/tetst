@extends('layouts.shop')

@section('content')
    <div id="main">
        <!-- End header-->
        <div class="ogami-breadcrumb">
            <div class="container">
                <ul>
                    <li> <a class="breadcrumb-link" href="index.html"> <i class="fas fa-home"></i>Home</a></li>
                    <li> <a class="breadcrumb-link active" href="#">Register</a></li>
                </ul>
            </div>
        </div>
        <!-- End breadcrumb-->
        <div class="account">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-6 mx-auto">
                        <h1 class="title">Register</h1>
                        <form>
                            <label for="user-name">Username or email address *</label>
                            <input class="no-round-input" id="user-name" type="text">
                            <label for="password">Password *</label>
                            <input class="no-round-input" id="password" type="text">
                            <label for="confirm">Comfirm password *</label>
                            <input class="no-round-input" id="confirm" type="text">
                            <div class="account-function">
                                <button class="no-round-btn">Register</button><a class="create-account" href="{{ route('login') }}">Or login</a>
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
