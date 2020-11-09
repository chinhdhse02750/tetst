@extends('layouts.admin')

@section('content')
    <div class="card">
        @include('includes.alerts.messages')
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="panel-body pt-2">
                                <form action="{{ route('banks.store') }}" method="POST"
                                      class="form-horizontal">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="id" value="{{ !empty($bank->id) ? $bank->id : '' }}">
                                    <div class="row form-group">
                                        <label class="control-label col-sm-2">
                                            @lang('banks.label.name')
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-sm-4">
                                            <input type="text"
                                                   name="name"
                                                   id="name"
                                                   value="{{ !empty($bank->name) ? $bank->name : '' }}"
                                                   class="form-control {{ $errors->has('name') ? 'field-error' : ''}}"
                                                   maxlength="255">
                                            @if ($errors->has('name'))
                                                <span class="invalid feedback error-alert" role="alert">
                                                    <small class="message-alert">! {{ $errors->first('name') }}</small>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="control-label col-sm-2">
                                            @lang('banks.label.branch_name')
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-sm-4">
                                            <input name="branch_name"
                                                   id="branch_name"
                                                   value="{{ !empty($bank->branch_name) ? $bank->branch_name : '' }}"
                                                   class="form-control {{ $errors->has('branch_name') ? 'field-error' : '' }}"
                                                   maxlength="255">
                                            @if ($errors->has('branch_name'))
                                                <span class="invalid feedback error-alert" role="alert">
                                                    <small class="message-alert">! {{ $errors->first('branch_name') }}</small>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="control-label col-sm-2">
                                            @lang('banks.label.account_number')
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-sm-4">
                                            <input name="account_number"
                                                   id="account_number"
                                                   value="{{ !empty($bank->account_number) ? $bank->account_number : '' }}"
                                                   class="form-control {{ $errors->has('account_number') ? 'field-error' : '' }}"
                                                   maxlength="20">
                                            @if ($errors->has('account_number'))
                                                <span class="invalid feedback error-alert" role="alert">
                                                    <small class="message-alert">! {{ $errors->first('account_number') }}</small>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="control-label col-sm-2">
                                            @lang('banks.label.account_name')
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-sm-4">
                                            <input name="account_name"
                                                   id="account_name"
                                                   value="{{ !empty($bank->account_name) ? $bank->account_name : '' }}"
                                                   class="form-control {{ $errors->has('account_name') ? 'field-error' : '' }}"
                                                   maxlength="255">
                                            @if ($errors->has('account_name'))
                                                <span class="invalid feedback error-alert" role="alert">
                                                    <small class="message-alert">! {{ $errors->first('account_name') }}</small>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="control-label col-sm-2">
                                            @lang('banks.label.receipt_name')
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-sm-4">
                                            <input name="receipt_name"
                                                   id="receipt_name"
                                                   value="{{ !empty($bank->receipt_name) ? $bank->receipt_name : '' }}"
                                                   class="form-control {{ $errors->has('receipt_name') ? 'field-error' : '' }}"
                                                   maxlength="255">
                                            @if ($errors->has('receipt_name'))
                                                <span class="invalid feedback error-alert" role="alert">
                                                    <small class="message-alert">! {{ $errors->first('receipt_name') }}</small>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group mt-lg-5">
                                        <div class="d-flex justify-content-center">
                                            <input type="submit" class="btn btn-success mr-1 btn-action"
                                                   value="@lang('labels.general.update')"/>
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
