<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="/images/logo.png">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', app_name())</title>
    <meta name="description" content="@yield('meta_description', 'Oriental-club')">
    @yield('meta')
    @stack('before-styles')
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="https://unpkg.com/@coreui/icons@1.0.0/css/all.min.css">
    <link type="text/css" rel="stylesheet" href="/css/lightslider.min.css" />
    <link type="text/css" rel="stylesheet" href="/css/lightgallery.min.css" />
    @stack('styles')
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/member.css" rel="stylesheet">
    {{--    <link href="/css/member.css" rel="stylesheet">--}}
    <!-- Check if the language is set to RTL, so apply the RTL layouts -->
    {!! style(('assets/admin/lib/datetimepicker/jquery.datetimepicker.min.css')) !!}

<!-- Otherwise apply the normal LTR layouts -->
    {{ style('css/backend.css')}}
    {{ style('css/font-awesome.css')}}

    @yield('pagespecificstyles')
    @stack('after-styles')

</head>
<body class="app header-fixed sidebar-fixed aside-menu-off-canvas sidebar-lg-show">
@include('includes.header')

<div class="app-body">
    @include('includes.sidebar')

    <main class="main">
        {!! Breadcrumbs::render() !!}
        <div class="container-fluid">
            <div class="animated fadeIn">
                <div class="content-header">
                    @yield('page-header')
                </div><!--content-header-->
                <div class="admin-content">
                    @yield('content')
                </div>
            </div><!--animated-->
        </div><!--container-fluid-->
    </main><!--main-->
</div><!--app-body-->
<!-- Modal schedule -->
<div class="modal fade member-schedule__modal" id="memberScheduleModal" tabindex="-1" role="dialog" aria-labelledby="memberScheduleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header member-schedule__modal--title">
                <h5 class="modal-title" id="memberScheduleModalLabel">@lang('users.label.schedule_popup_title')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body member-schedule__modal--body">
                <form id="memberScheduleForm">
                    <input type="hidden" name="start_date" id="scheduleStartDate">
                    <input type="hidden" name="end_date" id="scheduleEndDate">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="isNightDating" name="is_night_dating">
                        <label class="form-check-label" for="isNightDating">@lang('users.label.night_ok')</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="isNoonDating" name="is_noon_dating">
                        <label class="form-check-label" for="isNoonDating">@lang('users.label.noon_ok')</label>
                    </div>
                    <div class="modal-footer member-schedule__modal--footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('labels.general.cancel')</button>
                        <button type="submit" class="btn btn-primary js-submit-schedule">@lang('users.label.register_schedule')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@include('includes.footer')

<!-- Scripts -->
{{--@stack('before-scripts')--}}
{!! script(('js/manifest.js')) !!}
{!! script(('js/vendor.js')) !!}
{!! script(('js/backend.js')) !!}
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
        integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
        crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vanilla-lazyload@16.1.0/dist/lazyload.min.js"></script>
<script src="/js/lightslider.min.js"></script>
<script src="/js/lightgallery.min.js"></script>
<!-- A jQuery plugin that adds cross-browser mouse wheel support. (Optional) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-mousewheel/3.1.13/jquery.mousewheel.min.js"></script>
<!-- lightgallery plugins -->
<script src="/js/modules/lg-thumbnail.min.js"></script>
<script src="/js/modules/lg-fullscreen.min.js"></script>
<script src="/js/modules/lg-video.min.js"></script>

{!! script('js/defer.js', ['defer' => 'defer']) !!}
{!! script(('js/bootstrap.min.js')) !!}
{!! script(('js/bootstrap.bundle.min.js')) !!}
{!! script(('assets/admin/lib/datetimepicker/jquery.datetimepicker.full.min.js')) !!}
{!! script(('assets/admin/js/navbar.js')) !!}
{!! script(('assets/admin/js/formNumber.js')) !!}
@yield('pagespecificscripts')
@stack('script')
@yield('custom_script')
</body>
</html>
