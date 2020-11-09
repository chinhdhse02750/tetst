<div class="main-container__list-item">
    <div class="row">
        @if(!empty($members))
            @foreach($members as $member)
                <div class="col-md-2">
                    <div class="item-detail {{ App::getLocale() }}">
                        <div class="item-detail__image">
                            <a href="{{ route('member.detail', $member->user_id) }}" class="item-detail__image-link js-item-detail__image-link">{!! $member->profile_image !!}</a>
                            {!! $member->label_member !!}

                            {!! $member->user->favorite_label !!}
                        </div>
                        <div class="item-detail__body">
                            <div class="item-detail__meta">
                                <a href="{{ route('member.detail', $member->user_id) }}" class="item-detail__title">{{ $member->name }}</a>
                                <div class="item-detail__age">{{ $member->age_label }}</div>
                            </div>
                            <div class="item-detail__type">
                                {{ !empty($member->occupation) ? $member->occupation : '' }}
                            </div>
                            <div class="item-detail__description">{!! $member->short_comment !!}</div>
                            <div class="item-detail__footer">
                                <div class="item-detail__status-member">{!! $member->rank_button !!}</div>
                                <div class="item-detail__short-status">
                                    <button
                                        class="button__user-type button__user-type-icon--square button__bg--silver text--small"
                                        data-toggle="tooltip"
                                        data-html="true"
                                        title="<span class='tooltip__dating-type text--small'>@lang('filters.member.dating_type')</span>">
                                        {{ !empty($member->dating_type) ? $member->dating_type : '' }}
                                    </button>
                                </div>
                                @if($member->user->has_video)
                                    <div class="item-detail__video">
                                        <a
                                            href="javascript:void(0)"
                                            class="item-detail__video-icon item-detail__media-icon js-item-detail__video"
                                            data-id="{{ $member->user_id }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="19" height="14" viewBox="0 0 19 14">
                                                <g transform="translate(-10.046 -12.114)">
                                                    <path d="M2.412.25h9.047a2.3,2.3,0,0,1,2.262,2.334v9.332a2.3,2.3,0,0,1-2.262,2.334H2.412A2.3,2.3,0,0,1,.15,11.916V2.584A2.3,2.3,0,0,1,2.412.25Z" transform="translate(9.896 11.864)"/>
                                                    <path d="M1,7.551,9.634,12.72a1.111,1.111,0,0,0,1.673-.976V1.407A1.11,1.11,0,0,0,9.634.432L1,5.6a1.106,1.106,0,0,0-.4.411A1.154,1.154,0,0,0,.6,7.14a1.106,1.106,0,0,0,.4.411Z" transform="translate(17.738 12.538)"/>
                                                </g>
                                            </svg>
                                        </a>
                                    </div>
                                @endif
                                @if($member->user->has_image_private)
                                    <div class="item-detail__capture">
                                        <a
                                            href="javascript:void(0)"
                                            class="item-detail__capture-icon item-detail__media-icon js-item-detail__capture"
                                            data-id="{{ $member->user_id }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="19" height="16.625" viewBox="0 0 19 16.625">
                                                <path d="M19,36.156V46.844a1.782,1.782,0,0,1-1.781,1.781H1.781A1.782,1.782,0,0,1,0,46.844V36.156a1.782,1.782,0,0,1,1.781-1.781H5.047L5.5,33.154A1.779,1.779,0,0,1,7.17,32h4.657a1.779,1.779,0,0,1,1.666,1.154l.46,1.221h3.266A1.782,1.782,0,0,1,19,36.156ZM13.953,41.5A4.453,4.453,0,1,0,9.5,45.953,4.457,4.457,0,0,0,13.953,41.5Zm-1.188,0A3.266,3.266,0,1,1,9.5,38.234,3.27,3.27,0,0,1,12.766,41.5Z" transform="translate(0 -32)"/>
                                            </svg>
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>
