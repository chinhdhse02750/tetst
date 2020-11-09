@extends('layouts.member')

@section('title', app_name() . ' | ' . __('title.member.detail'))

@section('sidebar')
    @include('includes.sidebar')
@endsection

@section('content')
    <div class="container-balance-detail mb-5">
        <div class="balance-title">
            <div class="detail__balance--title">
                @lang('point.label.point_history')
            </div>
            <div class="detail__balance--description">
                <span>@lang('point.label.balance_description')</span>
            </div>
        </div>
        <table class="tbl-1col table-fixed"  style="white-space:nowrap;">
            <tbody>
            <tr>
                <th width="20%">@lang('point.label.date')</th>
                <th width="40%">@lang('point.label.action')</th>
                <th width="20%">@lang('point.label.point')</th>
                <th width="20%">@lang('point.label.balance')</th>
            </tr>
            @if(!empty($balances))
                @php $balanceTotal = 0; @endphp
                @foreach($balances as $balance)
                    @php $balanceTotal += $balance->point_amount; @endphp
                    <tr>
                        <td>{{ $balance->created_at }}</td>
                        <td>{{ !empty($balance->model) ? $balance->model->content : '' }}</td>
                        <td class="tr">{{ $balance->balance }}</td>
                        <td class="tr">{{  number_format($balanceTotal) }} @lang('point.label.point') </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
@endsection
