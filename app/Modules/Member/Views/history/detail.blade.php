@extends('layouts.member')

@section('title', app_name() . ' | ' . __('title.member.detail'))

@section('sidebar')
    @include('includes.sidebar')
@endsection

@section('content')
    <div class="container-balance-detail mb-5 container mb-5">
        <div class="balance-title">
            <div class="detail__balance--title">
                @lang('offers.label.offer_detail')
            </div>
        </div>
        <div style="overflow-x:auto;">
            <table class="tbl-2col tbl-change-password mb0" style="white-space:nowrap;">
                <tbody>
                <tr>
                    <td class="field">@lang('offers.label.offer_number')</td>
                    <td class="font-size-label font-space">{{ $offer->public_id }}</td>
                </tr>
                <tr>
                    <td class="field">@lang('offers.label.date_sent')</td>
                    <td class="font-size-label font-space">{{ $offer->created_at }}</td>
                </tr>
                <tr>
                    <td class="field">@lang('offers.label.for_priority')</td>
                    <td class="font-size-label font-space">@lang('offers.label.for_priority_des')</td>
                </tr>
                @foreach ($offer->userOffers as $key => $value)
                    <tr>
                        <td class="field"> {{ __('offers.label.women', ['order' => $key + 1]) }}</td>
                        <td class="font-size-label font-space">
                            <div class="icon-class_sb flLeft td-reset-space">
                             <span><a href="{{ route('member.detail', $value->user_id) }}"
                                      class="popup-detail blank cboxElement">{{ $value->name_offer }}</a></span>
                            </div>
                        </td>
                    </tr>
                @endforeach

                <tr>
                    <td class="field">@lang('offers.label.desired_option1')</td>
                    <td class="font-size-label font-space">{{ $offer->desired_option_1 }}</td>
                </tr>
                <tr>
                    <td class="field">@lang('offers.label.desired_option2')</td>
                    <td class="font-size-label font-space">{{ $offer->desired_option_2 }}</td>
                </tr>
                <tr>
                    <td class="field">@lang('offers.label.desired_option3')</td>
                    <td class="font-size-label font-space">{{ $offer->desired_option_3 }}</td>
                </tr>
                <tr>
                    <td class="field">@lang('offers.label.desired_option4')</td>
                    <td class="font-size-label font-space">{{ $offer->desired_option_4 }}</td>
                </tr>
                <tr>
                    <td class="field">@lang('offers.label.desired_option5')</td>
                    <td class="font-size-label font-space">{{ $offer->desired_option_5 }}</td>
                </tr>

                <tr>
                    <td class="field">@lang('offers.label.select_data_time_other')</td>
                    <td class="font-size-label font-space">{{ $offer->desired_content }}</td>
                </tr>
                <tr>
                    <td class="field">@lang('offers.label.other_request')</td>
                    <td class="font-size-label font-space">
                        @foreach($settingMember['request_setting'][App::getLocale()] as $key => $value)
                            @if (!empty($offer->request_option) && in_array($key, explode(',' ,$offer->request_option)))
                                <div class="form-checkbox section-fontsize">
                                    - {{ $value }}
                                </div>
                            @endif
                        @endforeach
                        @if (!empty($offer->request_other))
                            - {{ $offer->request_other }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="field">@lang('offers.label.payment_method')</td>
                    <td class="font-size-label font-space">
                        @foreach($settingMember['payment_method'][App::getLocale()] as $key => $value)
                            @if($key === (int)$offer->payment_method)
                                {{ $value }}
                            @endif
                        @endforeach
                    </td>
                </tr>

                <tr>
                    <td class="field">@lang('users.label.status')</td>
                    <td class="font-size-label font-space">
                        @foreach($settingMember['offer_status'][App::getLocale()] as $key => $value)
                            @if($key === (int)$offer->status)
                                {{ $value }}
                            @endif
                        @endforeach
                    </td>
                </tr>

                <tr>
                    <td class="field">@lang('offers.label.request_admin')</td>
                    <td class="font-size-label font-space">{{ $offer->request_admin }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
