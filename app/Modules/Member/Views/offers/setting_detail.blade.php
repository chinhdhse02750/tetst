@extends('layouts.member')
@section('custom_style')
    {!! style(('assets/admin/lib/datetimepicker/jquery.datetimepicker.min.css')) !!}
@endsection

@section('content')
    <form id="form-setting-detail" class="form-horizontal create-setting-list"
          action="{{ route('offer.setting-detail') }}" method="POST">
        {!! csrf_field() !!}
        <div id="singlecolumn">
            <div class="container">
                @include('offers.setting-menu')
                <div class="section section-content">
                    <input type="hidden" class="text-error-desired"
                           value="@lang('alerts.offers.errors.desired-option-required')">
                    <input type="hidden" class="text-error-desired-content"
                           value="@lang('alerts.offers.errors.desired-content-required')">
                    <input type="hidden" class="text-error-pay-method"
                           value="@lang('alerts.offers.errors.point_enough')">

                    <div class="fb mb-3" id="date-time">@lang('offers.label.select_date_time')
                        <span class="red require_box">*</span>
                        <span class="red section-fontsize section-validate" id="desired_option_1_validate">&nbsp;&nbsp;&nbsp;</span>
                    </div>
                    <table class="tbl-calendar mb0">
                        <tbody>
                        <tr>
                            <td class="field section-fontsize">@lang('offers.label.desired_option1')</td>
                            <td class="right_area">
                                <div class="inlinebox">
                                    <input type="text"
                                           id="desired_option01"
                                           name="desired_option_1"
                                           class="form-control calendar1 section-fontsize desired-group"
                                           placeholder="@lang('offers.label.place_holder_select_time')"
                                           autocomplete="off"
                                           @if(!empty($dataRequestOffer) && isset($dataRequestOffer['desired_option_1']) )
                                           value="{{ \Carbon\Carbon::parse($dataRequestOffer['desired_option_1'])->format('Y-m-d H:i') }}" @endif/>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="field section-fontsize">@lang('offers.label.desired_option2')</td>
                            <td>
                                <div class="inlinebox">
                                    <input type="text"
                                           id="desired_option02"
                                           name="desired_option_2"
                                           class="form-control calendar2 section-fontsize desired-group"
                                           placeholder="@lang('offers.label.place_holder_select_time')"
                                           autocomplete="off"
                                           @if(!empty($dataRequestOffer) && isset($dataRequestOffer['desired_option_2']) )
                                           value="{{ \Carbon\Carbon::parse($dataRequestOffer['desired_option_2'])->format('Y-m-d H:i') }}" @endif/>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="field section-fontsize">@lang('offers.label.desired_option3')</td>
                            <td>
                                <div class="inlinebox">
                                    <input type="text"
                                           id="desired_option03"
                                           name="desired_option_3"
                                           class="form-control calendar3 section-fontsize desired-group"
                                           placeholder="@lang('offers.label.place_holder_select_time')"
                                           autocomplete="off"
                                           @if(!empty($dataRequestOffer) && isset($dataRequestOffer['desired_option_3']) )
                                           value="{{ \Carbon\Carbon::parse($dataRequestOffer['desired_option_3'])->format('Y-m-d H:i') }}" @endif/>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td class="field section-fontsize">@lang('offers.label.desired_option4')</td>
                            <td>
                                <div class="inlinebox">
                                    <input type="text"
                                           id="desired_option04"
                                           name="desired_option_4"
                                           class="form-control calendar4 section-fontsize desired-group"
                                           placeholder="@lang('offers.label.place_holder_select_time')"
                                           autocomplete="off"
                                           @if(!empty($dataRequestOffer) && isset($dataRequestOffer['desired_option_4']) )
                                           value="{{ \Carbon\Carbon::parse($dataRequestOffer['desired_option_4'])->format('Y-m-d H:i') }}" @endif/>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="field section-fontsize">@lang('offers.label.desired_option5')</td>
                            <td>
                                <div class="inlinebox">
                                    <input type="text"
                                           id="desired_option05"
                                           name="desired_option_5"
                                           class="form-control calendar5 section-fontsize desired-group"
                                           placeholder="@lang('offers.label.place_holder_select_time')"
                                           autocomplete="off"
                                           @if(!empty($dataRequestOffer) && isset($dataRequestOffer['desired_option_5']) )
                                           value="{{ \Carbon\Carbon::parse($dataRequestOffer['desired_option_5'])->format('Y-m-d H:i') }}" @endif/>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>

                    <div class="fb mt-5" id="date-other">@lang('offers.label.select_data_time_other')
                        <span class="red require_box">*</span>
                        <span class="red section-fontsize section-validate" id="desired_content_validate">&nbsp;&nbsp;&nbsp;</span>
                    </div>

                    <div class="section-description mb-3">@lang('offers.label.select_date_time_des')</div>
                    <textarea name="desired_content" id="place-area"
                              class="txt_sel section-fontsize">@if(!empty($dataRequestOffer['desired_content'])){{ $dataRequestOffer['desired_content'] }}@endif</textarea>
                    <div class="fb mt-5 mb-3" id="request-women">@lang('offers.label.request_for_women')</div>
                    <div class="pl-3">
                        @foreach($settingMember['request_setting'][App::getLocale()] as $key => $value)
                            <div class="form-checkbox section-fontsize candidate-setting">
                                <input type="checkbox" class="radio candidate-option" name="request_option[]"
                                       value="{{ $key }}"
                                       id="request_option_{{ $key }}"
                                       @if (!empty($dataRequestOffer['request_option']) && in_array($key, explode(',' ,$dataRequestOffer['request_option']))) checked @endif>
                                <label for="request_option_{{ $key }}" class="reset-margin"> {{ $value }} </label>
                            </div>
                        @endforeach
                    </div>
                    <div class="fb mt-3 mb-3">【@lang('users.label.other')】</div>
                    <textarea name="request_other" id="request-other"
                              class="txt_sel section-fontsize">@if(!empty($dataRequestOffer['request_other'])){{ $dataRequestOffer['request_other'] }}@endif</textarea>
                    <div class="fb mt-5" id="owned-point">@lang('offers.label.owned_point')
                        <span class="red section-fontsize section-validate" id="total_offer_validate">&nbsp;&nbsp;&nbsp;</span>
                    </div>
                    <input type="hidden" id="total_amount" name="total_amount" value="{{ Auth::user()->total_amount }}" >
                    <input type="hidden" id="total_offer"  name="total_offer" value="{{ $totalOffer }}">
                    <div class="section-description mb-3">
                        {{ __('offers.label.owned_point_des', ['point' => Auth::user()->total_amount_label]) }}
                    </div>
                    <!-- Button trigger modal -->
                    <button type="button"  class="btn btn-outline-secondary mr-3 mw-150px section-fontsize" data-toggle="modal" data-target="#paymentModal">
                        @lang('offers.label.point_purchase')
                    </button>
                    @include('offers.includes.payment')
                    @include('offers.includes.bank-information')
                    <div class="fb mt-5 mb-3" id="request-admin">@lang('offers.label.request_admin')</div>
                    <textarea name="request_admin" id="request-admin"
                              class="txt_sel section-fontsize">@if(!empty($dataRequestOffer['request_admin'])){{ $dataRequestOffer['request_admin'] }}@endif</textarea>

                </div>
                <div class="clr clr-bottom-border"></div>
                <div class="d-flex mb-5 justify-content-center">
                    <input type="submit" id="submit-detail"
                           class="btn btn-outline-secondary mr-3 mw-150px section-fontsize"
                           disabled
                           value="@lang('offers.label.save_and_continue')">
                </div>
            </div>
        </div>
    </form>

    <div class="template__loading">
        <i class="icon icon__loading"></i>
    </div>

@endsection

@push('script')
    <script>
        let locate = '{{ config('app.locale') }}';
    </script>
    {!! script(('assets/admin/lib/datetimepicker/jquery.datetimepicker.full.min.js')) !!}
    {!! script(('js/validator/jquery.validate.min.js')) !!}
    {!! script(('js/validator/additional-methods.min.js')) !!}
    {!! script(('js/settingDetail.js')) !!}
@endpush
