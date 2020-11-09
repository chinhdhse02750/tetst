@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <h3 class="card-header text-center">@lang('labels.form.login')</h3>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <input type="hidden" name="remember" value="1">
                        <div class="form-group">
                            <div class="form-input">
                                <input
                                    type="email"
                                    class="form-control form-input__username @error('email') is-invalid @enderror"
                                    name="email"
                                    value="{{ old('email') }}"
                                    required
                                    autocomplete="email"
                                    placeholder="@lang('labels.form.email')"
                                    autofocus>
                                @error('email')
                                <span class="button__clear-content js-button__clear-content"></span>
                                @enderror
                            </div>
                            @error('email')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mt-4">
                            <div class="form-password">
                                <input
                                    type="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    name="password"
                                    required
                                    placeholder="@lang('labels.form.password')"
                                    autocomplete="current-password">
                                <i class="icon icon__show-password js-show-password"></i>
                            </div>
                            @error('password')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mt-4 mb-0">
                            <button type="submit" class="btn btn-block btn-primary">@lang('labels.form.login')</button>

                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">@lang('labels.form.forgot_pass')</a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
