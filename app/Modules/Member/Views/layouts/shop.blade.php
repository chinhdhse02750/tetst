<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('images/logo.png') }}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', app_name())</title>

    @stack('styles')
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/custom_bootstrap.css">
    <link rel="stylesheet" href="/css/normalize.css">
    <link rel="stylesheet" href="/css/fontawesome.css">
    <link rel="stylesheet" href="/css/elegant.css">
    <link rel="stylesheet" href="/css/animate.css">
    <link rel="stylesheet" href="/css/slick.css">
    <link rel="stylesheet" href="/css/scroll.css">
    <link rel="stylesheet" href="/css/icomoon.css">
    <link rel="stylesheet" href="/css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="/css/frontend.css">
    <link rel="shortcut icon" href="/images/shortcut_logo.png">
    <link href="/css/member.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css"/>
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
    @include('includes.header-page')
    @yield('content')
    @include('includes.footer-page')
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="/js/jquery-ui.min.js"></script>
<script type='text/javascript' src='https://cdn.jsdelivr.net/jquery.marquee/1.3.1/jquery.marquee.min.js'></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.min.js"></script>
<script src="/js/jquery.countdown.min.js"></script>
<script src="/js/slick.min.js"></script>
<script src="/js/jquery.easing.js"></script>
<script src="/js/jquery.scrollUp.min.js"></script>
<script src="/js/jquery.zoom.min.js"></script>
<script src="/js/parallax.js"></script>
<script src="/js/jquery.fancybox.js"></script>
<script src="/js/numscroller-1.0.js"></script>
<script src="/js/vanilla-tilt.min.js"></script>
<script src="/js/main.js"></script>
{!! script('js/news.js') !!}
<script>
    newsMarquee(news);
</script>
@stack('script')
@yield('custom_script')
</body>
</html>
