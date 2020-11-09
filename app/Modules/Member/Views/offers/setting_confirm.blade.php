@extends('layouts.member')
@section('custom_style')
    {!! style(('assets/admin/lib/datetimepicker/jquery.datetimepicker.min.css')) !!}
@endsection

@section('content')
    <form id="setting-confirm" class="form-horizontal create-setting-list" action="{{ route('offer.setting-confirm') }}" method="POST">
        {!! csrf_field() !!}
        <div id="singlecolumn">
            <div class="container">
                @include('offers.setting-menu')
                <div class="section section-content">
                    <div class="title-area">
                        <div class="left-area">
                            <div class="fb">@lang('offers.label.candidates_setting')</div>
                            <div class="section-description mb11">@lang('offers.label.candidates_confirm')</div>
                        </div>
                        <div class="right-area">
                            <div class="bt-bt_change"><a class="btn btn-outline-secondary section-fontsize" href="{{ route('offer.index') }}">@lang('users.label.edit')</a></div>
                        </div>
                    </div>
                    <div class="section-fontsize candidate-setting">
                        <input type="checkbox"
                               name="candidate_setting_option_1"
                               id="candidate_option_1"
                               class="candidate-option"
                               value="1" disabled
                               @if (!empty($dataRequestOffer) && $dataRequestOffer['candidate_setting_option_1'] === '1') checked @endif/>
                        <label for="candidate_option_1"
                               style="cursor:pointer;">@lang('offers.label.candidates_option_1')</label>
                    </div>
                    <div class="section-fontsize candidate-setting">
                        <input type="checkbox"
                               name="candidate_setting_option_2"
                               id="candidate_option_2"
                               class="candidate-option"
                               value="1" disabled
                               @if (!empty($dataRequestOffer) && $dataRequestOffer['candidate_setting_option_2'] === '1') checked @endif/>
                        <label for="candidate_option_2"
                               style="cursor:pointer;">@lang('offers.label.candidates_option_2')</label>
                    </div>
                    <div id="priority" class="box display-img mb22 row ui-sortable">
                        @foreach($members as $key => $member)
                            <div class="favorite col-md-6" id="lno_{{ $member->userProfile->user_id }}">
                                <input type="hidden" name="member[]" value="{{ $member->userProfile->user_id }}">
                                <div class="pri_handler section-fontsize mb11">
                                    {!! __('offers.label.setting_sort', ['setting_sort' => $key+1]) !!}
                                </div>
                                <div id="photo_area">
                                    <div class="img"><span class="mask" style="display: none;"></span>
                                        <a href="{{ route('member.detail', $member->userProfile->user_id) }}"
                                           class="image-setting-list">{!! $member->userProfile->profile_image !!}</a>
                                    </div>
                                </div>
                                <div id="detail_area">
                                    <div class="section-fontsize detail-name">{{ $member->userProfile->name }}</div>
                                    <div class="section-fontsize mb11">{!! $member->userProfile->full_about !!}</div>
                                    <div id="account">
                                        <div class="icon-star_3 flLeft">
                                            @include('includes.rating', ['rating' => $member->userProfile->rating_star_calc])
                                        </div>
                                    </div>
                                    <dl class="personal">
                                        <div class="form-group-setting">
                                            <dt class="section-description">@lang('users.label.rank')：</dt>
                                            <dd>{{ $member->userProfile ? $member->userProfile->rank_name : "" }}</dd>
                                        </div>
                                        <div class="form-group-setting">
                                            <dt class="section-description">@lang('users.label.member_no')：</dt>
                                            <dd>{{ $member->userProfile ? $member->userProfile->user_id : ""}}</dd>
                                        </div>
                                        <div class="form-group-setting">
                                            <dt class="section-description">@lang('users.label.area')：</dt>
                                            <dd>{{ $member->prefecture ? $member->prefecture->first()->area->name  : ""}}</dd>
                                        </div>
                                    </dl>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="section section-content">
                    <div class="title-area">
                        <div class="left-area">
                            <div class="fb">@lang('offers.label.select_date_time')</div>
                            <div class="section-description mb-3">@lang('offers.label.select_date_time_confirm')</div>
                        </div>
                        <div class="right-area">
                            <div class="bt-bt_change"><a class="btn btn-outline-secondary section-fontsize"
                                                         href="{{ route('offer.detail') }}#date-time">@lang('users.label.edit')</a></div>
                        </div>
                    </div>
                    <table class="tbl-calendar mb0">
                        <tbody>
                        <tr>
                            <td class="field section-fontsize ">@lang('offers.label.desired_option1')</td>
                            <td class="right_area">
                                <div class="inlinebox section-fontsize">
                             <span>
                                 @if(!empty($dataRequestOffer['desired_option_1']))
                                     {{ \Carbon\Carbon::parse($dataRequestOffer['desired_option_1'])->format('Y/m/d H:i') }}
                                 @endif
                             </span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="field section-fontsize">@lang('offers.label.desired_option2')</td>
                            <td>
                                <div class="inlinebox section-fontsize">
                                    @if(!empty($dataRequestOffer['desired_option_2']))
                                        {{ \Carbon\Carbon::parse($dataRequestOffer['desired_option_2'])->format('Y/m/d H:i') }}
                                    @endif
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="field section-fontsize">@lang('offers.label.desired_option3')</td>
                            <td>
                                <div class="inlinebox section-fontsize">
                                    @if(!empty($dataRequestOffer['desired_option_3']))
                                        {{ \Carbon\Carbon::parse($dataRequestOffer['desired_option_3'])->format('Y/m/d H:i') }}
                                    @endif
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td class="field section-fontsize">@lang('offers.label.desired_option4')</td>
                            <td>
                                <div class="inlinebox section-fontsize">
                                    @if(!empty($dataRequestOffer['desired_option_4']))
                                        {{ \Carbon\Carbon::parse($dataRequestOffer['desired_option_4'])->format('Y/m/d H:i') }}
                                    @endif
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="field section-fontsize">@lang('offers.label.desired_option5')</td>
                            <td>
                                <div class="inlinebox section-fontsize">
                                    @if(!empty($dataRequestOffer['desired_option_5']))
                                        {{ \Carbon\Carbon::parse($dataRequestOffer['desired_option_5'])->format('Y/m/d H:i') }}
                                    @endif
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>

                    <div class="title-area fb mt-5 mb-3">
                        <div class="left-area">
                            <div class="fb">@lang('offers.label.select_data_time_other')</div>
                            <div class="section-description">@lang('offers.label.select_date_time_des')</div>
                        </div>
                        <div class="right-area">
                            <div class="bt-bt_change"><a class="btn btn-outline-secondary section-fontsize"
                                                         href="{{ route('offer.detail') }}#date-other">@lang('users.label.edit')</a></div>
                        </div>
                    </div>
                    <textarea name="desired_content" id="place-area" disabled
                              class="txt_sel section-fontsize">@if(!empty($dataRequestOffer['desired_content'])){{ $dataRequestOffer['desired_content'] }}@endif</textarea>
                    <div class="title-area fb mt-5 mb-3">
                        <div class="left-area">
                            <div>@lang('offers.label.request_for_women')</div>
                        </div>
                        <div class="right-area">
                            <div class="bt-bt_change"><a class="btn btn-outline-secondary section-fontsize"
                                                         href="{{ route('offer.detail') }}#request-women">@lang('users.label.edit')</a></div>
                        </div>
                    </div>
                    <div class="box-confirm">
                        @foreach($settingMember['request_setting'][App::getLocale()] as $key => $value)
                            @if (!empty($dataRequestOffer['request_option']) && in_array($key, explode(',' ,$dataRequestOffer['request_option'])))
                                <div class="form-checkbox section-fontsize">
                                    - {{ $value }}
                                </div>
                            @endif
                        @endforeach
                    </div>

                    <div class="fb mb-3 mt-3">【@lang('users.label.other')】</div>
                    <textarea name="request_other" id="request-other" disabled
                              class="txt_sel section-fontsize">@if(!empty($dataRequestOffer['request_other'])){{ $dataRequestOffer['request_other'] }}@endif
              </textarea>

                    <div class="title-area mt-5">
                        <div class="left-area">
                            <div class="fb">@lang('offers.label.payment_method')</div>
                            <div class="section-description mb-3">
                                @lang('offers.label.payment_method_des')
                            </div>
                        </div>
                        <div class="right-area">
                            <div class="bt-bt_change"><a class="btn btn-outline-secondary section-fontsize"
                                                         href="{{ route('offer.detail') }}#owned-point">@lang('users.label.edit')</a></div>
                        </div>
                    </div>
                    <div class="box-confirm">
                        <div class="form-checkbox section-fontsize">
                            @foreach($settingMember['payment_method'][App::getLocale()] as $key => $value)
                                @if($key === (int)$dataRequestOffer['payment_method'])
                                    {{ $value }}
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="title-area mt-5 mb-3">
                        <div class="left-area">
                            <div class="fb" id="request-admin">@lang('offers.label.request_admin')</div>
                        </div>
                        <div class="right-area">
                            <div class="bt-bt_change"><a class="btn btn-outline-secondary section-fontsize"
                                                         href="{{ route('offer.detail') }}#request-admin">@lang('users.label.edit')</a></div>
                        </div>
                    </div>
                    <textarea name="request_admin" id="request-admin" disabled
                              class="txt_sel section-fontsize">@if(!empty($dataRequestOffer['request_admin'])){{ $dataRequestOffer['request_admin'] }}@endif
              </textarea>
                </div>
                <div class="clr clr-bottom-border"></div>
                <div class="d-flex mb-5 justify-content-center">
                    <input type="submit" class="btn btn-outline-secondary mr-3 mw-150px section-fontsize"
                           disabled
                           value="@lang('offers.label.apply_for_setting')">
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
        $(document).ready(function () {
            $('.image-setting-list').css("background", "#272727");

            $(':input[type="submit"]').prop('disabled', false);

            $("#setting-confirm").submit(function () {
                $(':input[type="submit"]').prop('disabled', true);
            });
        });
    </script>
@endpush
