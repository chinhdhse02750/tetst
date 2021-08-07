<header class="app-header navbar">
    <a class="logo-header-admin d-lg-none" href="{{route('admin.dashboard')}}">
        <img src="/images/logo_hn_taphoa.png" alt="Ha Noi Tap Hoa" class="logo-image">
    </a>
    <button class="navbar-toggler sidebar-toggler d-lg-none" type="button" data-toggle="sidebar-show">
        <span class="navbar-toggler-icon"></span>
    </button>

    <a class="logo-header-admin d-md-down-none" href="{{route('admin.dashboard')}}">
        <img src="/images/logo_hn_taphoa.png" alt="Ha Noi Tap Hoa" class="logo-image">
    </a>
    <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
        <span class="navbar-toggler-icon"></span>
    </button>

    {{--<ul class="nav navbar-nav">--}}
        {{--@if(config('locale.status') && count(config('locale.languages')) > 1)--}}
            {{--<li class="nav-item px-3 dropdown">--}}
                {{--<a class="nav-link dropdown-toggle nav-link" id="btn-language" data-toggle="dropdown" href="#" role="button"--}}
                   {{--aria-haspopup="true" aria-expanded="false">--}}
                    {{--<span class="" data-btn="btn-language">@lang('menus.language-picker.language')--}}
                        {{--({{ strtoupper(app()->getLocale()) }})</span>--}}
                {{--</a>--}}

                {{--@include('includes.partials.lang')--}}
            {{--</li>--}}
        {{--@endif--}}
    {{--</ul>--}}

    <ul class="nav navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" id="btn-account"
               aria-expanded="false">
                <img src="{{ asset('image/backend/avatar.png')}}" class="img-avatar" alt="#">
                <span style="margin-right:30px" class="d-md-down-none" data-btn="btn-account">{{ Auth::user()->name }}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" id="dropdown-account">
                <a class="dropdown-item" href="{{ route('admin.logout') }}">
                    <i class="fas fa-lock"></i>{{ __('Logout') }}
                </a>
            </div>
        </li>
    </ul>
</header>
