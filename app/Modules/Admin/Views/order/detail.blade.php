@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2>@lang('units.label.detail')</h2>
                    </div>
                </div>
            </div>
            <div class="mb-4 mt-3">
                <div class="form-group row">
                    <div class="col-md-2">
                        <strong>Tên khách hàng:</strong>
                    </div>
                    <div class="col-md-10">
                        {{ $order->full_name }}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-2">
                        <strong>Facebook:</strong>
                    </div>
                    <div class="col-md-10">
                         @if($order->facebook)
                             {{ $order->facebook }}
                         @else
                             Không sử dụng facebook
                         @endif
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-2">
                        <strong>Địa chỉ:</strong>
                    </div>
                    <div class="col-md-10">
                        {{ $order->address }}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-2">
                        <strong>Phí ship hàng:</strong>
                    </div>
                    <div class="col-md-10">
                        ￥{{ $order->shipping }}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-2">
                        <strong>Phí daibiky (COD):</strong>
                    </div>
                    <div class="col-md-10">
                        ￥{{ $order->daibiky }}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-2">
                        <strong>Tiền hàng:</strong>
                    </div>
                    <div class="col-md-10">
                        ￥{{ $order->subtotal }}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-2">
                        <strong>Tổng đơn hàng:</strong>
                    </div>
                    <div class="col-md-10">
                        ￥{{ $order->total }}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-2">
                        <strong>Tỉnh-thành phố:</strong>
                    </div>
                    <div class="col-md-10">
                        {{ $order->pref->name }}
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-2">
                        <strong>Số điện thoại:</strong>
                    </div>
                    <div class="col-md-10">
                        {{ $order->phone }}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-2">
                        <strong>Email:</strong>
                    </div>
                    <div class="col-md-10">
                        {{ $order->email }}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-2">
                        <strong>Ghi chú đơn hàng:</strong>
                    </div>
                    <div class="col-md-10">
                        @if($order->comment)
                            {{ $order->comment }}
                        @else
                            Không có ghi chú
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-2">
                        <strong>Phương thức thanh toán:</strong>
                    </div>
                    <div class="col-md-10">
                        @if($order->payment_method == "cash-on")
                            Thanh toán khi nhận hàng (bao gồm phí thu hộ)
                        @else
                            Thanh toán qua chuyển khoản ngân hàng
                        @endif
                    </div>
                </div>

                @if($order->payment_method !== "cash-on")
                    <div class="form-group row">
                        <div class="col-md-2">
                            <strong>Trạng thái thanh toán:</strong>
                        </div>
                        <div class="col-md-10">
                            @if($order->payment_status == 0)
                                Chưa thanh toán
                            @else
                                Đã thanh toán qua chuyển khoản
                            @endif
                        </div>
                    </div>
                @endif
            </div>
            @if($orderDetail)
                <div class="row mt-4">
                    <div class="col">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th width="10%">ID</th>
                                    <th width="30%">Tên sản phẩm</th>
                                    <th width="10%">Giá tiền</th>
                                    <th width="10%">Số lượng</th>
                                    <th width="20%">Tổng tiền</th>
                                    <th width="20%">Ngày tạo</th>
                                <tbody>
                                    @foreach($orderDetail as $detail)
                                        <tr>
                                            <td class="table-text">
                                                <div>{{ $detail->id }}</div>
                                            </td>
                                            <td class="table-text">
                                                <div>{{ $detail->name }}</div>
                                            </td>
                                            <td class="table-text">
                                                <div>￥{{ $detail->price }}</div>
                                            </td>
                                            <td class="table-text">
                                                <div>￥{{ $detail->qty }}</div>
                                            </td>
                                            <td class="table-text">
                                                <div>￥ {{ $detail->total_price }}</div>
                                            </td>
                                            <td class="table-text">
                                                <div>{{ $detail->created_at }}</div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div><!--col-->
                </div><!--row-->
            @endif
            <div class="d-flex justify-content-left">
                <a href="{{ route('order.index') }}" class="btn btn-primary"> @lang('labels.general.back')</a>
            </div>
        </div>
    </div>
@endsection
