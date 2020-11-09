@extends('layouts.member')

@section('title', app_name() . ' | ' . __('title.member.detail'))

@section('sidebar')
    @include('includes.sidebar')
@endsection

@section('content')
    <div class="container-balance-detail">
        <div class="balance-title">
            <div class="detail__balance--title">
                @lang('users.label.change_password')
            </div>
            <div class="detail__balance--description">
                <span>@lang('users.label.change_password_description')</span>
            </div>
        </div>
    </div>
    <form id="member-form" action="{{ route('profile.change-password') }}" method="POST">
        {{ csrf_field() }}
        <table class="tbl-change-password tbl-2col mb0">
            <tbody>
            <tr>
                <td class="change">@lang('users.label.password')</td>
                <td>
                    <input id="password"
                           name="password"
                           class="textfield"
                           maxlength="50"
                           minlength="8"
                           type="password">
                </td>
            </tr>
            <tr>
                <td class="change">@lang('users.label.password_confirm')</td>
                <td class="test">
                    <input id="confirm_password"
                           name="confirm_password"
                           class="textfield"
                           maxlength="50"
                           minlength="8"
                           type="password">
                </td>
            </tr>
            </tbody>
        </table>

        <div class="form-group button-tbl-2 mt-4 mb-5">
            <div class="d-flex justify-content-center">
                <button type="button" class="btn btn-outline-secondary btn-change-password" id="btn-change-password">@lang('users.label.accept_change')</button>
            </div>
            <!-- Button trigger modal -->
            <div class="modal fade" id="confirm-change-password" tabindex="-1" role="dialog" aria-labelledby="confirm-modal-change-password" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="modal-title" id="confirm-modal-change-password">@lang('users.label.change_password_confirm_title')</h6>
                        </div>
                        <div class="modal-body gray">
                            @lang('users.label.change_password_confirm_des')
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="confirm-change-password" class="btn btn-outline-secondary btn-border-dotted">@lang('users.label.yes')</button>
                            <button type="button" class="btn btn-outline-secondary btn-border-dotted" data-dismiss="modal">@lang('users.label.no')</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- Button trigger modal -->


    <!-- Modal -->

@endsection

@section('custom_script')
    <script>
        let locate = '{{ config('app.locale') }}';
    </script>
    {!! script(('js/validator/jquery.validate.min.js')) !!}
    {!! script(('js/profile.js')) !!}
@stop
