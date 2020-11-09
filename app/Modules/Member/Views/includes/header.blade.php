<div class="header">
    @auth
    <div class="header__primary d-none d-md-block">
        <div class="header-wrap container-wrap">
            <div class="row">
                <div class="col-md-3">
                    <div class="header__slogan">
                        <div class="marquee"></div>
                    </div>
                </div>
                <div class="col">
                    <div class="header__statistic">
                        <span class="text--small">
                            @if(!empty($userPrefectures))
                                <span class="mr-3">
                                    @lang('top_header.label.total_users'):
                                    {{ !empty($userPrefectures['total']) ? $userPrefectures['total'] : '0' }}
                                    @lang('top_header.label.people')
                                </span>
                                @foreach($userPrefectures as $userPrefecture)
                                    @if(!empty($userPrefecture->total) && !empty($userPrefecture->name))
                                        <span class="mr-3">
                                            {{ $userPrefecture->name }}:
                                            <a href="javascript:void(0)" class="area-filter text-white"
                                               id="{{ $userPrefecture->prefecture_id }}">
                                                {{ $userPrefecture->total }} @lang('top_header.label.people')
                                            </a>
                                            <input type="hidden" name="prefecture_ids[{{ $userPrefecture->prefecture_id }}]"
                                                   data-name="{{ $userPrefecture->name }}"
                                                   value="{{ $userPrefecture->prefecture_id }}">
                                        </span>
                                    @endif
                                @endforeach
                            @endif
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endauth

    <div class="header__secondary">
        <div class="header-wrap container-wrap">
            <div class="row">
                <div class="col-md-6">
                    <div class="header__logo">
                        <a href="{{ route('home') }}">
                            <h1>{{ config('app.name', 'Oriental Club') }}</h1>
                            <img class="d-none d-md-block" src="/image/frontend/logo_primary.svg" alt="Oriental Club">
                            <img class="d-md-none" src="/image/frontend/logo_mob.svg" alt="Oriental Club">
                        </a>
                        <div class="header__logo-slogan">
                            <span class="text--small">@lang('top_header.label.member_page')</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 d-none d-md-block">
                    <div class="header__information">
                        @guest
                            <ul class="header__menu-login">
                                <li class="nav-item">
                                    <a href="{{ route('member.lang', 'jp') }}" class="nav-link">@lang('top_header.label.japanese')</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('member.lang', 'en') }}" class="nav-link">English</a>
                                </li>
                            </ul>
                        @else
                            <div class="header__language">
                                <a href="#" class="header__dropdown--language dropdown-toggle" role="button" id="headerLanguageDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="icon icon__global"></i>
                                </a>

                                <div class="header__dropdown--menu text--medium dropdown-menu" aria-labelledby="headerLanguageDropdown">
                                    <a href="{{ route('member.lang', 'jp') }}" class="dropdown-item">@lang('top_header.label.japanese')</a>
                                    <a href="{{ route('member.lang', 'en') }}" class="dropdown-item">English</a>
                                </div>
                            </div>
                            <div class="header__help">
                                <a href="#" class="header__dropdown--help dropdown-toggle" role="button" id="headerHelpDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    @lang('top_header.label.help')
                                </a>
                                <div class="header__dropdown--menu dropdown-menu" aria-labelledby="headerHelpDropdown">
                                    <a class="dropdown-item" href="#">@lang('top_header.label.membership_policy')</a>
                                    <a class="dropdown-item" href="#">@lang('top_header.label.payment')</a>
                                    <a class="dropdown-item" href="#">@lang('top_header.label.faq')</a>
                                    <a class="dropdown-item" href="{{ route('contact.index') }}">@lang('top_header.label.contact')</a>
                                </div>
                            </div>
                            <div class="header__point">
                                <a class="button__point--square dropdown-toggle"
                                   href="{{ route('balance.index') }}">{!! Auth::user()->total_amount_label !!}</a>

                            </div>
                            <div class="header__user">
                                {{--<div class="header__user-type">{!! Auth::user()->userProfile->rank->rank_button !!}</div>--}}
                                <div class="header__user-menu">
                                    <a href="#" class="header__dropdown--user dropdown-toggle" role="button" id="headerUserDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        {{ !empty(Auth::user()->userProfile->name) ? Auth::user()->userProfile->name : '' }}
                                    </a>
                                    <div class="header__dropdown--menu dropdown-menu dropdown-menu-right" aria-labelledby="headerUserDropdown">
                                    @include('includes.menu')
                                    </div>
                                </div>
                            </div>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
