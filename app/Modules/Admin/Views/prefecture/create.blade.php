@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3>@lang('prefectures.label.register_title')</h3>
                            <div class="panel-body pt-2">
                                <form action="{{ route('prefectures.store') }}" method="POST"
                                      class="form-horizontal">
                                    {{ csrf_field() }}
                                    <div class="row form-group">
                                        <label class="control-label col-sm-2" >
                                            @lang('labels.general.area')
                                        </label>
                                        <div class="col-sm-10">
                                            <select class="form-control" name="area_id">
                                                @foreach($areas as $key=>$area)
                                                    <option value="{{ $key }}">{{ $area }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="control-label col-sm-2">
                                            @lang('prefectures.label.name')<span class="required">*</span>
                                        </label>
                                        <div class="col-sm-10">
                                            <input type="text"
                                                   class="form-control {{ $errors->has('name') ? 'field-error' : '' }}"
                                                   name="name"
                                                   id="name"
                                                   maxlength="255"
                                                   value="{{ old('name') }}">
                                            @if ($errors->has('name'))
                                                <span class="invalid feedback error-alert" role="alert">
                                                    <small class="message-alert">! {{ $errors->first('name') }}.</small>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="d-flex justify-content-center">
                                            <input type="submit" class="btn btn-success mr-1 btn-action"
                                                   value="@lang('prefectures.label.register')"/>
                                            <a href="{{ route('prefectures.index') }}"
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

