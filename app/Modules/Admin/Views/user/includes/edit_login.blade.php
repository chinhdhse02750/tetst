<div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="pills-login-tab">
    <form id="login-form" action="{{ route('member.update', ['id'=>$user->id, 'type_user'=> $user->type_name]) }}"
          method="POST">
        {{ csrf_field() }}
        <input type="hidden" name="login-form" value="true">
        @method('PUT')
        <div class="card-body">
            <div class="form-group row flex-group">
                <div class="col-md-12">
                    <div class="mt-4 mb-4">
                        <div class="col">
                            <div class="form-group row">
                                <label for="email"
                                       class="col-md-2 form-control-label">@lang('users.label.email')</label>
                                <div class="col-md-5">
                                    <input type="email" id="email" placeholder="E-mail Address"
                                           class="form-control {{ $errors->has('email') ? "field-error" : '' }}"
                                           value="{{ $user->email }}" disabled>

                                    <input type="hidden" name="email" value="{{ $user->email }}">
                                </div>
                                @if ($errors->has('email'))
                                    <span class="invalid feedback error-alert" role="alert">
                                        <small class="message-alert">{{ $errors->first('email') }}.</small>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group row">
                                <label for="password"
                                       class="col-md-2 form-control-label ">@lang('users.label.password')</label>
                                <div class="col-md-5">
                                    <input type="password" id="password" placeholder="Password"
                                           name="password"
                                           minlength="8"
                                           class="form-control {{ $errors->has('password') ? "field-error" : '' }}">
                                    @if ($errors->has('password'))
                                        <span class="invalid feedback error-alert" role="alert">
                                        <small class="message-alert">{{ $errors->first('password') }}.</small>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password_confirmation"
                                       class="col-md-2 form-control-label pdr-5">@lang('users.label.password_confirm')
                                </label>
                                <div class="col-md-5">
                                    <input type="password" id="password_confirmation"
                                           placeholder="Password Confirmation"
                                           name="password_confirmation"
                                           minlength="8"
                                           class="form-control {{ $errors->has('password_confirmation') ? "field-error" : '' }}">
                                    @if ($errors->has('password_confirmation'))
                                        <span class="invalid feedback error-alert" role="alert">
                                            <small class="message-alert">{{ $errors->first('password_confirmation') }}.</small>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div> <!-- /form -->
                </div>
            </div>
            <div class="form-group">
                <div class="d-flex justify-content-center">
                    <input type="submit" class="btn btn-primary mr-1 btn-action"
                           id="change-login" value="@lang('labels.general.update')"/>
                    <a href="{{ route('member.index', $user->type_name) }}"
                       class="btn btn-danger btn-action">@lang('labels.general.cancel')</a>
                </div>
            </div> <!--row-->
        </div>
    </form>
</div>
