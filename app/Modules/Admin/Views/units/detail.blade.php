@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2>@lang('categories.label.detail')</h2>
                    </div>
                </div>
            </div>
            <div class="mb-4 mt-3">
                <div class="form-group row">
                    <div class="col-md-2">
                        <strong>@lang('categories.label.name'):</strong>
                    </div>
                    <div class="col-md-10">
                        {{ $units->name }}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-2">
                        <strong>@lang('categories.label.description'):</strong>
                    </div>
                    <div class="col-md-10">
                        {{ $units->description }}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-2">
                        <strong>@lang('labels.general.created_at'):</strong>
                    </div>
                    <div class="col-md-10">
                        {{ $units->created_at }}
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-left">
                <a href="{{ route('units.index') }}" class="btn btn-primary"> @lang('labels.general.back')</a>
            </div>
        </div>
    </div>
@endsection
