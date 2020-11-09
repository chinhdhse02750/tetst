@extends('layouts.admin')
@section('pagespecificstyles')
    <!-- flot charts css-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet"/>
    <link href='/assets/admin/js/fullcalendar/packages/core/main.css' rel='stylesheet'/>
    <link href='/assets/admin/js/fullcalendar/packages/daygrid/main.css' rel='stylesheet'/>
    <link href='/assets/admin/js/fullcalendar/packages/timegrid/main.css' rel='stylesheet'/>
    <link href='/assets/admin/js/fullcalendar/packages/timegrid/main.css' rel='stylesheet'/>
    <link href='/assets/admin/css/styles.css' rel='stylesheet'/>
    <link href='/css/scheduleCalendar.css' rel='stylesheet'/>
@stop

@section('content')

    <div class="container">
        <form class="form-horizontal js-create__member" action="{{ route('member.store', 'female') }}" method="POST">
            {{ csrf_field() }}
            <div id="scheduleCalendarHidden" class="d-none"></div>
            <div class="checkbox d-flex align-items-center row float-right">
                <input type="hidden" name="active_user" value="0"/>
                <input type="hidden" name="gender" value="male"/>
                <label class="switch switch-label switch-pill switch-primary mr-2" for="active-user">
                    <input class="switch-input" type="checkbox" name="active_user" id="active-user" value="1" checked>
                    <span class="switch-slider" data-checked="on" data-unchecked="off"></span></label>
                <div class="col text-right preview-top">
                    <button type="submit" formaction="{{ route('member.preview', 'female') }}"
                            class="btn btn-primary btn-sm pull-right button-preview"
                            formmethod ="POST" formtarget="_blank">@lang('users.label.preview')</button>
                </div><!--col-->
            </div>
            <input type="hidden" name="type" value="1">
            <div class="clearfix"></div>
            <div class="form-group row flex-group">
                <div class="col-md-2 control-label">
                    <span>@lang('users.label.login_information')</span>
                </div>
                <div class="col-md-10">
                    <div class="row mt-4 mb-4" role="form">
                        <div class="col">
                            <div class="form-group row">
                                <label for="email" class="col-md-2 form-control-label">@lang('users.label.email')
                                    <span class="required">*</span></label>
                                <div class="col-md-10">

                                    <input type="email" id="email" placeholder="E-mail Address" name="email"
                                           class="form-control {{ $errors->has('email') ? "field-error" : '' }}"
                                           value="{{ old('email') }}"
                                           required>
                                    @if ($errors->has('email'))
                                        <span class="invalid feedback error-alert" role="alert">
                                            <small class="message-alert">{{ $errors->first('email') }}.</small>
                                        </span>
                                    @endif
                                </div>

                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-md-2 form-control-label ">@lang('users.label.password')
                                    <span class="required">*</span></label>
                                <div class="col-md-10">
                                    <input type="password"
                                           id="password"
                                           placeholder="Password"
                                           name="password"
                                           minlength="8"
                                           class="form-control {{ $errors->has('password') ? "field-error" : '' }}"
                                           required>
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
                                    <span class="required">*</span></label>
                                <div class="col-md-10">
                                    <input type="password"
                                           id="password_confirmation"
                                           placeholder="Password Confirmation"
                                           name="password_confirmation"
                                           minlength="8"
                                           class="form-control {{ $errors->has('password_confirmation') ? "field-error" : '' }}"
                                           required>
                                    @if ($errors->has('password_confirmation'))
                                        <span class="invalid feedback error-alert" role="alert">
                                            <small class="message-alert">{{ $errors->first('password_confirmation') }}</small>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div> <!-- /form -->
                </div>
            </div>
            <div class="form-group row flex-group">
                <div class="col-md-2 control-label">
                    <span>@lang('users.label.registration_information')</span>
                </div>
                <div class="col-md-10">
                    <div class="row mt-4 mb-4" role="form">
                        <div class="col">
                            <div class="form-group row">
                                <label class="col-md-2 form-control-label" for="name">@lang('users.label.name')
                                    <span class="required">*</span></label>

                                <div class="col-md-10">
                                    <input class="form-control {{ $errors->has('name') ? "field-error" : '' }}"
                                           required type="text"
                                           name="name"
                                           id="name"
                                           maxlength="255"
                                           placeholder="Name"
                                           value="{{ old('name') }}">
                                    @if ($errors->has('name'))
                                        <span class="invalid feedback error-alert" role="alert">
                                            <small class="message-alert">{{ $errors->first('name') }}.</small>
                                         </span>
                                    @endif
                                </div><!--col-->
                            </div><!--form-group-->

                            <div class="form-group row">
                                <label class="col-md-2 form-control-label" for="rank">@lang('users.label.rank')
                                    <span class="required">*</span></label>
                                <div class="col-md-2">
                                    <select class="custom-select" name="rank" id="rank">
                                        @foreach($ranks as $key => $rank)
                                            <option
                                                value="{{ $rank->id }}">{{ $rank->name }}</option>
                                        @endforeach
                                    </select>
                                </div><!--col-->
                            </div><!--form-group-->

                            <div class="form-group row">
                                <label class="col-md-2 form-control-label" for="tel">@lang('users.label.tel')
                                    <span class="required">*</span></label>

                                <div class="col-md-10">
                                    <input class="form-control {{ $errors->has('tel') ? "field-error" : '' }}"
                                           required
                                           type="number"
                                           name="tel"
                                           id="tel"
                                           placeholder="Cellphone number"
                                           maxlength="50"
                                           value="{{ old('tel') }}">
                                    @if ($errors->has('tel'))
                                        <span class="invalid feedback error-alert" role="alert">
                                           <small class="message-alert">{{ $errors->first('tel') }}.</small>
                                        </span>
                                    @endif
                                </div><!--col-->

                            </div><!--form-group-->

                            <div class="form-group row">
                                <label class="col-md-2 form-control-label"
                                       for="line_id">@lang('users.label.line_id')</label>

                                <div class="col-md-10">
                                    <input class="form-control" type="text" name="line_id" id="line_id" maxlength="255"
                                           placeholder="Line ID" value="{{ old('line_id') }}">
                                </div><!--col-->
                            </div><!--form-group-->


                            <div class="form-group row">
                                <label class="col-md-2 form-control-label"
                                       for="expired">@lang('users.label.expired')</label>

                                <div class="col-md-3">
                                    <input type="text"
                                           id="expired"
                                           name="expired"
                                           class="form-control"
                                           placeholder="yyyy-mm-dd"
                                           autocomplete="off"/>
                                </div><!--col-->
                            </div><!--form-group-->
                        </div>
                    </div> <!-- /form -->
                </div>
            </div>
            <div class="form-group row flex-group">
                <div class="col-md-2 control-label">
                    <span>@lang('users.label.profile_information')</span>
                </div>
                <div class="col-md-10">
                    <div class="row mt-4 mb-4" role="form">
                        <div class="col">
                            <div class="form-group row">
                                <label class="col-md-2 form-control-label" for="age">@lang('users.label.age')
                                    <span class="required">*</span></label>

                                <div class="col-md-2">
                                    <input class="form-control {{ $errors->has('age') ? "field-error" : '' }}"
                                           required type="number"
                                           name="age"
                                           id="age"
                                           min="1"
                                           placeholder="Age"
                                           value="{{ old('age') }}">
                                    @if ($errors->has('age'))
                                        <span class="invalid feedback error-alert" role="alert">
                                                <small class="message-alert">{{ $errors->first('age') }}.</small>
                                                </span>
                                    @endif
                                </div><!--col-->
                            </div><!--form-group-->

                            <div class="form-group row">
                                <label class="col-md-2 form-control-label" for="height">@lang('users.label.height')
                                    <span class="required">*</span></label>

                                <div class="col-md-2">
                                    <input class="form-control {{ $errors->has('height') ? "field-error" : '' }}"
                                           required type="number"
                                           name="height"
                                           id="height"
                                           min="1"
                                           placeholder="Height"
                                           value="{{ old('height') }}">
                                    @if ($errors->has('height'))
                                        <span class="invalid feedback error-alert" role="alert">
                                                <small class="message-alert">{{ $errors->first('height') }}.</small>
                                                </span>
                                    @endif
                                </div>
                                <span class="form-control-label">cm</span>
                            </div><!--form-group-->

                            <div class="form-group row">
                                <label class="col-md-2 form-control-label" for="weight">@lang('users.label.weight')
                                    <span class="required">*</span></label>

                                <div class="col-md-2">
                                    <input class="form-control {{ $errors->has('weight') ? "field-error" : '' }}"
                                           required type="number"
                                           name="weight"
                                           id="weight"
                                           min="1"
                                           placeholder="weight"
                                           value="{{ old('weight') }}">

                                    @if ($errors->has('weight'))
                                        <span class="invalid feedback error-alert" role="alert">
                                            <small class="message-alert">{{ $errors->first('weight') }}.</small>
                                        </span>
                                    @endif
                                </div><!--col-->
                                <span class="form-control-label">kg</span>
                            </div><!--form-group-->

                            <div class="form-group row">
                                <label class="col-md-2 form-control-label"
                                       for="underwear_type">@lang('users.label.underwear_type')
                                    <span class="required">*</span></label>

                                <div class="col-md-2">
                                    <select class="custom-select" name="underwear_type" id="underwear_type">
                                        @foreach($selectOption['underwear_types'][App::getLocale()] as $key => $underwear_type)
                                            <option value="{{ $key }}"
                                                    @if (old('underwear_type') == $key) selected="selected"@endif>
                                                {{ $underwear_type }}</option>
                                        @endforeach
                                    </select>
                                </div><!--col-->
                                <span class="form-control-label">cup</span>
                            </div><!--form-group-->


                            <div class="form-group row">
                                <label class="col-md-2 form-control-label"
                                       for="rating_star">@lang('users.label.rating_star')</label>

                                <div class="col-md-2">
                                    <select class="custom-select" name="rating_star" id="rating_star">
                                        <option value="0" @if (old('rating_star') == 0) selected="selected"@endif>0
                                        </option>
                                        @foreach($selectOption['rating_stars'] as $rating_star)
                                            <option value="{{ $rating_star }}"
                                                    @if (old('rating_star') == $rating_star) selected="selected"@endif>
                                                {{ $rating_star }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div><!--col-->
                            </div><!--form-group-->
                            <div class="form-group row">
                                <label class="col-md-2 form-control-label"
                                       for="dating_type">@lang('users.label.dating_type')
                                    <span class="required">*</span></label>
                                <div class="col-md-2">
                                    <select class="custom-select" name="dating_type" id="dating_type">
                                        @foreach($selectOption['dating_types'][App::getLocale()] as $key => $dating_type)
                                            <option value="{{ $key }}"
                                                    @if (old('dating_type') == $key) selected="selected"@endif>
                                                {{ $dating_type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div><!--form-group-->
                            <div class="form-group row">
                                <label class="col-md-2 form-control-label" for="area">@lang('users.label.area')
                                    <span class="required">*</span></label>
                                <div class="col-md-2">
                                    <select class="custom-select" name="area" id="area">
                                        @foreach($areas as $key => $area)
                                            <option value="{{ $area->id }}"
                                                    @if (old('area') == $area->id) selected="selected"@endif>
                                                {{ $area->name }}</option>
                                        @endforeach
                                    </select>
                                </div><!--col-->

                                <div class="col-md-2">
                                    <select class="custom-select" name="prefecture" id="prefecture" required>
                                        @foreach($prefectures as $key => $prefecture)
                                            <option value="{{ $prefecture->id }}"
                                                    @if (old('prefecture') == $prefecture->id) selected="selected"@endif>
                                                {{ $prefecture->name }}</option>
                                        @endforeach
                                    </select>
                                </div><!--col-->
                            </div><!--form-group-->
                            <div class="form-group row">
                                <label class="col-md-2 form-control-label" for="sign">@lang('users.label.sign')</label>

                                <div class="col-md-10">
                                    <input class="form-control" type="text" name="sign" id="sign" maxlength="255"
                                           value="{{ old('sign') }}" placeholder="Sign">
                                </div><!--col-->
                            </div><!--form-group-->
                            <div class="form-group row">
                                <label class="col-md-2 form-control-label"
                                       for="blood_type">@lang('users.label.blood_type')
                                    <span class="required">*</span></label>

                                <div class="col-md-2">
                                    <select class="custom-select" name="blood_type" id="blood_type">
                                        @foreach($selectOption['blood_types'][App::getLocale()] as $key => $blood_type)
                                            <option value="{{ $key }}"
                                                    @if (old('blood_type') == $key) selected="selected"@endif>
                                                {{ $blood_type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div><!--form-group-->
                            <div class="form-group row">
                                <label class="col-md-2 form-control-label"
                                       for="occupation">@lang('users.label.occupation')</label>

                                <div class="col-md-10">
                                    <input class="form-control" type="text" name="occupation" id="occupation"
                                           maxlength="255" value="{{ old('occupation') }}" placeholder="Occupation">
                                </div><!--col-->
                            </div><!--form-group-->
                            <div class="form-group row">
                                <label class="col-md-2 form-control-label" for="smoking">@lang('users.label.smoking')
                                    <span class="required">*</span></label>

                                <div class="col-md-10">
                                    <input type="radio" class="radio" name="smoking" value="0" id="n_smoking" checked/>
                                    <label for="n_smoking">@lang('users.label.no_smoking')</label>
                                    <input type="radio" class="radio" name="smoking" value="1" id="y_smoking"/>
                                    <label for="y_smoking">@lang('users.label.has_smoking')</label>

                                </div><!--col-->
                            </div><!--form-group-->
                            <div class="form-group row">
                                <label class="col-md-2 form-control-label"
                                       for="pickup">@lang('users.label.pickup')</label>

                                <div class="col-md-2">
                                    <input type='hidden' value='0' name='pickup'>
                                    <input type="checkbox" class="radio" name="pickup" value="1" id="pickup"/>
                                </div><!--col-->
                            </div><!--form-group-->
                            <div class="form-group row">
                                <label class="col-md-2 form-control-label"
                                       for="alcohol">@lang('users.label.alcohol')</label>

                                <div class="col-md-10">
                                    <input type="radio" class="radio" name="alcohol" value="0" id="n_alcohol" checked/>
                                    <label for="n_alcohol">@lang('users.label.no_drink')</label>
                                    <input type="radio" class="radio" name="alcohol" value="1" id="y_alcohol"/>
                                    <label for="y_alcohol">@lang('users.label.drink')</label>
                                </div><!--col-->
                            </div><!--form-group-->
                            <div class="form-group row">
                                <label class="col-md-2 form-control-label"
                                       for="address">@lang('users.label.address')</label>

                                <div class="col-md-10">
                                    <input class="form-control" type="text" name="address" id="address" maxlength="255"
                                           value="{{ old('address') }}" placeholder="Address">
                                </div><!--col-->
                            </div><!--form-group-->
                            <div class="form-group row">
                                <label class="col-md-2 form-control-label"
                                       for="conversation_lang">@lang('users.label.conversation_lang')</label>

                                <div class="col-md-10">
                                    <input class="form-control" type="text" name="conversation_lang" maxlength="255"
                                           value="{{ old('conversation_lang') }}" id="conversation_lang"
                                           placeholder="Conversation lang">
                                </div><!--col-->
                            </div><!--form-group-->
                            <div class="form-group row">
                                <label class="col-md-2 form-control-label"
                                       for="hobby">@lang('users.label.hobby')</label>

                                <div class="col-md-10">
                                    <textarea class="form-control"
                                              type="text"
                                              name="hobby"
                                              id="hobby"
                                              maxlength="255"
                                              placeholder=""
                                              rows='3'>{{ old('hobby') }}</textarea>
                                </div><!--col-->
                            </div><!--form-group-->
                            <div class="form-group row">
                                <label class="col-md-2 form-control-label"
                                       for="offer">@lang('users.label.offer')</label>

                                <div class="col-md-10">
                                    <textarea class="form-control"
                                              type="text"
                                              name="offer"
                                              id="offer"
                                              maxlength="5000"
                                              placeholder=""
                                              rows='3'>{{ old('offer') }}</textarea>
                                </div><!--col-->
                            </div><!--form-group-->
                            <div class="form-group row">
                                <label class="col-md-2 form-control-label" for="tag">@lang('users.label.tag')</label>

                                <div class="col-md-10">
                                    <input class="form-control" type="text" name="tag" id="tag" maxlength="255"
                                           value="{{ old('tag')}}" placeholder="Tag">
                                </div><!--col-->
                            </div><!--form-group-->
                            <div class="form-group row">
                                <label class="col-md-2 form-control-label pdr-5 font-size-label"
                                       for="comment">@lang('users.label.comment')</label>

                                <div class="col-md-10">
                                    <textarea class="form-control"
                                              type="text"
                                              name="comment"
                                              id="comment"
                                              maxlength="5000"
                                              placeholder="Comment"
                                              rows="3">{{ old('comment') }}</textarea>
                                </div><!--col-->
                            </div><!--form-group-->
                            <div class="form-group row">
                                <label class="col-md-2 form-control-label pdr-5 font-size-label"
                                       for="club_comment">@lang('users.label.club_comment')</label>

                                <div class="col-md-10">
                                    <textarea class="form-control"
                                              type="text"
                                              name="club_comment"
                                              id="club_comment"
                                              placeholder="Club comment"
                                              maxlength="5000"
                                              rows="3">{{ old('club_comment') }}</textarea>
                                </div><!--col-->
                            </div><!--form-group-->
                            <div class="form-group row">
                                <label class="col-md-2 form-control-label"
                                       for="label_type">@lang('users.label.label_type')</label>

                                <div class="col-md-10">
                                    <input type="radio" class="radio" name="label_type" value="0" id="new_member"
                                           checked/>
                                    <label for="new_member" class="mr-2">@lang('users.label.new_member')</label>

                                    <input type="radio" class="radio" name="label_type" value="2" id="new_comment"/>
                                    <label for="new_comment" class="mr-2">@lang('users.label.new_comment')</label>

                                    <input type="radio" class="radio" name="label_type" value="3" id="other"/>
                                    <label for="other" class="mr-2">@lang('users.label.other')</label>
                                    <div class="d-none custom-label">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <input type="text" name="label_title" class="form-control" value=""
                                                       placeholder="{{ trans('placeholder.member.label_title') }}">
                                            </div>
                                            <div class="col-md-4">
                                                <input type="color" class="form-control" id="label_color"
                                                       name="label_color_code"
                                                       value="{{ \App\Helpers\Constants::DEFAULT_COLOR }}"><br><br>
                                            </div>
                                        </div>
                                    </div>
                                </div><!--col-->
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 form-control-label" for="label_type">@lang('user_profile.label.receipt_type')</label>

                                <div class="col-md-10">
                                    <input type="radio" class="radio" name="receipt_type" value="0" id="no_receipt" checked/>
                                    <label for="no_receipt" class="mr-2">@lang('user_profile.label.no_receipt')</label>

                                    <input type="radio" class="radio" name="receipt_type" value="1" id="receipt_mail"/>
                                    <label for="receipt_mail" class="mr-2">@lang('user_profile.label.receipt_mail')</label>

                                    <input type="radio" class="radio" name="receipt_type" value="2" id="receipt_pdf"/>
                                    <label for="receipt_pdf" class="mr-2">@lang('user_profile.label.receipt_pdf')</label>

                                    <div class="d-none receipt_description mt-4">
                                        <span>@lang('user_profile.label.receipt_detail_title')</span>
                                        <a href="#" data-toggle="modal" data-target="#receiptModal" class="ml-4">
                                            @lang('user_profile.label.receipt_description_guide')
                                        </a>
                                        @include('user.includes.receipt_modal')
                                        <textarea type="text"
                                                  name="receipt_description"
                                                  rows="5"
                                                  placeholder="@lang('placeholder.member.receipt_description')"
                                                  class="form-control"></textarea>
                                    </div>
                                </div><!--col-->
                            </div>
                        </div>
                    </div> <!-- /form -->
                </div>
            </div>

            <div class="form-group row flex-group">
                <div class="col-md-2 control-label">
                    <span>@lang('users.label.profile_image')</span>
                </div>
                <div class="col-md-10">
                    <small class="upload-note"><i class="cil-warning"></i> @lang('alerts.upload.accept_extension_image')</small>
                    <div class="row mt-4 mb-4" role="form">
                        <div class="col">
                            <div class="form-group">
                                <div class="needsclick dropzone" id="image-profile-dropzone"></div>
                            </div>
                            <div id="profile-previews" class="previews-image"></div>
                        </div>
                    </div> <!-- /form -->
                </div>
            </div>

            <div class="form-group row flex-group">
                <div class="col-md-2 control-label">
                    <span>@lang('users.label.public_photos')</span>
                </div>
                <div class="col-md-10">
                    <small class="upload-note"><i class="cil-warning"></i> @lang('alerts.upload.accept_extension_image')</small>
                    <div class="row mt-4 mb-4" role="form">
                        <div class="col">
                            <div class="form-group">
                                <div class="needsclick dropzone" id="image-public-dropzone"></div>
                            </div>
                            <div id="public-previews" class="previews-image"></div>
                        </div>
                    </div> <!-- /form -->
                </div>
            </div>
            <div class="form-group row flex-group">
                <div class="col-md-2 control-label">
                    <span>@lang('users.label.private_photos')</span>
                </div>
                <div class="col-md-10">
                    <small class="upload-note"><i class="cil-warning"></i> @lang('alerts.upload.accept_extension_image')</small>
                    <div class="row mt-4 mb-4" role="form">
                        <div class="col">
                            <div class="form-group">
                                <div class="needsclick dropzone" id="image-private-dropzone"></div>
                            </div>
                            <div id="private-previews" class="previews-image"></div>
                        </div>
                    </div> <!-- /form -->
                </div>
            </div>

            <div class="form-group row flex-group">
                <div class="col-md-2 control-label">
                    <span>@lang('users.label.video')</span>
                </div>
                <div class="col-md-10">
                    <small class="upload-note"><i class="cil-warning"></i> @lang('alerts.upload.accept_extension_video')</small>
                    <div class="row mt-4 mb-4" role="form">
                        <div class="col">
                            <div class="form-group">
                                <div class="needsclick dropzone" id="video-dropzone"></div>
                            </div>
                            <div id="video-previews">

                            </div>
                        </div>
                    </div> <!-- /form -->
                </div>
            </div>

            @include('user.includes.create_schedule')

            <div class="form-group">
                <div class="d-flex justify-content-center">
                    <input type="submit" class="btn btn-success mr-1 btn-action"
                           value="@lang('categories.label.register')"/>
                    <a href="{{ route('member.index', 'female') }}"
                       class="btn btn-danger btn-action">@lang('labels.general.cancel')</a>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('pagespecificscripts')
    <!-- flot charts scripts-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
    <script src="//cdn.ckeditor.com/4.14.0/full/ckeditor.js"></script>
    {!! script(('assets/admin/js/fullcalendar/packages/core/main.js')) !!}
    {!! script(('assets/admin/js/fullcalendar/packages/interaction/main.js')) !!}
    {!! script(('assets/admin/js/fullcalendar/packages/daygrid/main.js')) !!}
    {!! script(('assets/admin/js/fullcalendar/packages/timegrid/main.js')) !!}
    {!! script(('assets/admin/js/scheduleCalendar.js')) !!}
    {!! script(('assets/admin/js/fixScrollHeader.js')) !!}
    {!! script(('assets/admin/js/dropzone.js')) !!}
    {!! script(('assets/admin/js/editor.js')) !!}
    {!! script(('assets/admin/js/userProfile.js')) !!}
    {!! script(('assets/admin/js/datetimePicker.js')) !!}

    <script>
        $(document).ready(function () {
            $('#public-previews').sortable();
            $('#private-previews').sortable();

            $("#area").on('change', function () {
                let areaId = $(this).val();
                let url = "{{ url("api/v1/areas/:area_id/prefectures")  }}".replace(':area_id', areaId);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'GET',
                    url: url,
                    data: {areaId: areaId},
                    success: function (data) {
                        let select = $('#prefecture');
                        select.find('option').remove();
                        $.each(data.prefectures, function (key, value) {
                            let dataImages = ` <option value="${value.id}"> ${value.name}</option>`;
                            select.append(dataImages);
                        });

                    },
                    error: function (exception) {
                        alert('Exeption:' + exception);
                    }
                });
            });
        });

        let url = '{{ url('api/media') }}';
        let token = '{{ csrf_token() }}';
        let buttonDelete = '@lang('labels.general.delete')';
        createDropzone(url, token, buttonDelete);
        createVideoDropzone(url, token, buttonDelete);
    </script>
@stop
