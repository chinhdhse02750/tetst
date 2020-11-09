@extends('layouts.admin')
@section('content')
    @include('includes.alerts.messages')
    <div id="pills-tabContent" class="tab-content reset-tab-content">
        <div class="tab-pane fade show active" id="pills-female" role="tabpanel" aria-labelledby="pills-female-tab">
            <div class="card pd-lr-20 @cannot('search_balances') d-none @endcannot">
                <div class="card-body">
                    <form id="search-point-form" onsubmit="return false">
                        @include('point.includes.form_search')
                        <div class="form-group">
                            <div class="d-flex justify-content-center">
                                <input type="submit" class="btn btn-primary mr-1 btn-action"
                                       id="search-point-history" value="@lang('users.label.search')">
                                <input type="hidden" value="{{ route('member.search-balances') }}" id="url-search-point">
                            </div>
                        </div> <!--row-->
                    </form>
                </div><!--card-body-->

            </div>
            <div class="card" id="search-point-append">
                @include('point.includes.result_search')
            </div>
        </div>
    </div>

@endsection
@section('pagespecificscripts')
    {!! script(('assets/admin/js/pointHistory.js')) !!}
    {!! script(('assets/admin/js/fixScrollHeader.js')) !!}
    {!! script(('assets/admin/js/datetimePicker.js')) !!}
@stop


