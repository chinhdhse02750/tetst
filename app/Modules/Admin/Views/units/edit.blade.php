@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    @include('includes.alerts.messages')
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3>@lang('categories.label.edit')</h3>
                        </div>
                        <div class="panel-body">
                            <form action="{{ route('units.update', $units->id) }}" method="POST" class="form-horizontal">
                                {{ csrf_field() }}
                                @method('PUT')
                                <div class="row form-group">
                                    <label class="control-label col-sm-2" >@lang('categories.label.name')</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="name" id="name" class="form-control" maxlength="255" value="{{ $units->name }}">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="control-label col-sm-2" >@lang('categories.label.description')</label>
                                    <div class="col-sm-10">
                                        <textarea name="description" id="description" class="form-control" maxlength="255">{{ $units->description }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="d-flex justify-content-center">
                                        <input type="submit" class="btn btn-primary mr-1 btn-action" value="@lang('labels.general.update')" />
                                        <a href="{{ route('units.index') }}" class="btn btn-danger btn-action">@lang('labels.general.cancel')</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

