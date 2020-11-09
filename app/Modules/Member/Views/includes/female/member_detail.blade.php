<div class="container-detail">
    <div class="row">
        <div class="col-md-6">
            <div class="container-detail__slide container-detail__slide-public hidden_slide">
                <ul id="detailSlide" class="slide__container">
                    @if($member->has_image_public)
                        @foreach($member->image_public as $image)
                            <li
                                class="item__image-public"
                                data-exthumbimage="{{ $image->thumbnail_url }}"
                                data-src="{{ $image->media_url }}"
                                data-thumb="{{ $image->thumbnail_url }}">
                                <img src="{{ $image->media_url }}"/>
                            </li>
                        @endforeach
                    @else
                        <li
                            data-exthumbimage="/image/frontend/no_image.png"
                            data-src="/image/frontend/no_image.png"
                            data-thumb="/image/frontend/no_image.png">
                            <img src="/image/frontend/no_image.png"/>
                        </li>
                    @endif
                </ul>
            </div>
            @if($member->has_video)
                <div class="container-detail__gallery-video container-detail__slide hidden_slide">
                    <div class="container-detail__slide-title">
                        <svg xmlns="http://www.w3.org/2000/svg" width="19" height="14" viewBox="0 0 19 14">
                            <g transform="translate(-10.046 -12.114)">
                                <path fill="#C1C1C1"
                                      d="M2.412.25h9.047a2.3,2.3,0,0,1,2.262,2.334v9.332a2.3,2.3,0,0,1-2.262,2.334H2.412A2.3,2.3,0,0,1,.15,11.916V2.584A2.3,2.3,0,0,1,2.412.25Z"
                                      transform="translate(9.896 11.864)"/>
                                <path fill="#C1C1C1"
                                      d="M1,7.551,9.634,12.72a1.111,1.111,0,0,0,1.673-.976V1.407A1.11,1.11,0,0,0,9.634.432L1,5.6a1.106,1.106,0,0,0-.4.411A1.154,1.154,0,0,0,.6,7.14a1.106,1.106,0,0,0,.4.411Z"
                                      transform="translate(17.738 12.538)"/>
                            </g>
                        </svg>
                        <span>{{ $member->userProfile->name }}</span>@lang('users.label.of_video')
                    </div>
                    <!-- Hidden video div -->
                    @foreach($member->videos as $video)
                        <div style="display:none;" id="video{{ $video->id }}">
                            <video class="lg-video-object lg-html5" controls preload="none">
                                <source src="{{ $video->video_url }}" type="video/mp4">
                                Your browser does not support HTML5 video.
                            </video>
                        </div>
                    @endforeach
                    <ul id="galleryVideo" class="gallery-image__container">
                        @foreach($member->videos as $video)
                            <li class="gallery-image__item" data-poster="{{ $video->thumbnail_url }}"
                                data-html="#video{{ $video->id }}">
                                <img class="img-responsive" src="{{ $video->thumbnail_url }}"/>
                                <div class="gallery-poster">
                                    <img src="/image/frontend/icon/icon-video-play.svg">
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if($member->has_image_private)
                <div class="container-detail__gallery-image container-detail__slide hidden_slide">
                    <div class="container-detail__slide-title">
                        <svg xmlns="http://www.w3.org/2000/svg" width="19" height="16.625" viewBox="0 0 19 16.625">
                            <path fill="#C1C1C1"
                                  d="M19,36.156V46.844a1.782,1.782,0,0,1-1.781,1.781H1.781A1.782,1.782,0,0,1,0,46.844V36.156a1.782,1.782,0,0,1,1.781-1.781H5.047L5.5,33.154A1.779,1.779,0,0,1,7.17,32h4.657a1.779,1.779,0,0,1,1.666,1.154l.46,1.221h3.266A1.782,1.782,0,0,1,19,36.156ZM13.953,41.5A4.453,4.453,0,1,0,9.5,45.953,4.457,4.457,0,0,0,13.953,41.5Zm-1.188,0A3.266,3.266,0,1,1,9.5,38.234,3.27,3.27,0,0,1,12.766,41.5Z"
                                  transform="translate(0 -32)"/>
                        </svg>
                        @lang('users.label.private_photos')
                    </div>
                    <ul id="galleryImage" class="gallery-image__container">
                        @foreach($member->image_private as $image)
                            <li
                                class="item__image-private"
                                data-exthumbimage="{{ $image->thumbnail_url }}"
                                data-src="{{ $image->media_url }}"
                                data-thumb="{{ $image->thumbnail_url }}">
                                <img src="{{ $image->media_url }}"/>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="container-detail__schedule">
                <div class="container-detail__schedule-title">
                    <div class="container-detail__schedule-title--primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="19" height="18.572" viewBox="0 0 19 18.572">
                            <g id="icon-calender" opacity="0.181">
                                <path id="icon-calender-2"
                                      d="M0,16.7a1.869,1.869,0,0,0,1.869,1.869H17.131A1.869,1.869,0,0,0,19,16.7V7.475H0Zm2.492-6.009a.729.729,0,0,1,.727-.727H5.641a.729.729,0,0,1,.727.727v2.422a.729.729,0,0,1-.727.727H3.218a.729.729,0,0,1-.727-.727Zm14.639-8.2H14.873V.623A.625.625,0,0,0,14.25,0H13a.625.625,0,0,0-.623.623V2.492H6.619V.623A.625.625,0,0,0,6,0H4.75a.625.625,0,0,0-.623.623V2.492H1.869A1.869,1.869,0,0,0,0,4.361V6.23H19V4.361A1.869,1.869,0,0,0,17.131,2.492Z"/>
                            </g>
                        </svg>
                        @lang('users.label.schedule')
                    </div>
                    <div class="container-detail__schedule-title--sub">@lang('users.label.schedule_subtitle')</div>
                </div>
                <div
                    id="memberSchedule"
                    data-noon-ok="@lang('users.label.noon_ok')"
                    data-night-ok="@lang('users.label.night_ok')"
                    data-lang="{{ lang_schedule() }}"
                    data-schedules="{{ $member->data_schedules }}"></div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="detail__rank">
                {!! $member->userProfile->rank_button !!}
                {!! $member->userProfile->label_member !!}
            </div>
            <div class="detail__name">
                <h1>{{ $member->userProfile->name }}</h1>
                <span class="detail__about {{ App::getLocale() }}">{!! $member->userProfile->full_about !!}</span>
            </div>
            @if ($member->userProfile->rating_star)
                <div class="detail__rate">
                    <div class="detail__rate-container">
                        @include('includes.rating', ['rating' => $member->userProfile->rating_star_calc])
                    </div>
                    <a class="js-star-rating js-modal" data-target-modal="detail__star-rating-modal"
                       href="javascript:void(0)">@lang('users.label.about_star_rating')</a>
                    <div class="detail__star-rating-modal detail__modal">
                        <div class="modal-custom">
                            <div class="modal-custom__overlay"></div>
                            <div class="modal-custom__container">
                                @if ( Config::get('app.locale') == 'en')
                                    @include('includes.modal.en.rating_star')
                                @else
                                    @include('includes.modal.jp.rating_star')
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="detail__bt-area">
                @if(in_array($member->id, $idSetting))
                    <button type="button" data-id="{{ $member->id }}"
                            class="btn btn-outline-secondary btn-request-setting-on disabled request-setting-disabled">
                        @lang('users.label.added_setting_list')
                    </button>
                @else
                    {!! $member->request_button !!}
                @endif
                <input type="hidden" value="{{ url('api/v1/offers', $member->id) }}" id="url-request-setting">

            </div>
            <div class="detail__dating-type">
                <div class="detail__dating-type--shot-name {{ App::isLocale('en') ? 'en-detail__dating': '' }}">
                    @lang('users.label.dating_type')
                    <span class="dating-type__label">{{ $member->userProfile->dating_type_label }}</span>
                </div>
                <div class="detail__dating-type--container">
                    <div class="detail__dating-type--title">{{ $member->userProfile->dating_type_title }}<a
                            class="js-dating-type js-modal" data-target-modal="detail__dating-type-modal"
                            href="javascript:void(0)">@lang('users.label.about_dating_type')</a></div>
                    <div class="detail__dating-type--description">
                        {{ $member->userProfile->dating_type_description }}
                    </div>
                </div>
                <div class="detail__dating-type-modal detail__modal">
                    <div class="modal-custom">
                        <div class="modal-custom__overlay"></div>
                        <div class="modal-custom__container">
                            @if ( Config::get('app.locale') == 'en')
                                @include('includes.modal.en.dating_type_description')
                            @else
                                @include('includes.modal.jp.dating_type_description')
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="detail__profile">
                <div class="detail__profile-title">@lang('users.label.basic_data')</div>
                <div class="detail__profile-container">
                    <table>
                        <tr>
                            <td>@lang('users.label.area') ：</td>
                            <td>{{ $member->prefecture->first()->area->name }}</td>
                        </tr>
                        @if (!empty($member->userProfile->address))
                            <tr>
                                <td>@lang('users.label.address') ：</td>
                                <td>{{ $member->userProfile->address }}</td>
                            </tr>
                        @endif
                        @if (!empty($member->userProfile->occupation))
                            <tr>
                                <td>@lang('users.label.occupation') ：</td>
                                <td>{{ $member->userProfile->occupation }}</td>
                            </tr>
                        @endif
                        @if (!empty($member->userProfile->hobby))
                            <tr>
                                <td>@lang('users.label.hobby') ：</td>
                                <td>{{ $member->userProfile->hobby }}</td>
                            </tr>
                        @endif
                        @if (!empty($member->userProfile->sign_label))
                            <tr>
                                <td>@lang('users.label.sign') ：</td>
                                <td>{{ $member->userProfile->sign_label }}</td>
                            </tr>
                        @endif
                        @if (!empty($member->userProfile->blood_type_label))
                            <tr>
                                <td>@lang('users.label.blood_type') ：</td>
                                <td>{{ $member->userProfile->blood_type_label }}</td>
                            </tr>
                        @endif
                        @if (!empty($member->userProfile->smoking_female_label))
                            <tr>
                                <td>@lang('users.label.smoking') ：</td>
                                <td>{{ $member->userProfile->smoking_female_label }}</td>
                            </tr>
                        @endif
                        @if (!empty($member->userProfile->alcohol_label))
                            <tr>
                                <td>@lang('users.label.alcohol') ：</td>
                                <td>{{ $member->userProfile->alcohol_label }}</td>
                            </tr>
                        @endif
                        <tr>
                            <td>@lang('users.label.created_at') ：</td>
                            <td>{{ \Carbon\Carbon::parse($member->created_at)->translatedFormat('Y-m-d') }}</td>
                        </tr>
                        <tr>
                            <td>@lang('users.label.member_no') ：</td>
                            <td>{{ $member->id }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="detail__offer">
                <div class="detail__offer-title">@lang('users.label.about_the_offer')</div>
                <div class="detail__offer-container">
                    {!! html_entity_decode($member->userProfile->offer) !!}
                </div>
            </div>
            @if (!empty($member->userProfile->comment))
                <div class="detail__comment detail__my-comment">
                    <div class="detail__comment-title detail__my-comment-title">
                        <span>{{ $member->userProfile->name }}</span>@lang('users.label.of_comment')</div>
                    <div class="detail__comment-container detail__my-comment-container">
                        {!! html_entity_decode($member->userProfile->comment) !!}
                    </div>
                </div>
            @endif
            @if (!empty($member->userProfile->club_comment))
                <div class="detail__comment detail__club-comment">
                    <div
                        class="detail__comment-title detail__club-comment-title">@lang('users.label.club_comment')</div>
                    <div class="detail__comment-container detail__club-comment-container">
                        {!! html_entity_decode($member->userProfile->club_comment) !!}
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

@section('custom_script')
    {!! script(('js/detailMember.js')) !!}
@stop
