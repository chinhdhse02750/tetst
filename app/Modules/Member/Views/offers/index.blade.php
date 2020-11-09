@extends('layouts.member')

@section('content')
    <form id="setting-offer" class="form-horizontal create-setting-list" action="{{ route('offer.setting-list') }}"
          method="POST">
        {!! csrf_field() !!}
        <div id="singlecolumn">
            <div class="container">
                @include('offers.setting-menu')
                <div class="section section-content">
                    <div class="fb">@lang('offers.label.candidates_setting')</div>
                    <div class="mb11 section-description">@lang('offers.label.candidates_des')</div>
                    <input type='hidden' value='0' name='candidate_setting_option_1'>
                    <div class="section-fontsize candidate-setting">
                        <input type="checkbox"
                               name="candidate_setting_option_1"
                               id="candidate_option_1"
                               class="candidate-option"
                               value="1"
                               @if (!empty($dataRequestOffer) && $dataRequestOffer['candidate_setting_option_1'] === '1') checked @endif>
                        <label for="candidate_option_1"
                               style="cursor:pointer;">@lang('offers.label.candidates_option_1')</label>
                    </div>
                    <input type='hidden' value='0' name='candidate_setting_option_2'>
                    <div class="section-fontsize candidate-setting">
                        <input type="checkbox"
                               name="candidate_setting_option_2"
                               id="candidate_option_2"
                               class="candidate-option"
                               value="1"
                               @if (!empty($dataRequestOffer) && $dataRequestOffer['candidate_setting_option_2'] === '1') checked @endif>
                        <label for="candidate_option_2"
                               style="cursor:pointer;">@lang('offers.label.candidates_option_2')</label>
                    </div>
                    <div id="priority" class="box display-img mb22 ui-sortable row">
                        @foreach($members as $key => $member)
                            <div class="col-md-6">
                                <div class="favorite" id="lno_{{ $member->userProfile->user_id }}">
                                    <input type="hidden" name="member[]" value="{{ $member->userProfile->user_id }}">
                                    <div class="pri_handler section-fontsize mb11">
                                        {!! __('offers.label.setting_sort', ['setting_sort' => $key+1]) !!}
                                    </div>
                                    <div id="photo_area">
                                        <div class="img"><span class="mask" style="display: none;"></span>
                                            <a href="{{ route('member.detail', $member->userProfile->user_id) }}"
                                               target="_blank"
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
                                                <dd>{{ $member->userProfile->rank_name }}</dd>
                                            </div>
                                            <div class="form-group-setting">
                                                <dt class="section-description">@lang('users.label.member_no')：</dt>
                                                <dd>{{ $member->userProfile->user_id }}</dd>
                                            </div>
                                            <div class="form-group-setting">
                                                <dt class="section-description">@lang('users.label.area')：</dt>
                                                <dd>{{ $member->prefecture->first()->area->name }}</dd>
                                            </div>

                                        </dl>
                                        <ul class="list">
                                            <li><a href="javascript:void(0);"
                                                   data-url="{{ url('api/v1/offers', $member->id) }}"
                                                   data-id="lno_{{ $member->userProfile->user_id }}"
                                                   class="ulink">@lang('offers.label.candidate_delete')</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="clr clr-bottom-border"></div>
                <div class="d-flex mb-5 justify-content-center">
                    <a href="{{ route('home') }}"
                       class="btn btn-outline-secondary mr-3 w-150px btn-outline-secondary section-fontsize">
                        @lang('offers.label.back_to_list')</a>
                    <input type="submit"
                           disabled
                           class="btn btn-outline-secondary mr-3 w-150px btn-outline-secondary section-fontsize"
                           value="@lang('offers.label.next')">
                </div>
            </div>
        </div>
    </form>

    <div class="template__loading">
        <i class="icon icon__loading"></i>
    </div>

@endsection

@push('script')
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    {!! script(('js/offers.js')) !!}
@endpush
