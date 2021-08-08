<div class="sidebar">
    <div class="list-member">
        @if (!empty($newMembers))
            <h6>@lang('users.label.new_member')</h6>
            @foreach($newMembers as $member)
                <div class="row mt-1 item">
                    <div class="col-md-4">
                        <div class="item-image">
                            {!! $member->userProfile->profile_image  !!}
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="item-info mt-1">
                            @if(!empty($member->userProfile->dating_type))
                                <span class="item-dating-type">{{ $member->userProfile->dating_type }}</span>
                            @endif
                            <span>
                                {{ !empty($member->userProfile) ? $member->userProfile->name : '' }}
                            </span>
                            @if(!empty($member->userProfile->age))
                                <span>({{ $member->userProfile->age }})</span>
                            @endif
                        </div>
                        <div class="item-link-detail">
                            <a href="{{ route('member.detail', $member->id) }}">@lang('users.link_to_profile')</a>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    <div class="list-banner">
        @if(!empty($banners))
            @foreach($banners as $banner)
                <div class="item-banner">
                    <a href="{{ $banner->image }}" class="footer_item-link" target="_blank">
                        <img src="{{ $banner->image }}" alt="{{ $banner->image }}">
                    </a>
                </div>
            @endforeach
        @endif
    </div>
</div>
