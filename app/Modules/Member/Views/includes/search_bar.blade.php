<div class="search">
    <form class="search-form" method="GET" action="{{ route('home') }}">
        <div class="search-input form-group">
            <button type="submit" class="search-input__submit">
                <svg xmlns="http://www.w3.org/2000/svg" width="23.108" height="23.414" viewBox="0 0 23.108 23.414">
                    <g transform="translate(1 1)">
                        <circle cx="9" cy="9" r="9" fill="none" stroke="#606060" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2"/>
                        <path d="M5,5,0,0" transform="translate(15.693 15.999)" fill="none" stroke="#606060" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2"/>
                    </g>
                </svg>
            </button>
            <input type="search" name="search" id="search-input" class="form-control"
                   placeholder="{{ Auth::user()->female ? trans('placeholder.member.search.male_user') : trans('placeholder.member.search.female_user') }}"
                   value="{{ request('search') }}"/>
            <a href="#menu-mobile" class="menu-mobile__button-toggle d-md-none"></a>
        </div>
    </form>
    <div class="search-more">
        <div class="search-list">
            <a class="search-favorite text-body link-page" href="{{ route('favorites') }}">
                <svg id="icon-heart" xmlns="http://www.w3.org/2000/svg" width="17.35" height="16.266" viewBox="0 0 17.35 16.266">
                    <path d="M8.775,1.525c4.812-4.947,16.845,3.71,0,14.841C-8.07,5.236,3.962-3.422,8.775,1.525Z" transform="translate(-0.1 -0.1)" fill="#f75d5d" fill-rule="evenodd"/>
                </svg>
                <span class="text--small">@lang('top_header.label.favorite_list')</span>
            </a>
            <div class="search-candidate">
                <span class="count__candidate">{{ $countSetting }}</span>
                <span class="text--small">@lang('labels.menu.select_setting')</span>
            </div>
        </div>
        <div class="search-setting">
            <span class="button__search-setting"><a href="{{ route('offer.index') }}">@lang('labels.menu.apply_setting')</a></span>
        </div>
    </div>
</div>
