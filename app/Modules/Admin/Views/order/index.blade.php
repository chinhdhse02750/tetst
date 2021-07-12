@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-body">
            @include('includes.alerts.messages')
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        @lang('categories.label.list')
                    </h4>
                </div><!--col-->
            </div><!--row-->
            <form method="post" id="pref-form"  action="{{ route('shipping.store') }}" >
                <input type="hidden" name="_token" id="csrf-token" value="{{ csrf_token() }}" />
                <div class="row mt-4">
                    <div class="col">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th width="5%">ID</th>
                                    <th width="10%">Tên khách hàng</th>
                                    <th width="10%">Tiền hàng</th>
                                    <th width="10%">Tổng đơn(bao gồm phí ship + thu hộ)</th>
                                    <th width="15%">Địa chỉ</th>
                                    <th width="10%">Tỉnh thành phố</th>
                                    <th width="10%">Trạng thái đơn hàng</th>
                                    <th width="10%">Trạng thái thanh toán</th>
                                    <th width="10%">Quản lý</th>
                                </thead>
                                <tbody>
                                @if(!empty($orders))
                                    <!-- Table Body -->
                                <tbody>
                                    @foreach($orders as $order)
                                        <tr>
                                            <td class="table-text">
                                                <div>{{ $order->id }}</div>
                                            </td>
                                            <td class="table-text">
                                                <div>{{ $order->full_name }}</div>
                                            </td>
                                            <td class="table-text">
                                                <div>￥{{ $order->subtotal }}</div>
                                            </td>
                                            <td class="table-text">
                                                <div>￥{{ $order->total }}</div>
                                            </td>
                                            <td class="table-text">
                                                <div>{{ $order->address }}</div>
                                            </td>
                                            <td class="table-text">
                                                <div>{{ $order->address }}</div>
                                            </td>
                                            <td class="table-text">
                                                <div>
                                                    <select name="status" class="bill_status" data-id="{{ $order->id }}">
                                                        <option value="0"  @if($order->status == 0) selected @endif>
                                                            Đơn chưa xác nhận</option>
                                                        <option value="1"  @if($order->status == 1) selected @endif>
                                                            Đơn đã xác nhận</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td class="table-text">
                                                <div>
                                                    <select name="status" class="payment_status" data-id="{{ $order->id }}">
                                                        <option value="0"  @if($order->payment_status == 0) selected @endif>
                                                            Đơn chưa thanh toán</option>
                                                        <option value="1"  @if($order->payment_status == 1) selected @endif>
                                                            Đơn đã thanh toán</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                <form method="POST">
                                                    <a href="{{ route('order.show', $order->id) }}"
                                                       class="btn btn-default"><i class="fas fa-eye"></i></a>
                                                    <a href="{{ route('order.destroy', $order->id) }}"
                                                       class="btn btn-danger"
                                                       data-method="delete"
                                                       data-trans-button-cancel="@lang('labels.general.cancel')"
                                                       data-trans-button-confirm="@lang('labels.general.delete')"
                                                       data-trans-title="@lang('alerts.general.confirm.delete')">
                                                        <i class="far fa-trash-alt"></i>
                                                    </a>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div><!--col-->
                </div><!--row-->
            </form>
        </div><!--card-body-->
    </div>
@endsection
@section('pagespecificscripts')
    <!-- flot charts scripts-->
    <script>
        $(document).ready(function () {
            $('.bill_status').on('change', function() {
                let id = $(this).data('id');
                let val = $(this).val();
                let url = '{{ url('/admin/order/update-status') }}';
                let data = {
                    id: id, status: val,
                };

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: url,
                    data: data,        //POST variable name value
                    success: function(msg){
                        if(msg.status == 'success'){
                            if(msg.key_status == 1){
                                alert('Đơn hàng đã được xác nhận');
                            }else{
                                alert('Hủy bỏ xác nhận đơn hàng');
                            }
                        }
                        else{
                            alert('Cập nhật không thành công!');
                        }
                    }
                });
            });

            $('.payment_status').on('change', function() {
                let id = $(this).data('id');
                let val = $(this).val();
                let url = '{{ url('/admin/order/update-payment-status') }}';
                let data = {
                    id: id, payment_status: val,
                };

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: url,
                    data: data,        //POST variable name value
                    success: function(msg){
                        if(msg.status == 'success'){
                            if(msg.key_status == 1){
                                alert('Xác nhận đơn hàng thanh toán thành công');
                            }else{
                                alert('Hủy bỏ xác nhận thanh toán ');
                            }

                        }
                        else{
                            alert('Cập nhật không thành công!');
                        }
                    }
                });
            });

        });
    </script>
@stop





