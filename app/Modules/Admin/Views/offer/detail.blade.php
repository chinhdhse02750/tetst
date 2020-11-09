@extends('layouts.admin')

@section('content')
    <div id="singlecolumn" class="card p-lg-4">
        <div class="container">
            <div class="section">
                <div class="title-area mb-2">
                    <div class="left-area">
                        <h4 class="font-bold">@lang('offers.label.candidates_setting')</h4>
                    </div>
                </div>
                <div class="section-fontsize">
                    <input type="checkbox"
                           name="candidate_setting_option_1"
                           id="candidate_option_1"
                           value="1" disabled
                           @if (!empty($offer) && $offer->candidate_setting_option_1 === 1) checked @endif/>
                    <label for="candidate_option_1"
                           style="cursor:pointer;">@lang('offers.label.candidates_option_1')</label>
                </div>
                <div class="section-fontsize">
                    <input type="checkbox"
                           name="candidate_setting_option_2"
                           id="candidate_option_2"
                           value="1" disabled
                           @if (!empty($offer) && $offer->candidate_setting_option_2 === 1) checked @endif/>
                    <label for="candidate_option_2"
                           style="cursor:pointer;">@lang('offers.label.candidates_option_2')</label>
                </div>
                <div id="priority" class="row m-lg-5">
                    @foreach($userOffers as $key => $member)
                        <div class="col-md-6 mt-4">
                            <div class="item-header">
                                {!! __('offers.label.setting_sort', ['setting_sort' => $key+1]) !!}
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="image-setting-list">
                                        <a href="{{ route('member.show', ['id'=>$member->id, 'type_user'=> $member->type_name]) }}">{!! $member->userProfile->profile_image !!}</a>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="member-id">
                                        @lang('offers.label.member_id') :
                                        <a href="{{ route('member.show', ['id'=>$member->id, 'type_user'=> $member->type_name] ) }}">
                                            {{ $member->id }}
                                        </a>
                                    </div>
                                    <div class="member-id"> @lang('offers.label.member_name') : {{ $member->userProfile->name }}</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="section mt-lg-5">
                <div class="title-area">
                    <div class="left-area">
                        <h4 class="font-bold">@lang('offers.label.select_date_time')</h4>
                    </div>
                </div>
                <table class="table table-bordered">
                    <tbody>
                    <tr>
                        <td width="20%" class="" >@lang('offers.label.desired_option1')</td>
                        <td class="right_area">
                            <div class="inlinebox section-fontsize">
                                <span>
                                    @if(!empty($offer->desired_option_1))
                                        {{ \Carbon\Carbon::parse($offer->desired_option_1)->format('Y/m/d H:i') }}
                                    @endif
                                </span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="">@lang('offers.label.desired_option2')</td>
                        <td>
                            <div class="inlinebox section-fontsize">
                                @if(!empty($offer->desired_option_2))
                                    {{ \Carbon\Carbon::parse($offer->desired_option_2)->format('Y/m/d H:i') }}
                                @endif
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="">@lang('offers.label.desired_option3')</td>
                        <td>
                            <div class="inlinebox section-fontsize">
                                @if(!empty($offer->desired_option_3))
                                    {{ \Carbon\Carbon::parse($offer->desired_option_3)->format('Y/m/d H:i') }}
                                @endif
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td class="">@lang('offers.label.desired_option4')</td>
                        <td>
                            <div class="inlinebox section-fontsize">
                                @if(!empty($offer->desired_option_4))
                                    {{ \Carbon\Carbon::parse($offer->desired_option_4)->format('Y/m/d H:i') }}
                                @endif
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="">@lang('offers.label.desired_option5')</td>
                        <td>
                            <div class="inlinebox section-fontsize">
                                @if(!empty($offer->desired_option_5))
                                    {{ \Carbon\Carbon::parse($offer->desired_option_5)->format('Y/m/d H:i') }}
                                @endif
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>

                <div class="title-area fb mt-5 mb-3">
                    <div class="left-area">
                        <h4 class="font-bold">@lang('offers.label.select_data_time_other')</h4>
                    </div>
                </div>
                <textarea name="desired_content" id="place-area" disabled
                          class="form-control col-md-7" rows="5">@if(!empty($offer->desired_content)){{ $offer->desired_content }}@endif</textarea>
                <div class="title-area fb mt-5 mb-3">
                    <div class="left-area">
                        <h4 class="font-bold">@lang('offers.label.request_for_women')</h4>
                    </div>

                </div>
                <div class="pl-3">
                    @foreach($requestSetting[App::getLocale()] as $key => $value)
                        <div>
                            <input type="checkbox" disabled
                                   @if (!empty($offer->request_option) && in_array($key, explode(',' ,$offer->request_option)))
                                   checked
                                @endif>
                            <span>{{ $value }}</span>
                        </div>
                    @endforeach
                </div>

                <div class="fb mb-3 mt-3">【@lang('users.label.other')】</div>
                <textarea name="request_other" id="request-other" disabled
                          class="form-control col-md-7" rows="5">@if(!empty($offer->request_other)){{ $offer->request_other }}@endif
                 </textarea>

                <div class="title-area mt-5 mb-3">
                    <div class="left-area">
                        <h4 class="font-bold">@lang('offers.label.request_admin')</h4>
                    </div>

                </div>
                <textarea name="request_admin" id="request-admin" disabled
                          class="form-control col-md-7" rows="5">@if(!empty($offer->request_admin)){{ $offer->request_admin }}@endif
                 </textarea>
            </div>
            <div class="d-flex justify-content-left mt-4">
                <a href="{{ route('offers.index') }}" class="btn btn-primary"> @lang('labels.general.back')</a>
            </div>
        </div>
    </div>
@endsection

@section('pagespecificscripts')
    <script>
        var lazyLoadInstance = new LazyLoad({
            elements_selector: ".lazy"
        });
        lazyLoadInstance.update();
    </script>
@endsection
