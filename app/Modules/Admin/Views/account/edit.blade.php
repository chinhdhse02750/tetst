@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="panel-body pt-2">
                                <form action="{{ route('accounts.update', $account->id) }}" method="POST"
                                      class="form-horizontal">
                                    {{ csrf_field() }}
                                    @method('PUT')
                                    <div class="row form-group">
                                        <label class="control-label col-sm-2">
                                            @lang('users.label.name')
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-sm-4">
                                            <input type="text"
                                                   name="name"
                                                   id="name"
                                                   class="form-control {{ $errors->has('name') ? 'field-error' : '' }}"
                                                   maxlength="255"
                                                   value="{{ !empty($account->name) ? $account->name : '' }}">
                                            @if ($errors->has('name'))
                                                <span class="invalid feedback error-alert" role="alert">
                                                    <small class="message-alert">! {{ $errors->first('name') }}</small>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="control-label col-sm-2">
                                            @lang('users.label.email')
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-sm-4">
                                            <input name="email"
                                                   id="email"
                                                   class="form-control {{ $errors->has('email') ? 'field-error' : '' }}"
                                                   maxlength="255"
                                                   value="{{ !empty($account->email) ? $account->email : '' }}">
                                            @if ($errors->has('email'))
                                                <span class="invalid feedback error-alert" role="alert">
                                                    <small class="message-alert">! {{ $errors->first('email') }}</small>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="control-label col-sm-2">@lang('users.label.password')</label>
                                        <div class="col-md-4">
                                            <input name="password"
                                                   id="password"
                                                   class="form-control {{ $errors->has('password') ? 'field-error' : '' }}"
                                                   type="password"
                                                   maxlength="255"
                                                   minlength="8">
                                            @if ($errors->has('password'))
                                                <span class="invalid feedback error-alert" role="alert">
                                                    <small class="message-alert">! {{ $errors->first('password') }}</small>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="control-label col-sm-2">
                                            @lang('labels.general.role')
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-4">
                                            <select class="form-control" name="role">
                                                @foreach($roles as $key=>$role)
                                                    <option value="{{ $key }}" @if($account->hasRole($role)) selected @endif >
                                                        {{ $role }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="d-flex justify-content-center">
                                            <input type="submit" class="btn btn-success mr-1 btn-action"
                                                   value="@lang('labels.general.update')"/>
                                            <a href="{{ route('accounts.index') }}"
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
@endsection
