<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="/image/logo.png">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', app_name())</title>
    <meta name="description" content="@yield('meta_description', 'Oriental-club')">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="https://unpkg.com/@coreui/icons@1.0.0/css/all.min.css">
    <!-- Check if the language is set to RTL, so apply the RTL layouts -->
    {!! style(('assets/admin/lib/datetimepicker/jquery.datetimepicker.min.css')) !!}
    <link type="text/css" rel="stylesheet" href="/css/lightslider.min.css"/>
    <link type="text/css" rel="stylesheet" href="/css/lightgallery.min.css"/>
    <link href="/css/app.css" rel="stylesheet">
    {!! style('assets/admin/js/fullcalendar/packages/core/main.css') !!}
    {!! style('assets/admin/js/fullcalendar/packages/daygrid/main.css') !!}
    {!! style('assets/admin/js/fullcalendar/packages/timegrid/main.css') !!}
    {!! style('assets/admin/js/fullcalendar/packages/timegrid/main.css') !!}
    {!! style('css/scheduleCalendar.css') !!}
<!-- Otherwise apply the normal LTR layouts -->
    {{ style('css/backend.css')}}
    {{ style('css/font-awesome.css')}}
    <style>
        html, body {
            height: 100%;
            font-size: 16px;
        }
    </style>
</head>
<body class="app header-fixed sidebar-fixed aside-menu-off-canvas sidebar-lg-show">
<main class="main ml-0 main-preview">
    <div class="container-fluid container-preview">
        <div class="animated fadeIn">
            <div class="admin-content">
                <div class="container-detail">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="container-detail__slide container-detail__slide-public">
                                <ul id="detailSlide" class="slide__container">
                                    @if(!empty($member->public_images))
                                        @foreach($member->public_images as $image)
                                            <li
                                                class="item__image-public"
                                                data-exthumbimage="{{ $image['thumbnail_url'] }}"
                                                data-src="{{ $image['media_url'] }}"
                                                data-thumb="{{ $image['thumbnail_url'] }}">
                                                <img src="{{ $image['media_url'] }}"/>
                                            </li>
                                        @endforeach
                                    @else
                                        <li
                                            data-exthumbimage="/image/frontend/no_image.png"
                                            data-src="/image/frontend/no_image.png"
                                            data-thumb="/image/frontend/no_image.png">
                                            <img src="/image/frontend/no_image.png"/>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="detail__rank">
                                <button
                                    class="button__user-type button__user-type-item--square button__bg--{{ $member->rank_name }} text--small">
                                    {{ $member->rank_name }}</button>
                            </div>
                            <div class="detail__name">
                                <h1>{{ $member->name }}</h1>
                                <span class="detail__about">
                                     @if (!empty($member->male_age_label))
                                        {!! $member->male_age_label !!}
                                    @endif
                                </span>
                            </div>
                            <div class="detail__profile">
                                <div class="detail__profile-title">@lang('users.label.basic_data')</div>
                                <div class="detail__profile-container">
                                    <table>
                                        @if (!empty($member->birthday_label))
                                            <tr>
                                                <td>@lang('users.label.birthday') ：</td>
                                                <td>{{ $member->birthday_label }}</td>
                                            </tr>
                                        @endif
                                        @if (!empty($member->tel))
                                            <tr>
                                                <td>@lang('users.label.tel') ：</td>
                                                <td>{{ $member->tel }}</td>
                                            </tr>
                                        @endif
                                        @if (!empty($member->line_id))
                                            <tr>
                                                <td>@lang('users.label.line_id') ：</td>
                                                <td>{{ $member->line_id }}</td>
                                            </tr>
                                        @endif
                                        @if (!empty($member->favorite_dating_type_label))
                                            <tr>
                                                <td>@lang('users.label.favorite_dating_type') ：</td>
                                                <td>{{ $member->favorite_dating_type_label }}</td>
                                            </tr>
                                        @endif
                                        @if (!empty($member->address))
                                            <tr>
                                                <td>@lang('users.label.address') ：</td>
                                                <td>{{ $member->address }}</td>
                                            </tr>
                                        @endif
                                        {{-- occupation --}}
                                        @if (!empty($member->occupation))
                                            <tr>
                                                <td>@lang('users.label.occupation') ：</td>
                                                <td>{{ $member->occupation }}</td>
                                            </tr>
                                        @endif
                                        {{-- income --}}
                                        @if (!empty($member->income_label))
                                            <tr>
                                                <td>@lang('users.label.income') ：</td>
                                                <td>{{ $member->income_label }}</td>
                                            </tr>
                                        @endif
                                        {{-- hobby --}}
                                        @if (!empty($member->hobby))
                                            <tr>
                                                <td>@lang('users.label.hobby') ：</td>
                                                <td>{{ $member->hobby }}</td>
                                            </tr>
                                        @endif
                                        {{-- blood type --}}
                                        @if (!empty($member->blood_type_label))
                                            <tr>
                                                <td>@lang('users.label.blood_type') ：</td>
                                                <td>{{ $member->blood_type_label }}</td>
                                            </tr>
                                        @endif
                                        {{-- male smoking --}}
                                        @if (!empty($member->smoking_male_label))
                                            <tr>
                                                <td>@lang('users.label.smoking') ：</td>
                                                <td>{{ $member->smoking_male_label }}</td>
                                            </tr>
                                        @endif
                                        {{-- male alcohol --}}
                                        @if (!empty($member->male_alcohol))
                                            <tr>
                                                <td>@lang('users.label.alcohol') ：</td>
                                                <td>{{ $member->male_alcohol }}</td>
                                            </tr>
                                        @endif
                                    </table>
                                </div>
                            </div>
                            @if (!empty($member->comment))
                                <div class="detail__comment detail__my-comment">
                                    <div class="detail__comment-title detail__my-comment-title">
                                        <span>{{ $member->name }}</span>@lang('users.label.of_comment')</div>
                                    <div class="detail__comment-container detail__my-comment-container">
                                        {!! html_entity_decode($member->comment) !!}
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div><!--animated-->
    </div><!--container-fluid-->
</main><!--main-->

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
        integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
        crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment.min.js"></script>
{!! script(('js/bootstrap.min.js')) !!}
{!! script(('js/bootstrap.bundle.min.js')) !!}
<script src="https://cdn.jsdelivr.net/npm/vanilla-lazyload@16.1.0/dist/lazyload.min.js"></script>
<!-- jQuery Modal -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css"/>
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
<script src="/js/detail.js"></script>
{!! script(('assets/admin/js/fullcalendar/packages/core/main.js')) !!}
{!! script(('assets/admin/js/fullcalendar/packages/interaction/main.js')) !!}
{!! script(('assets/admin/js/fullcalendar/packages/daygrid/main.js')) !!}
{!! script(('js/scheduleCalendar.js')) !!}
</body>
</html>
