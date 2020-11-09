@extends('layouts.admin')
@section('content')
    @include('includes.alerts.messages')
    <div id="pills-tabContent" class="tab-content reset-tab-content">
        <div class="tab-pane fade show active" id="pills-female" role="tabpanel" aria-labelledby="pills-female-tab">
            <div class="card pd-lr-20">
                <div class="card-body">
                    <form id="search-offer-form" onsubmit="return false">
                        @include('offer.form_search')
                        <div class="form-group">
                            <div class="d-flex justify-content-center">
                                <input type="submit" class="btn btn-primary mr-1 btn-action"
                                       id="search-offer" value="@lang('users.label.search')">
                                <input type="hidden" value="{{ route('offers.search') }}" id="url-search-offer">
                            </div>
                        </div> <!--row-->
                    </form>
                </div><!--card-body-->

            </div>
            <div class="card" id="search-offer-append">
                @include('offer.result_search')
            </div>
        </div>
    </div>

@endsection

@section('pagespecificscripts')
    {!! script(('assets/admin/js/offer.js')) !!}
    {!! script(('assets/admin/js/datetimePicker.js')) !!}
@stop
