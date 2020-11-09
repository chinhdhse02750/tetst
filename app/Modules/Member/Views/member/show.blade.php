@extends('layouts.member')

@section('title', app_name() . ' | ' . __('title.member.detail'))

@section('content')
    @if(Auth::user()->female)
        @include('includes.male.member_detail')
    @else
        @include('includes.female.member_detail')
    @endif
    <div class="tab-bar d-none"></div>
    <style>
        .en-detail__dating {
            font-size: .5rem;
        }
        .tab-bar {
            position: fixed;
            bottom: 0;
            left: 310px;
            width: calc(100% - 310px);
            height: 50px;
            background: #2B2B2B;
            z-index: 9999;
        }
    </style>
@endsection

@push('styles')
    {!! style('assets/admin/js/fullcalendar/packages/core/main.css') !!}
    {!! style('assets/admin/js/fullcalendar/packages/daygrid/main.css') !!}
    {!! style('assets/admin/js/fullcalendar/packages/timegrid/main.css') !!}
    {!! style('assets/admin/js/fullcalendar/packages/timegrid/main.css') !!}
    {!! style('css/scheduleCalendar.css') !!}
@endpush

@push('script')
    {!! script(('assets/admin/js/fullcalendar/packages/core/main.js')) !!}
    {!! script(('assets/admin/js/fullcalendar/packages/interaction/main.js')) !!}
    {!! script(('assets/admin/js/fullcalendar/packages/daygrid/main.js')) !!}
    {!! script(('js/scheduleCalendar.js')) !!}
    <script src="/js/detail.js"></script>
    <script>
        $(document).ready(function(){
            tabBar();
            $(window).on('resize', function () {
                tabBar();
            });
        });

        function tabBar() {
            let filterWidth = $('.body-wrap .filter').innerWidth();
            let bodyWidth = $('body').width();
            let tabBar = $('.tab-bar');
            tabBar.css('left', filterWidth);
            tabBar.width(bodyWidth - filterWidth);
        }
    </script>
@endpush
