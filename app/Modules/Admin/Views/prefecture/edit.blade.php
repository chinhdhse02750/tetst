@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    @include('includes.alerts.messages')
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3>@lang('prefectures.label.edit')</h3>
                        </div>
                        <div class="panel-body">
                            <form action="{{ route('prefectures.update', $prefectures->id) }}" method="POST" class="form-horizontal">
                                {{ csrf_field() }}
                                @method('PUT')
                                <div class="row form-group">
                                    <label class="control-label col-sm-2" >@lang('labels.general.area')</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="area_id">
                                            @foreach($areas as $key=>$area)
                                                <option
                                                    @if ($prefectures->area_id == $key)
                                                        selected
                                                    @endif
                                                    value="{{ $key }}">{{ $area }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="control-label col-sm-2" >
                                        @lang('prefectures.label.name')<span class="required">*</span>
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                               name="name"
                                               id="name"
                                               class="form-control {{ $errors->has('name') ? 'field-error' : '' }}"
                                               maxlength="255"
                                               value="{{ $prefectures->name }}">
                                        @if ($errors->has('name'))
                                            <span class="invalid feedback error-alert" role="alert">
                                                <small class="message-alert">! {{ $errors->first('name') }}.</small>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="d-flex justify-content-center">
                                        <input type="submit" class="btn btn-primary mr-1 btn-action" value="@lang('labels.general.update')" />
                                        <a href="{{ route('prefectures.index') }}" class="btn btn-danger btn-action">@lang('labels.general.cancel')</a>
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
