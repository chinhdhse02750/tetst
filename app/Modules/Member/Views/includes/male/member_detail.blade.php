<div class="container-detail">
    <div class="row">
        <div class="col-md-6">
            <div class="container-detail__slide container-detail__slide-public hidden_slide">
                <ul id="detailSlide" class="slide__container">
                    @if ($member->userProfile->publish_profile)
                        @if($member->has_image_public)
                            @foreach($member->image_public as $image)
                                <li
                                    class="item__image-public"
                                    data-exthumbimage="{{ $image->thumbnail_url }}"
                                    data-src="{{ $image->media_url }}"
                                    data-thumb="{{ $image->thumbnail_url }}">
                                    <img src="{{ $image->media_url }}" />
                                </li>
                            @endforeach
                        @else
                            <li
                                data-exthumbimage="/image/frontend/no_image.png"
                                data-src="/image/frontend/no_image.png"
                                data-thumb="/image/frontend/no_image.png">
                                <img src="/image/frontend/no_image.png" />
                            </li>
                        @endif
                    @else
                        <li
                                data-exthumbimage="/image/frontend/no_image.png"
                                data-src="/image/frontend/no_image.png"
                                data-thumb="/image/frontend/no_image.png">
                            <img src="/image/frontend/no_image.png" />
                        </li>
                    @endif
                </ul>
            </div>
            <div class="detail__schedule-calendar"></div>
        </div>
        <div class="col-md-6">
            @if ($member->userProfile->publish_profile)
                <div class="detail__rank">
                    {!! $member->userProfile->rank_button !!}
                </div>
            @endif
            <div class="detail__name">
                <h1>{{ $member->userProfile->name }}</h1>
                <span class="detail__about">{!! $member->userProfile->male_age_label !!}</span>
            </div>
            <div class="detail__profile">
                <div class="detail__profile-title">@lang('users.label.basic_data')</div>
                <div class="detail__profile-container">
                    <table>
                        @if ($member->userProfile->publish_profile)
                            @if (!empty($member->userProfile->birthday_label))
                            <tr>
                                <td>@lang('users.label.birthday') ：</td>
                                <td>{{ $member->userProfile->birthday_label }}</td>
                            </tr>
                            @endif
                            @if (!empty($member->userProfile->tel))
                            <tr>
                                <td>@lang('users.label.tel') ：</td>
                                <td>{{ $member->userProfile->tel }}</td>
                            </tr>
                            @endif
                            @if (!empty($member->userProfile->line_id))
                            <tr>
                                <td>@lang('users.label.line_id') ：</td>
                                <td>{{ $member->userProfile->line_id }}</td>
                            </tr>
                            @endif
                            @if (!empty($member->userProfile->favorite_dating_type_label))
                            <tr>
                                <td>@lang('users.label.favorite_dating_type') ：</td>
                                <td>{{ $member->userProfile->favorite_dating_type_label }}</td>
                            </tr>
                            @endif
                            @if (!empty($member->userProfile->address))
                            <tr>
                                <td>@lang('users.label.address') ：</td>
                                <td>{{ $member->userProfile->address }}</td>
                            </tr>
                            @endif
                            {{-- occupation --}}
                            @if (!empty($member->userProfile->occupation))
                                <tr>
                                    <td>@lang('users.label.occupation') ：</td>
                                    <td>{{ $member->userProfile->occupation }}</td>
                                </tr>
                            @endif
                            {{-- income --}}
                            @if (!empty($member->userProfile->income_label))
                                <tr>
                                    <td>@lang('users.label.income') ：</td>
                                    <td>{{ $member->userProfile->income_label }}</td>
                                </tr>
                            @endif
                            {{-- hobby --}}
                            @if (!empty($member->userProfile->hobby))
                                <tr>
                                    <td>@lang('users.label.hobby') ：</td>
                                    <td>{{ $member->userProfile->hobby }}</td>
                                </tr>
                            @endif
                            {{-- blood type --}}
                            @if (!empty($member->userProfile->blood_type_label))
                                <tr>
                                    <td>@lang('users.label.blood_type') ：</td>
                                    <td>{{ $member->userProfile->blood_type_label }}</td>
                                </tr>
                            @endif
                            {{-- male smoking --}}
                            @if (!empty($member->userProfile->smoking_male_label))
                            <tr>
                                <td>@lang('users.label.smoking') ：</td>
                                <td>{{ $member->userProfile->smoking_male_label }}</td>
                            </tr>
                            @endif
                            {{-- male alcohol --}}
                            @if (!empty($member->userProfile->male_alcohol))
                            <tr>
                                <td>@lang('users.label.alcohol') ：</td>
                                <td>{{ $member->userProfile->male_alcohol }}</td>
                            </tr>
                            @endif
                            <tr>
                                <td>@lang('users.label.created_at') ：</td>
                                <td>{{ \Carbon\Carbon::parse($member->created_at)->translatedFormat('Y-m-d') }}</td>
                            </tr>
                        @endif
                        <tr>
                            <td>@lang('users.label.member_no') ：</td>
                            <td>{{ $member->id }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            @if ($member->userProfile->publish_profile)
                @if (!empty($member->userProfile->comment))
                <div class="detail__comment detail__my-comment">
                    <div class="detail__comment-title detail__my-comment-title"><span>{{ $member->userProfile->name }}</span>@lang('users.label.of_comment')</div>
                    <div class="detail__comment-container detail__my-comment-container">
                        {!! html_entity_decode($member->userProfile->comment) !!}
                    </div>
                </div>
                @endif
            @endif
        </div>
    </div>
</div>
