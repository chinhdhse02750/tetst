@extends('layouts.member')

@section('content')
    <div id="singlecolumn">
        <div class="container">
            @include('offers.setting-menu')
            <div class="section section-content">
                <div class="fb">@lang('offers.label.offer_completed')</div>
                <div class="section-description">@lang('offers.label.offer_success')</div>
            </div>

            <div class="clr clr-bottom-border"></div>
            <div class="d-flex mb-5 justify-content-center">
                <a href="{{ route('home') }}"
                   class="btn btn-outline-secondary mr-3 mw-150px section-fontsize">@lang('offers.label.return_to_top')</a>
            </div>
        </div>
    </div>
@endsection
