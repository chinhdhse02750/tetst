@extends('layouts.member')

@section('title', app_name() . ' | ' . __('title.member.detail'))

@section('sidebar')
    @include('includes.sidebar')
@endsection

@section('content')
    <div class="container-balance-detail">
        <div class="balance-title">
            <div class="detail__balance--title">
                @lang('contacts.label.contact_form')
            </div>
            <div class="detail__balance--description">
                <span>@lang('contacts.label.contact_des')</span>
            </div>
        </div>
        <form name="contact_form" action="{{ route('contact.store') }}" method="POST">
            {{ csrf_field() }}
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" id="user-id">
            <input type="hidden" name="status" value="0" id="status">
            <table class="tbl-2col">
                <tbody>
                <tr>
                    <td class="change">@lang('contacts.label.inquiry')</td>
                    <td>
                        <select class="form-class" name="title" id="title">
                            @foreach($selectOption['contact'][App::getLocale()] as $key => $value)
                                <option value="{{ $value }}">{{ $value }}</option>
                            @endforeach
                        </select></td>
                </tr>
                <tr>
                    <td class="change">@lang('contacts.label.content')</td>
                    <td><textarea name="content" id="content" class="text-field"></textarea></td>
                </tr>
                </tbody>
            </table>
            <input type="hidden" id="alert-message" value="@lang('contacts.label.contact_success')">

            <div class="form-group button-tbl-2 mt-4 mb-5">
                <div class="d-flex justify-content-center">
                    <input type="button" class="btn btn-outline-secondary btn-send-contact" id="btn-send-contact"
                           value="@lang('contacts.label.send')" disabled/>
                    <input type="hidden" id="url-send-contact" value="{{ route('contact.store') }}">
                </div>
            </div>
        </form>

    </div>
@endsection

@section('custom_script')
    {!! script(('js/contact.js')) !!}
@stop
