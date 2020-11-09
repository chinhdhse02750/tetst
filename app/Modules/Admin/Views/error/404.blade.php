@extends('layouts.error')

@section('title', app_name() . ' | ' . __('error.404.title'))

@section('content')
    <div class="page-error">
        <div class="page-error__container">
            <div class="page-error__main">
                <div class="page-error__header">
                    <div class="page-error__logo"></div>
                    <div class="page-error__title">@lang('error.404.title')</div>
                </div>
                <div class="page-error__content">
                    @lang('error.404.content')
                    <p><a href="{{ route('admin.welcome') }}">Go to Club</a></p>
                </div>
            </div>
        </div>
    </div>
@endsection
