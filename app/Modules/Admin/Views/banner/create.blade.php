@extends('layouts.admin')
@section('pagespecificstyles')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3>@lang('banners.label.register_title')</h3>
                            <div class="panel-body pt-2">
                                <form action="{{ route('banners.store') }}" method="POST" enctype="multipart/form-data"
                                      class="form-horizontal"
                                      runat="server">
                                    {{ csrf_field() }}
                                    <div class="checkbox d-flex align-items-center row float-right">
                                        <label class="switch switch-label switch-pill switch-primary mr-2" for="active">
                                            <input class="switch-input" type="checkbox" name="active" id="active" value="1">
                                            <span class="switch-slider" data-checked="on" data-unchecked="off"></span>
                                        </label>
                                    </div>
                                    <div class="clearfix"></div>
                                    {{--<div class="row form-group">--}}
                                        {{--<div class="col-sm-2">--}}
                                            {{--<label for="redirect_url">@lang('banners.label.redirect_url')<span class="required">*</span></label>--}}
                                        {{--</div>--}}
                                        {{--<div class="col-sm-10">--}}
                                            {{--<input type="redirect_url"--}}
                                                   {{--class="form-control {{$errors->has('redirect_url') ? "field-error" : " "}}"--}}
                                                   {{--name="redirect_url"--}}
                                                   {{--maxlength="255"--}}
                                                   {{--value="{{ old('redirect_url')}}">--}}
                                            {{--@if ($errors->has('redirect_url'))--}}
                                                {{--<span class="invalid feedback error-alert" role="alert">--}}
                                                    {{--<small class="message-alert">! {{ $errors->first('redirect_url') }}</small>--}}
                                                {{--</span>--}}
                                            {{--@endif--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="row form-group">--}}
                                        {{--<div class="col-sm-2">--}}
                                            {{--<label for="order">@lang('banners.label.order')<span class="required">*</span></label>--}}
                                        {{--</div>--}}
                                        {{--<div class="col-sm-10">--}}
                                            {{--<input type="number"--}}
                                                   {{--class="form-control {{$errors->has('order') ? "field-error" : " "}}"--}}
                                                   {{--name="order"--}}
                                                   {{--maxlength="4"--}}
                                                   {{--value="{{ old('order')}}">--}}
                                            {{--@if ($errors->has('order'))--}}
                                                {{--<span class="invalid feedback error-alert" role="alert">--}}
                                                    {{--<small class="message-alert">! {{ $errors->first('order') }}</small>--}}
                                                {{--</span>--}}
                                            {{--@endif--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    <div class="row form-group">
                                        <div class="col-sm-2">
                                            <label for="redirect_url">@lang('banners.label.image')<span class="required">*</span></label>
                                        </div>
                                        <div class="col-sm-10">
                                            <div class="box">
                                                <input type="file" id="image" name="image">
                                                @if ($errors->has('image'))
                                                    <div>
                                                        <span class="invalid feedback error-alert" role="alert">
                                                            <small class="message-alert">! {{ $errors->first('image') }}</small>
                                                        </span>
                                                    </div>
                                                @endif
                                            </div>
                                            <img id="image-preview" type="hidden"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="d-flex justify-content-center">
                                            <input type="submit" class="btn btn-success mr-1 btn-action"
                                                   value="@lang('banners.label.register')"/>
                                            <a href="{{ route('banners.index') }}"
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
        function readURL(input) {
            if (input.files) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#image-preview').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }

        $("#image").change(function() {
            readURL(this);
        });
    </script>
@stop
