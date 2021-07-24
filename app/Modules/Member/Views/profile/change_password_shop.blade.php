@extends('layouts.shop')

@section('title', app_name() . ' | ' . __('title.member.detail'))

@section('content')
    <div class="ogami-breadcrumb">
        <div class="container">
            <ul>
                <li><a class="breadcrumb-link" href="{{ route('home') }}"> <i class="fas fa-home"></i>Trang chủ</a></li>
                <li><a class="breadcrumb-link active">Thông tin tài khoản</a></li>
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
                    <div class="balance-title">
                        <div class="department_top mini-tab-title underline">
                            <h2 class="title">Thay đổi mật khẩu</h2>
                        </div>
                        <div class="detail__balance--description">
                            <span>Để thay đổi mật khẩu đã đăng ký của bạn, vui lòng nhập mật khẩu mới vào chỗ trống và nhấn vào Thay đổi.</span>
                        </div>
                    </div>

                    <form id="member-form" action="{{ route('profile.change-password') }}" method="POST">
                        {{ csrf_field() }}
                        <fieldset>
                            <p class="form-group form-row form-row-thirds">
                                <label for="password">Mật khẩu mới</label>
                                <input type="password" class="input-text form-control" name="password" id="password"
                                       maxlength="50"
                                       minlength="8">
                            </p>

                            <p class="form-group form-row form-row-thirds">
                                <label for="confirm_password">Xác nhận mật khẩu</label>
                                <input type="password" class="input-text form-control" name="confirm_password" id="confirm_password"
                                       maxlength="50"
                                       minlength="8">
                            </p>
                        </fieldset>

                        <div class="form-group mb-5">
                            <div class="d-flex justify-content-center">
                                <button type="button" class="btn btn-outline-secondary btn-change-password" id="btn-change-password">Thay Đổi</button>
                            </div>
                            <!-- Button trigger modal -->
                            <div class="modal fade" id="confirm-change-password" tabindex="-1" role="dialog" aria-labelledby="confirm-modal-change-password" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h6 class="modal-title" id="confirm-modal-change-password">Xác nhận thay đổi mật khẩu!</h6>
                                        </div>
                                        <div class="modal-body gray modal-confim-pasword">
                                            <p>Bạn sẽ bị đăng xuất khi thay đổi mật khẩu của mình.</p>
                                            <p>Khi đăng nhập bạn sẽ cần nhập lại bằng mật khẩu mới.</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" id="button-change-password" class="btn btn-outline-secondary btn-border-dotted">Đồng ý</button>
                                            <button type="button" class="btn btn-outline-secondary btn-border-dotted" data-dismiss="modal">Quay lại</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- Button trigger modal -->
                </div>
            </div>
        </div>
    </div>


    <!-- End account-->
    {{--<div class="partner">--}}
        {{--<div class="container">--}}
            {{--<div class="partner_block d-flex justify-content-between" data-slick="{&quot;slidesToShow&quot;: 6}">--}}
                {{--<div class="partner--logo" href=""> <a href="#"><img src="/images/partner/partner_01.png" alt="partner logo"></a></div>--}}
                {{--<div class="partner--logo" href=""> <a href="#"><img src="/images/partner/partner_02.png" alt="partner logo"></a></div>--}}
                {{--<div class="partner--logo" href=""> <a href="#"><img src="/images/partner/partner_01.png" alt="partner logo"></a></div>--}}
                {{--<div class="partner--logo" href=""> <a href="#"><img src="/images/partner/partner_02.png" alt="partner logo"></a></div>--}}
                {{--<div class="partner--logo" href=""> <a href="#"><img src="/images/partner/partner_01.png" alt="partner logo"></a></div>--}}
                {{--<div class="partner--logo" href=""> <a href="#"><img src="/images/partner/partner_02.png" alt="partner logo"></a></div>--}}
                {{--<div class="partner--logo" href=""> <a href=""><img src="/images/partner/partner_01.png" alt="partner logo"></a></div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}

    <!-- Modal -->

@endsection

@section('custom_script')
    <script>
        let locate = '{{ config('app.locale') }}';
    </script>
    {!! script(('js/validator/jquery.validate.min.js')) !!}
    {!! script(('js/profile.js')) !!}
@stop
