@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="modal-dialog modal-login">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">@lang('labels.general.login')</h4>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('admin.login') }}">
                        @csrf
                        <div class="form-group">
                            <div class="input-group admin-input-acc">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input
                                    id="email"
                                    type="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    name="email"
                                    placeholder="@lang('labels.form.email')"
                                    value="{{ old('email') }}"
                                    required
                                    autocomplete="email"
                                    autofocus>
                                @error('email')
                                <i class="icon icon_clear js-icon_clear"></i>
                                @enderror
                            </div>
                            @error('email')
                            <span class="invalid feedback error-alert d-block" role="alert">
                                    <small class="message-alert"> {{ $message }}.</small>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input id="password" type="password"
                                       class="form-control"
                                       name="password" required autocomplete="current-password"
                                       placeholder="@lang('labels.form.password')">
                            </div>
                            @error('password')
                            <span class="invalid feedback error-alert d-block" role="alert">
                                    <small class="message-alert"> {{ $message }}.</small>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block btn-lg">@lang('labels.general.login')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
