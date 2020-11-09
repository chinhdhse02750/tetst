@extends('layouts.member')

@section('title', app_name() . ' | ' . __('title.member.detail'))

@section('sidebar')
    @include('includes.sidebar')
@endsection

@section('content')
    <div class="container-balance-detail">
        <div class="balance-title">
            <div class="detail__balance--title">
                @lang('users.label.register_info')
            </div>
            <div class="detail__balance--description">
                <span>@lang('users.label.register_des')</span>
            </div>
        </div>

        <table class="tbl-2col tbl-change-password mb0">
            <tbody>
            <tr>
                <td class="field">@lang('users.label.member_id')</td>
                <td class="font-size-label">{{ $user->id }}</td>
            </tr>
            <tr>
                <td class="field">@lang('users.label.join_date')</td>
                <td class="font-size-label">{{ $user->created }}</td>
            </tr>
            <tr>
                <td class="field">@lang('users.label.expired')</td>
                <td class="font-size-label">{{ $user->expired }}</td>
            </tr>
            <tr>
                <td class="field">@lang('users.label.rank')</td>
                <td class="font-size-label">
                    <div class="icon-class_sb flLeft">{{ $user->userProfile->rank_name }}</div>
                </td>
            </tr>
            <tr>
                <td class="field">@lang('users.label.name')</td>
                <td class="font-size-label">{{ $user->userProfile->name }}</td>
            </tr>
            <tr>
                <td class="field">@lang('users.label.tel')</td>
                <td class="font-size-label">{{ $user->userProfile->tel }}</td>
            </tr>
            <tr>
                <td class="field">@lang('users.label.line_id')</td>
                <td class="font-size-label">{{ $user->userProfile->line_id }}</td>
            </tr>
            </tbody>
        </table>

        <form id="memberForm">
            <div class="balance-title mt-5">
                <div class="detail__balance--title">
                    @lang('users.label.initial_setting')
                </div>
                <div class="detail__balance--description">
                    <span>@lang('users.label.initial_des')</span>
                </div>
            </div>

            <table class="tbl-2col tbl-change-password mb0">
                <tbody>
                <tr>
                    <td class="field">@lang('user_profile.label.receipt_type')</td>
                    <td class="font-size-label">
                        <div>
                            <input type="radio" class="radio" name="receipt_type" value="0" id="no_receipt"
                                   @if($user->userProfile->receipt_type === 0) checked @endif/>
                            <label for="no_receipt" class="mr-2">@lang('user_profile.label.no_receipt')</label>

                            <input type="radio" class="radio" name="receipt_type" value="1" id="receipt_mail"
                                   @if($user->userProfile->receipt_type === 1) checked @endif/>
                            <label for="receipt_mail" class="mr-2">@lang('user_profile.label.receipt_mail')</label>

                            <input type="radio" class="radio" name="receipt_type" value="2" id="receipt_pdf"
                                   @if($user->userProfile->receipt_type === 2) checked @endif/>
                            <label for="receipt_pdf" class="mr-2">@lang('user_profile.label.receipt_pdf')</label>
                        </div>
                        <span style="color: red">@lang('users.label.receipt_des')</span>
                    </td>
                </tr>
                </tbody>
            </table>

            <div class="form-group button-tbl-2 mt-4 mb-5">
                <div class="d-flex justify-content-center">
                    <input type="button" class="btn btn-outline-secondary btn-change-password" id="btn-change-profile"
                           value="@lang('users.label.accept_change')"/>
                    <input type="hidden" id="url-change-profile" value="{{ route('profile.update') }}">
                </div>
            </div>

            <div class="modal fade" id="edit-profile-success" tabindex="-1" role="dialog"
                 aria-labelledby="confirm-modal-change-password" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="modal-title" id="confirm-modal-change-password">@lang('users.label.title_modal_register')</h6>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body gray mb-5">
                            @lang('users.label.content_modal_register')
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('custom_script')
    <script>
      let locate = '{{ config('app.locale') }}';
    </script>
    {!! script(('js/validator/jquery.validate.min.js')) !!}
    {!! script(('js/profile.js')) !!}
@stop
