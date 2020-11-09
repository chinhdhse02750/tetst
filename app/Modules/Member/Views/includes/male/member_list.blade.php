<div class="main-container__list-item">
    <div class="row">
        @if(!empty($members))
            @foreach($members as $member)
                <div class="col-md-2">
                    <div class="item-detail {{ App::getLocale() }}">
                        <div class="item-detail__image">
                            <a href="{{ route('member.detail', $member->user_id) }}" class="item-detail__image-link js-item-detail__image-link">{!! $member->profile_image !!}</a>
                            {!! $member->user->favorite_label !!}
                        </div>
                        <div class="item-detail__body">
                            <div class="item-detail__meta">
                                <a href="{{ route('member.detail', $member->user_id) }}" class="item-detail__title">{{ $member->name }}</a>
                            </div>
                            <div class="item-detail__description">{!! $member->short_comment !!}</div>
                            <div class="item-detail__footer">
                                <div class="item-detail__status-member">{!! $member->rank_button !!}</div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>
