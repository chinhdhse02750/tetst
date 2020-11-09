<ul class="menu-primary">
    <li><a class="dropdown-item" href="{{ route('history.index') }}">@lang('top_header.label.application_history')</a></li>
    <li><a class="dropdown-item" href="{{ route('balance.index') }}">@lang('top_header.label.point_info')</a></li>
    <li><a class="dropdown-item" href="{{ route('profile.index') }}">@lang('top_header.label.profile')</a></li>
    <li><a class="dropdown-item" href="{{ route('contact.index') }}">@lang('top_header.label.contact')</a></li>
    <li><div class="dropdown-divider"></div></li>
    <li>
        <a class="dropdown-item dropdown-item__user dropdown-item__logout" href="{{ route('logout') }}">
            <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" width="11" height="11.252" viewBox="0 0 11 11.252">
                <path d="M9.7,2.228a.088.088,0,0,0-.128.022l-.382.683a.082.082,0,0,0,.022.105A4.572,4.572,0,1,1,2.834,9.449a4.606,4.606,0,0,1,.952-6.412.082.082,0,0,0,.021-.106l-.382-.684a.1.1,0,0,0-.08-.038.069.069,0,0,0-.043.012,5.54,5.54,0,0,0-2.23,5.41A5.5,5.5,0,0,0,3.3,11.221a5.479,5.479,0,0,0,7.67-1.286A5.548,5.548,0,0,0,9.7,2.228Z" transform="translate(-0.996 -1)"/>
                <path d="M.082,0H.86A.083.083,0,0,1,.943.083V5.917A.083.083,0,0,1,.86,6H.082A.082.082,0,0,1,0,5.918V.082A.082.082,0,0,1,.082,0Z" transform="translate(5.03)"/>
            </svg>
            <span>@lang('top_header.label.logout')</span>
        </a>
    </li>
</ul>
