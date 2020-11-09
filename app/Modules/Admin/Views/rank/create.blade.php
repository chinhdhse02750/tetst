@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="panel-body pt-2">
                                <form action="{{ route('ranks.store') }}" method="POST"
                                      class="form-horizontal">
                                    {{ csrf_field() }}
                                    <div class="row form-group">
                                        <label class="control-label col-sm-2">
                                            @lang('ranks.label.name_jp')
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-sm-4">
                                            <input type="text"
                                                   name="name_jp"
                                                   id="name_jp"
                                                   class="form-control {{$errors->has('name_jp') ? "field-error" : " "}}"
                                                   maxlength="255">
                                             @if ($errors->has('name_jp'))
                                                <span class="invalid feedback error-alert" role="alert">
                                                    <small class="message-alert">! {{ $errors->first('name_jp') }}</small>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="control-label col-sm-2">
                                            @lang('ranks.label.name_en')
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-sm-4">
                                            <input name="name_en"
                                                   id="name_en"
                                                   class="form-control {{$errors->has('name_en') ? "field-error" : " "}}"
                                                   maxlength="255">
                                            @if ($errors->has('name_en'))
                                                <span class="invalid feedback error-alert" role="alert">
                                                    <small class="message-alert">! {{ $errors->first('name_en') }}</small>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="control-label col-sm-2">@lang('ranks.label.point')</label>
                                        <div class="col-md-2">
                                            <input name="amount"
                                                   id="amount"
                                                   class="form-control {{$errors->has('amount') ? "field-error" : " "}}"
                                                   type="number"
                                                   value="0"
                                                   maxlength="10"
                                                   min="0">
                                            @if ($errors->has('amount'))
                                                <span class="invalid feedback error-alert" role="alert">
                                                    <small class="message-alert">! {{ $errors->first('amount') }}</small>
                                                </span>
                                            @endif
                                        </div>
                                        <label class="point-label">P</label>
                                    </div>
                                    <div class="row form-group">
                                        <label class="control-label col-sm-2">
                                            @lang('ranks.label.priority')
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-2">
                                            <input name="priority"
                                                   id="priority"
                                                   class="form-control {{ $errors->has('priority') ? 'field-error' : '' }}"
                                                   type="number"
                                                   maxlength="4"
                                                   min="0"
                                                   value="">
                                            @if ($errors->has('priority'))
                                                <span class="invalid feedback error-alert" role="alert">
                                                    <small class="message-alert">! {{ $errors->first('priority') }}</small>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="control-label col-sm-2">
                                            @lang('ranks.label.color_code')
                                        </label>
                                        <div class="col-md-2">
                                            <input name="color_code"
                                                   id="color_code"
                                                   class="form-control"
                                                   type="color"
                                                   value="{{ \App\Helpers\Constants::DEFAULT_COLOR }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="d-flex justify-content-center">
                                            <input type="submit" class="btn btn-success mr-1 btn-action"
                                                   value="@lang('ranks.button.create')"/>
                                            <a href="{{ route('ranks.index') }}"
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

@section('pagespecificscripts')
    <script>
      positiveIntegers('amount');
      positiveIntegers('priority');
    </script>
@endsection
