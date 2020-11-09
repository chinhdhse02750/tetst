@extends('layouts.admin')
@section('content')
    <div class="container">
        <form class="form-horizontal" action="{{ route('member.update-point-send', [ 'type_user'=> $type]) }}"
              method="POST">
            {{ csrf_field() }}
            <div class="clearfix"></div>
            <div class="form-group row flex-group">
                <div class="col-md-12">
                    <div class="row mt-4 mb-4" role="form">
                        <div class="col">
                            <div class="form-group row">
                                <label class="col-md-2 form-control-label"
                                       for="user_id">@lang('point.label.member_id')</label>
                                <div class="col-md-10">
                                    <input class="form-control col-md-2" type="text" name="user_id" id="user_id"
                                           maxlength="255" value="{{ $user->id }}" disabled>
                                </div>
                                <!--col-->
                            </div><!--form-group-->
                            <div class="form-group row">
                                <label class="col-md-2 form-control-label"
                                       for="user_name">@lang('users.label.member_name')</label>
                                <div class="col-md-10">
                                    <input class="form-control col-md-2" type="text" name="user_name" id="user_name"
                                           maxlength="255" value="{{ $user->userProfile->name }}" disabled>
                                </div>
                                <!--col-->
                            </div><!--form-group-->
                            <div class="form-group row">
                                <label class="col-md-2 form-control-label"
                                       for="amount">@lang('users.label.amount')
                                    <span class="required">*</span></label>

                                <div class="col-md-10">
                                    <div class="row ml-0">
                                        <input class="form-control col-md-2" type="number" name="amount" id="amount"
                                               maxlength="255" value="{{ old('amount') }}">
                                        <span class="form-control-label col-md-2">@lang('point.label.point')</span>
                                    </div>
                                    @if ($errors->has('amount'))
                                        <span class="invalid feedback error-alert" role="alert">
                                                <small class="message-alert">{{ $errors->first('amount') }}.</small>
                                                </span>
                                    @endif
                                </div><!--col-->


                            </div><!--form-group-->
                            <div class="form-group row">
                                <label class="col-md-2 form-control-label"
                                       for="content">@lang('users.label.content') <span class="required">*</span></label>

                                <div class="col-md-10">
                                    <textarea class="form-control"
                                              type="text"
                                              name="content"
                                              id="content"
                                              maxlength="5000"
                                              placeholder=""
                                              rows='5'>{{ old('content') }}</textarea>
                                    @if ($errors->has('content'))
                                        <span class="invalid feedback error-alert" role="alert">
                                                <small class="message-alert">{{ $errors->first('content') }}.</small>
                                                </span>
                                    @endif
                                </div><!--col-->
                            </div><!--form-group-->
                        </div>
                    </div> <!-- /form -->
                </div>
            </div>


            <div class="form-group">
                <div class="d-flex justify-content-center">
                    <a id="send-point"
                       href="{{ route('member.update-point-send', [ 'type_user'=> $type]) }}"
                       class="btn btn-success mr-1 btn-action"
                       data-method="post"
                       data-trans-button-cancel="@lang('labels.general.cancel')"
                       data-trans-button-confirm="OK"
                       data-trans-title="@lang('alerts.general.confirm.send_point')">
                        @lang('users.label.send')
                    </a>
                    <a href="{{ route('member.index', [ 'type_user'=>  $type ]) }}"
                       class="btn btn-danger btn-action">@lang('labels.general.cancel')</a>

                </div>
            </div>
        </form>
    </div>

@endsection
@section('pagespecificscripts')
    {!! script(('assets/admin/js/fixScrollHeader.js')) !!}
    {!! script(('assets/admin/js/adjustment.js')) !!}
@stop


