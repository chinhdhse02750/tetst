<div class="top_body" >
    <div class="right-menu">
            <div class="search wt-input">
                <div class="search-more">
                    <div class="search-list">
                        <a class="search-favorite text-body link-page" href="{{ route('favorites') }}">
                            <svg id="icon-heart" xmlns="http://www.w3.org/2000/svg" width="17.35" height="16.266" viewBox="0 0 17.35 16.266">
                                <path d="M8.775,1.525c4.812-4.947,16.845,3.71,0,14.841C-8.07,5.236,3.962-3.422,8.775,1.525Z" transform="translate(-0.1 -0.1)" fill="#f75d5d" fill-rule="evenodd"/>
                            </svg>
                            <span class="text--small">@lang('top_header.label.favorite_list')</span>
                        </a>
                        <div class="search-candidate">
                            <span class="count__candidate"></span>
                            <span class="text--small">@lang('labels.menu.select_setting')</span>
                        </div>
                    </div>
                    <div class="search-setting">
                        <span class="button__search-setting"><a href="{{ route('offer.index') }}">@lang('labels.menu.apply_setting')</a></span>
                    </div>
                </div>
            </div>
    </div>
</div>
