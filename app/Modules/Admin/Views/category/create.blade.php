@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    @include('includes.alerts.messages')
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3>@lang('categories.label.register_title')</h3>
                            <div class="panel-body pt-2">
                                <form action="{{ route('categories.store') }}" method="POST"
                                      class="form-horizontal">
                                    {{ csrf_field() }}
                                    <div class="row form-group">
                                        <label class="control-label col-sm-2">
                                            @lang('categories.label.name')
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-sm-10">
                                            <input type="text" name="name" id="name" class="form-control" maxlength="255">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <label
                                            class="control-label col-sm-2">@lang('categories.label.description')</label>
                                        <div class="col-sm-10">
                                            <textarea name="description" id="description"
                                                      class="form-control" maxlength="255"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="d-flex justify-content-center">
                                            <input type="submit" class="btn btn-success mr-1 btn-action"
                                                   value="@lang('categories.label.register')"/>
                                            <a href="{{ route('categories.index') }}"
                                               class="btn btn-danger btn-action">@lang('labels.general.cancel')</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
