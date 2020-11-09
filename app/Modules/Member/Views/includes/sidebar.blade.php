@if(\Request::is('profile*'))
    <div id="local_navi">
        <div class="box-content">

            <div id="local_navi_container" class="member">MEMBER INFO</div>
            <div id="local_navi_container_inner">
                <ul class="list">
                    <li><a href="{{ route('profile.index') }}"
                           class="{{ active_class(Route::is('profile.index')) }}">@lang('labels.menu.register_info')</a>
                    </li>
                    <li><a href="{{ route('profile.password') }}"
                           class="{{ active_class(Route::is('profile.password')) }}">@lang('labels.menu.change_password')</a>
                    </li>
                </ul>
                <div class="clr"></div>
            </div>
        </div>
    </div>
@endif

@if(\Request::is('history*'))
    <div id="local_navi">
        <div class="box-content">
            <div id="local_navi_container" class="member">@lang('offers.label.history')</div>
            <div id="local_navi_container_inner">
                <ul class="list">
                    <li><a href="{{ route('history.index') }}"
                           class="{{ active_class(Route::is('history.index')) }}">@lang('offers.label.offer_history')</a>
                    </li>
                </ul>
                <div class="clr"></div>
            </div>
        </div>
    </div>
@endif

