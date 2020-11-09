@extends('layouts.admin')
@section('pagespecificstyles')
    <!-- flot charts css-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet"/>
@stop

@section('content')

    <div class="container">
        <form class="form-horizontal create-form" action="{{ route('member.store', 'male') }}" method="POST">
            <div class="checkbox d-flex align-items-center row float-right">
                <input type="hidden" name="active_user" value="0"/>
                <input type="hidden" name="gender" value="male"/>
                <label class="switch switch-label switch-pill switch-primary mr-2" for="active-user">
                    <input class="switch-input" type="checkbox" name="active_user" id="active-user" value="1" checked>
                    <span class="switch-slider" data-checked="on" data-unchecked="off"></span></label>
                <div class="col text-right preview-top">
                    <input type="hidden" value="{{ route('member.preview', 'male') }}" id="preview-url">
                    <button type="submit" formaction="{{ route('member.preview', 'male') }}" class="btn btn-primary btn-sm pull-right button-preview"
                            formmethod ="POST" formtarget="_blank">@lang('users.label.preview')</button>
                </div><!--col-->
            </div>
            <input type="hidden" name="type" value="0">
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
                                           value="{{ old('email') }}" maxlength="255"
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
                                           maxlength="255"
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
                                           maxlength="255"
                                           required>
                                    @if ($errors->has('password_confirmation'))
                                        <span class="invalid feedback error-alert" role="alert">
                                           <small
                                               class="message-alert">{{ $errors->first('password_confirmation') }}</small>
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
                                <label class="col-md-2 form-control-label"
                                       for="birthday">@lang('users.label.birthday')</label>

                                <div class="col-md-3">
                                    <input type="text"
                                           id="birthday"
                                           name="birthday"
                                           class="form-control"
                                           placeholder="yyyy-mm-dd"
                                           autocomplete="off"/>

                                    @if ($errors->has('birthday'))
                                        <span class="invalid feedback error-alert" role="alert">
                                            <small class="message-alert">{{ $errors->first('birthday') }}.</small>
                                        </span>
                                    @endif
                                </div><!--col-->
                            </div><!--form-group-->

                            <div class="form-group row">
                                <label class="col-md-2 form-control-label"
                                       for="blood_type">@lang('users.label.blood_type')</label>

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
                                <label class="col-md-2 form-control-label" for="male_age">@lang('users.label.age')</label>
                                <div class="col-md-2">
                                    <select class="custom-select" name="male_age" id="male_age">
                                        @foreach($selectOption['male_ages'][App::getLocale()] as $key => $age)
                                            <option value="{{$key}}">{{ $age }}</option>
                                        @endforeach
                                    </select>
                                </div><!--col-->
                            </div><!--form-group-->
                            <div class="form-group row">
                                <label class="col-md-2 form-control-label"
                                       for="favorite_dating_type">@lang('users.label.favorite_dating_type')</label>

                                <div class="col-md-10">
                                    @foreach($selectOption['favorite_dating_type'][App::getLocale()] as $key => $value)
                                        <div class="form-checkbox">
                                            <input type="checkbox" class="radio" name="favorite_dating_type[]"
                                                   value="{{ $key }}"
                                                   id="favorite_dating_type_{{ $key }}"
                                                   @if(is_array(old('favorite_dating_type')) && in_array($key, old('favorite_dating_type'))) checked @endif>
                                            <label for="favorite_dating_type_{{ $key }}"> {{ $value }} </label>
                                        </div>

                                    @endforeach
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
                                       for="occupation">@lang('users.label.occupation')</label>

                                <div class="col-md-10">
                                    <input class="form-control" type="text" name="occupation" id="occupation"
                                           maxlength="255" value="{{ old('occupation') }}" placeholder="Occupation">
                                </div><!--col-->
                            </div><!--form-group-->
                            <div class="form-group row">
                                <label class="col-md-2 form-control-label"
                                       for="male_smoking">@lang('users.label.male_smoking')</label>

                                <div class="col-md-10">
                                    @foreach($selectOption['male_smoking'][App::getLocale()] as $key => $value)
                                        <div class="form-checkbox">
                                            <input type="radio"
                                                   class="radio"
                                                   name="male_smoking"
                                                   value="{{ $key }}"
                                                   id="male_smoking_{{ $key }}"
                                                {{ old('male_smoking') == $key ? 'checked' : '' }} />
                                            <label for="male_smoking_{{ $key }}">{{ $value }} </label>
                                        </div>

                                    @endforeach

                                </div><!--col-->
                            </div><!--form-group-->
                            <div class="form-group row">
                                <label class="col-md-2 form-control-label"
                                       for="male_alcohol">@lang('users.label.male_alcohol')</label>

                                <div class="col-md-10">
                                   <textarea class="form-control"
                                             type="text"
                                             name="male_alcohol"
                                             id="male_alcohol"
                                             maxlength="5000"
                                             rows="3">{{ old('male_alcohol') }}</textarea>
                                </div><!--col-->
                            </div><!--form-group-->
                            <div class="form-group row">
                                <label class="col-md-2 form-control-label"
                                       for="income">@lang('users.label.income')</label>
                                <div class="col-md-2">
                                    <select class="custom-select" name="income" id="income">
                                        @foreach($selectOption['income'][App::getLocale()] as $key => $value)
                                            <option value="{{$key}}">{{ $value }}</option>
                                        @endforeach
                                    </select>
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
                                             rows='3'>{{ old('hobby') }}</textarea>
                                </div><!--col-->
                            </div><!--form-group-->
                            <div class="form-group row">
                                <label class="col-md-2 form-control-label pdr-5 font-size-label"
                                       for="comment">@lang('users.label.male_comment')</label>

                                <div class="col-md-10">
                                   <textarea class="form-control"
                                             type="text"
                                             name="comment"
                                             id="comment"
                                             maxlength="5000"
                                             rows="3">{{ old('comment') }}</textarea>
                                </div><!--col-->
                            </div><!--form-group-->
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
                            <div class="form-group row">
                                <label class="col-md-2 form-control-label" for="is_publish">@lang('user_profile.label.is_publish')</label>

                                <div class="col-md-10">
                                    <input type="checkbox" class="radio" name="is_publish" value="1" id="is_publish"/>
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
            {!! csrf_field() !!}
            <div class="form-group">
                <div class="d-flex justify-content-center">
                    <input type="submit" class="btn btn-success mr-1 btn-action create-user-button"
                           value="@lang('categories.label.register')"/>
                    <a href="{{ route('member.index', 'male') }}"
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
        let url  = '{{ url('api/media') }}';
        let token  = '{{ csrf_token() }}';
        let buttonDelete = '@lang('labels.general.delete')';
        createDropzone(url, token, buttonDelete);
    </script>
@stop
