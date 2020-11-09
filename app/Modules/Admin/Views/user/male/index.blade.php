@extends('layouts.admin')
@section('content')
    @include('includes.alerts.messages')
    <ul class="nav nav-pills pd-nav-pills" id="pills-tab" role="tablist">
        <li class="nav-item">
            <a class="nav-link btn btn-outline
               {{ active_class(\Request::is('admin/member/male')) }}"
               href="{{ route('member.index', 'male') }}">
                @lang('users.label.male')
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link btn btn-outline
               {{ active_class(\Request::is('admin/member/female')) }}"
               href="{{ route('member.index', 'female') }}">
                @lang('users.label.female')
            </a>
        </li>
    </ul>
    <div id="pills-tabContent" class="tab-content reset-tab-content">
        <div class="tab-pane fade show active" id="pills-male" role="tabpanel" aria-labelledby="pills-male-tab">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                            <a href="{{ route('member.create', $typeName) }}" class="btn btn-primary mr-1 btn-action">@lang('users.label.create_new')</a>
                        </div><!--btn-toolbar-->
                    </div><!--col-->
                </div><!--row-->
            </div>
            <div class="card pd-lr-20">
                <div class="card-body">
                    <form id="search-form-male" class="search-reset-form" onsubmit="return false">
                        <input type="hidden" name="type" value="0" id="type-user-male">
                        @include('user.includes.male.form_search')
                        <div class="form-group">
                            <div class="d-flex justify-content-center">
                                <input type="submit" class="btn btn-primary mr-1 btn-action button-search-user"
                                       id="search-user-male" value="@lang('users.label.search')"/>
                                <input type="hidden" value="{{ url('admin/search-member') }}" id="url-search">
                            </div>
                        </div> <!--row-->
                    </form>
                </div><!--card-body-->

            </div>
            <div class="card search-append" id="search-male-append">
                @include('user.includes.male.result_search')
            </div>
        </div>
    </div>

@endsection
@section('pagespecificscripts')
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
    {!! script(('assets/admin/js/user.js')) !!}
    {!! script(('assets/admin/js/fixScrollHeader.js')) !!}
    {!! script(('assets/admin/js/datetimePicker.js')) !!}
@stop
