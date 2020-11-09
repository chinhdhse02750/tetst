<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="/image/logo.png">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', app_name())</title>

    <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="/css/lightslider.min.css"/>
    <link type="text/css" rel="stylesheet" href="/css/lightgallery.min.css"/>
    @stack('styles')
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/member.css" rel="stylesheet">
    <link href="/css/offers.css" rel="stylesheet">
    <link href="/css/sidebar.css" rel="stylesheet">
    @yield('custom_style')
    <script>
        let news = {
            @if(!empty($news))
                @foreach($news as $key => $itemNews)
            "{{ $key }}": {
                "content": "{!! $itemNews->content_label !!}",
                "direction": "{{ \Illuminate\Support\Arr::get($itemNews, 'direction') }}",
            },
            @endforeach
            @endif
        };
    </script>
</head>
<body>
<div id="app">
    @include('includes.header')
    <div class="row">
        <div class="col-md-2 left-sidebar pr-md-0 ml-md-0 d-none d-md-block">
            @yield('sidebar')
            @include('includes.left_sidebar')
        </div>
        <div class="col-md-10 right-content">
            @auth
                @if(!\Request::is('offers*'))
                    @include('includes.top_body_wt_search')
                @endif
            @endauth
            <div class="body @guest body-wrap__guest @endguest" style="min-height: 500px">
                <div class="row">
                    <div class="col-sm-12 col-12">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>
    @auth
        @include('includes.footer')
    @endauth
</div>
@auth
    <div id="menu-mobile">
        <ul>
            <li><a class="dropdown-item" href="#">お申し込み履歴</a></li>
            <li><a class="dropdown-item" href="#">ポイント情報</a></li>
            <li><a class="dropdown-item" href="#">登録情報変更</a></li>
            <li><a class="dropdown-item" href="#">お問い合わせ</a></li>
            <li>
                <div class="dropdown-divider"></div>
            </li>
            <li><a class="dropdown-item dropdown-item__user dropdown-item__logout" href="#">
                    <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" width="11" height="11.252"
                         viewBox="0 0 11 11.252">
                        <path
                            d="M9.7,2.228a.088.088,0,0,0-.128.022l-.382.683a.082.082,0,0,0,.022.105A4.572,4.572,0,1,1,2.834,9.449a4.606,4.606,0,0,1,.952-6.412.082.082,0,0,0,.021-.106l-.382-.684a.1.1,0,0,0-.08-.038.069.069,0,0,0-.043.012,5.54,5.54,0,0,0-2.23,5.41A5.5,5.5,0,0,0,3.3,11.221a5.479,5.479,0,0,0,7.67-1.286A5.548,5.548,0,0,0,9.7,2.228Z"
                            transform="translate(-0.996 -1)"/>
                        <path
                            d="M.082,0H.86A.083.083,0,0,1,.943.083V5.917A.083.083,0,0,1,.86,6H.082A.082.082,0,0,1,0,5.918V.082A.082.082,0,0,1,.082,0Z"
                            transform="translate(5.03)"/>
                    </svg>
                    <span>ログアウト</span>
                </a></li>
        </ul>
    </div>
@endauth
<script src="//ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type='text/javascript' src='https://cdn.jsdelivr.net/jquery.marquee/1.3.1/jquery.marquee.min.js'></script>
<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<!-- Lazy load -->
<script src="https://cdn.jsdelivr.net/npm/vanilla-lazyload@16.1.0/dist/lazyload.min.js"></script>
<!-- jQuery Modal -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.mmenu/8.5.12/mmenu.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jQuery.mmenu/8.5.12/mmenu.min.css"/>
<script src="/js/lightslider.min.js"></script>
<script src="/js/lightgallery.min.js"></script>
<!-- A jQuery plugin that adds cross-browser mouse wheel support. (Optional) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-mousewheel/3.1.13/jquery.mousewheel.min.js"></script>
<!-- lightgallery plugins -->
<script src="/js/modules/lg-thumbnail.min.js"></script>
<script src="/js/modules/lg-fullscreen.min.js"></script>
<script src="/js/modules/lg-video.min.js"></script>
<script src="/js/app.js"></script>
{!! script('js/news.js') !!}
{!! script('js/defer.js', ['defer' => 'defer']) !!}
{!! script('js/addFavorite.js', ['defer' => 'defer']) !!}
{!! script(('js/filterMember.js')) !!}
<script>
    newsMarquee(news);
</script>
@stack('script')
@yield('custom_script')
</body>
</html>
