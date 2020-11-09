@extends('layouts.member')

@section('title', app_name() . ' | ' . __('title.member.detail'))

@section('sidebar')
    @include('includes.sidebar')
@endsection

@section('content')
    <div class="container-balance-detail container mb-5">
        <div class="balance-title">
            <div class="detail__balance--title">
                @lang('offers.label.offer_history')
            </div>
            <div class="detail__balance--description">
                <span>@lang('offers.label.offer_history_des')</span>
            </div>
        </div>
        <div style="overflow-x:auto;">
            <table class="tbl-1col table-fixed" style="white-space:nowrap;">
                <tbody>
                <tr>
                    <th width="20%">@lang('offers.label.offer_number')</th>
                    <th width="30%">@lang('offers.label.date_sent')</th>
                    <th width="50%">@lang('offers.label.female_member')</th>
                </tr>
                @if(!empty($offers))
                    @foreach($offers as $offer)
                        <tr>
                            <td class="text-center td-number-reset-space">
                                 <span><a href="{{ route('history.detail', $offer->public_id) }}"
                                          class="popup-detail blank cboxElement">{{ $offer->public_id }}</a></span></td>
                            <td class="text-center">{{ $offer->created_at }}</td>
                            <td class="text-center td-reset-space">
                                @foreach ($offer->userOffers as $value)
                                    <span><a href="{{ route('member.detail', $value->user_id) }}"
                                             class="popup-detail blank cboxElement">{{ $value->name_offer }}</a></span>
                                @endforeach
                            </td>
                        </tr>
                    @endforeach
                @endif

                </tbody>
            </table>
        </div>
    </div>
@endsection
