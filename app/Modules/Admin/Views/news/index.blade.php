@extends('layouts.admin')
@section('content')
    @include('includes.alerts.messages')
    <div id="pills-tabContent" class="tab-content reset-tab-content">
        <div class="tab-pane fade show active" id="pills-female" role="tabpanel" aria-labelledby="pills-female-tab">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                            <a href="{{ route('news.create') }}" class="btn btn-primary mr-1 btn-action"
                               data-toggle="tooltip"
                               title="" data-original-title="Create New">@lang('news.button.register')</a>
                        </div><!--btn-toolbar-->
                    </div><!--col-->
                </div><!--row-->
            </div>
            <div class="card pd-lr-20">
                <div class="card-body">
                    <form id="search-news-form" action="{{ route('news.search') }}" onsubmit="return false">
                        @include('news.form_search')
                        <div class="form-group">
                            <div class="d-flex justify-content-center">
                                <input type="submit" class="btn btn-primary mr-1 btn-action"
                                       id="search-news" value="@lang('labels.general.search')">
                            </div>
                        </div>  <!--row-->
                    </form>
                </div><!--card-body-->

            </div>
            <div class="card" id="search-news-append">
                @include('news.result_search')
                <div class="mr-3">
                    <div class="float-right">
                        {!! $news->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('pagespecificscripts')
    {!! script(('assets/admin/js/news.js')) !!}
@stop


