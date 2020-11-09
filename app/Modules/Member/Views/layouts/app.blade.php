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
    <link type="text/css" rel="stylesheet" href="/css/lightslider.min.css" />
    <link type="text/css" rel="stylesheet" href="/css/lightgallery.min.css" />
    @stack('styles')
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/member.css" rel="stylesheet">
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
    @auth
        @include('includes.top_body')
    @endauth
    <div class="body-wrap @guest body-wrap__guest @endguest">
        @guest
            <div class="container-nologin">
            @yield('content')
            </div>
        @else
            <div class="row">
                <div class="col-md-2">
                    @if(Auth::user()->female)
                        @include('includes.male.filter')
                    @else
                        @include('includes.female.filter')
                    @endif
                </div>
                <div class="col-md-10">
                    @yield('content')
                </div>
            </div>
        @endguest
    </div>
    @auth
        @include('includes.footer')
    @endauth
</div>
@auth
    <div id="menu-mobile">
        @include('includes.menu')
    </div>
@endauth
<script src="//ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type='text/javascript' src='https://cdn.jsdelivr.net/jquery.marquee/1.3.1/jquery.marquee.min.js'></script>
<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<!-- Lazy load -->
<script src="https://cdn.jsdelivr.net/npm/vanilla-lazyload@16.1.0/dist/lazyload.min.js"></script>
<!-- jQuery Modal -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.mmenu/8.5.12/mmenu.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jQuery.mmenu/8.5.12/mmenu.min.css" />
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
<script>
    newsMarquee(news);
</script>
@stack('script')
@yield('custom_script')
</body>
</html>
