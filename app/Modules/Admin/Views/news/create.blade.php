@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="container-news mt-2">
            <form action="{{ route('news.store') }}" method="POST"
                  class="form-horizontal">
                {{ csrf_field() }}
                <div class="checkbox d-flex align-items-center row float-right">
                    <label class="switch switch-label switch-pill switch-primary mr-2" for="active">
                        <input class="switch-input" type="checkbox" name="active" id="active" value="0">
                        <span class="switch-slider" data-checked="on" data-unchecked="off"></span>
                    </label>
                </div>
                <div class="clearfix"></div>
                <div class="form-group row flex-group">
                    <label for="join_date" class="col-md-2 form-control-label">
                        @lang('news.label.post_time')
                    </label>
                    <div class="col-md-3">
                        <input type="text" id="date-from-news"
                               placeholder="{{ trans('news.label.public_start_time') }}"
                               name="start_time"
                               min="{{ \Carbon\Carbon::parse()->format('Y-m-d\TH:i:s') }}"
                               class="form-control {{ $errors->has('start_time') ? 'field-error' : '' }}"
                               value="{{ old('start_time') }}"
                               autocomplete="off"/>
                        @if ($errors->has('start_time'))
                            <span class="invalid feedback error-alert" role="alert">
                                <small class="message-alert">! {{ $errors->first('start_time') }}</small>
                            </span>
                        @endif
                    </div>
                    ~
                    <div class="col-md-3">
                        <input type="text" id="date-to-news"
                               placeholder="{{ trans('news.label.public_end_time') }}"
                               name="end_time"
                               min="{{ \Carbon\Carbon::parse()->format('Y-m-d\TH:i:s') }}"
                               class="form-control {{ $errors->has('start_time') ? 'field-error' : '' }}"
                               value="{{ old('end_time') }}"
                               autocomplete="off"/>
                        @if ($errors->has('end_time'))
                            <span class="invalid feedback error-alert" role="alert">
                                <small class="message-alert">! {{ $errors->first('end_time') }}</small>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row flex-group">
                    <label for="join_date" class="col-md-2 form-control-label">
                        @lang('news.label.content')
                        <span class="required">*</span>
                    </label>
                    <div class="col-md-6">
                        <textarea type="text"
                                  id="news_content"
                                  placeholder="@lang('news.label.content')"
                                  name="content"
                                  class="form-control {{ $errors->has('content') ? 'field-error' : '' }}"
                                  rows="5">{{ old('content') }}</textarea>
                        @if ($errors->has('content'))
                            <span class="invalid feedback error-alert" role="alert">
                                <small class="message-alert">! {{ $errors->first('content') }}</small>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row flex-group">
                    <label for="join_date" class="col-md-2 form-control-label">
                        @lang('news.label.direction')
                        <span class="required">*</span>
                    </label>
                    <div class="col-md-6">
                        <input type="radio" class="radio" name="direction" value="left" id="left" checked/>
                        <label for="left" class="pr-3">@lang('news.label.left')</label>
                        <input type="radio" class="radio" name="direction" value="right" id="right"
                               {{ old('direction') == 'right' ? 'checked': '' }}/>
                        <label for="right" class="pr-3">@lang('news.label.right')</label>
                        <input type="radio" class="radio" name="direction" value="up" id="up"
                            {{ old('direction') == 'up' ? 'checked': '' }}/>
                        <label for="up" class="pr-3">@lang('news.label.up')</label>
                        <input type="radio" class="radio" name="direction" value="down" id="down"
                            {{ old('direction') == 'down' ? 'checked': '' }}/>
                        <label for="down" class="pr-3">@lang('news.label.down')</label>
                    </div>
                </div>
                <div class="form-group row flex-group">
                    <label for="join_date" class="col-md-2 form-control-label">
                        @lang('news.label.display_order')
                        <span class="required">*</span>
                    </label>
                    <div class="col-md-2">
                        <input type="number"
                                  id="display_order"
                                  placeholder="@lang('news.label.display_order')"
                                  name="order"
                                  class="form-control {{ $errors->has('order') ? 'field-error' : '' }}"
                               value="{{ old('order') }}"
                               rows="5"/>
                        @if ($errors->has('order'))
                            <span class="invalid feedback error-alert" role="alert">
                                <small class="message-alert">! {{ $errors->first('order') }}</small>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <div class="d-flex justify-content-center">
                        <a href="{{ route('news.index') }}"
                           class="btn btn-danger mr-1 btn-action">@lang('labels.general.back')</a>
                        <input type="submit" class="btn btn-success btn-action"
                               value="@lang('categories.label.register')"/>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('pagespecificscripts')
    {!! script(('assets/admin/js/news.js')) !!}
@stop
