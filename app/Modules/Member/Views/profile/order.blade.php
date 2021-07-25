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
                            <h2 class="title">Thông tin đơn hàng</h2>
                        </div>
                    </div>

                    @if($countOrder > 0)
                        <table class="table-order">
                            <thead>
                            <tr>
                                <th class="table-title">
                                    <span class="nobr">ID</span></th>
                                <th class="table-title">
                                    <span class="nobr">Ngày mua</span></th>
                                <th class="table-title">
                                    <span class="nobr">Trạng thái</span></th>
                                <th class="table-title">
                                    <span class="nobr">Tổng tiền</span></th>
                                <th class="table-title">
                                    <span class="nobr">Chi tiết</span></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $key => $value)
                                <tr class="order">
                                    <td class="order-number" data-title="Order">
                                        <a href="https://demoapus.com/ogami/my-account/view-order/4128/">
                                            #{{ $value->id }} </a></td>
                                    <td class="woocommerce-orders-table__cell woocommerce-orders-table__cell-order-date"
                                        data-title="Date"> {{ date('d-m-Y', strtotime($value->created_at)) }}
                                    </td>
                                    <td data-title="Status">
                                        @if($value->status == 0)
                                            Chưa xác nhận
                                        @else
                                            Đã Xác nhận
                                        @endif
                                    </td>
                                    <td data-title="Total"><span class="woocommerce-Price-amount amount">
                                        <span class="woocommerce-Price-currencySymbol">¥</span>{{ number_format($value->total) }}</span>
                                    </td>
                                    <td data-title="Actions">
                                        <a href="https://demoapus.com/ogami/my-account/view-order/4128/" class="woocommerce-button button view">Chi tiết</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="woocommerce-message woocommerce-message--info woocommerce-Message woocommerce-Message--info woocommerce-info">
                            <i class="fab fa-opencart"></i>
                            Bạn chưa có đơn hàng nào.
                            <a href="<?php echo e(route('cate.view', 'tat-ca-san-pham')); ?>"
                               class="no-round-btn shop-order">
                                Đi đến cửa hàng
                            </a>
                        </div>
                    @endif
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
