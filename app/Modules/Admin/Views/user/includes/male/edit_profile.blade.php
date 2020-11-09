<div class="tab-pane fade" id="pills-male-profile" role="tabpanel" aria-labelledby="pills-male-profile-tab">
    <form id="male-profile-form" action="{{ route('member.update', ['id'=>$user->id, 'type_user'=> 'male']) }}"
          method="POST">
        {{ csrf_field() }}
        @method('PUT')
        <input type="hidden" name="profile-form" value="yes">
        <input type="hidden" name="type" value="{{ $user->type }}">
        <div class="card-body">
            <div class="form-group row flex-group">
                <div class="col-md-12">
                    <div class="mt-4 mb-4">
                        <div class="col">
                            <div class="form-group row">
                                <label class="col-md-2 form-control-label"
                                       for="birthday">@lang('users.label.birthday')</label>

                                <div class="col-md-3">
                                    <input type="text"
                                           class="form-control"
                                           name="birthday"
                                           id="birthday"
                                           placeholder="yyyy-mm-dd"
                                           autocomplete="off"
                                           @if(!empty($user->userProfile) && $user->userProfile->birthday)
                                           value="{{ \Carbon\Carbon::parse($user->userProfile->birthday)->format('Y-m-d') }}"
                                        @endif
                                    />
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
                                        @foreach($selectOption['blood_types'][App::getLocale()] as $key => $blood_types)
                                            @if (!empty($user->userProfile)  && $user->userProfile->blood_type == $key)
                                                <option value="{{ $key }}"
                                                        selected> {{ $blood_types }}</option>
                                            @else
                                                <option value="{{ $key }}"> {{ $blood_types }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div><!--form-group-->
                            <div class="form-group row">
                                <label class="col-md-2 form-control-label" for="male_age">年齢</label>
                                <div class="col-md-2">
                                    <select class="custom-select" name="male_age" id="male_age">
                                        @foreach($selectOption['male_ages'][App::getLocale()] as $key => $age)
                                            @if (!empty($user->userProfile)  && $user->userProfile->male_age == $key)
                                                <option value="{{ $key }}"
                                                        selected> {{ $age }}</option>
                                            @else
                                                <option value="{{ $key }}"> {{ $age }}</option>
                                            @endif
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
                                                   @if (!empty($user->userProfile)  &&
                                               (strpos($user->userProfile->favorite_dating_type, strval($key)) !== false))
                                                   checked
                                                @endif/>
                                            <label
                                                for="favorite_dating_type_{{ $key }}">{{ $value }}</label>
                                        </div>
                                    @endforeach

                                </div><!--col-->
                            </div><!--form-group-->
                            <div class="form-group row">
                                <label class="col-md-2 form-control-label"
                                       for="address">@lang('users.label.address')</label>

                                <div class="col-md-10">
                                    <input class="form-control"
                                           type="text"
                                           name="address"
                                           id="address"
                                           maxlength="255"
                                           value="{{ !empty($user->userProfile) ? $user->userProfile->address : '' }}"
                                           placeholder="Address">
                                </div><!--col-->
                            </div><!--form-group-->
                            <div class="form-group row">
                                <label class="col-md-2 form-control-label"
                                       for="occupation">@lang('users.label.occupation')</label>

                                <div class="col-md-10">
                                    <input class="form-control"
                                           type="text"
                                           name="occupation"
                                           id="occupation"
                                           maxlength="255"
                                           value="{{ !empty($user->userProfile) ? $user->userProfile->occupation : '' }}"
                                           placeholder="Occupation">
                                </div><!--col-->
                            </div><!--form-group-->
                            <div class="form-group row">
                                <label class="col-md-2 form-control-label"
                                       for="male_smoking">@lang('users.label.male_smoking')</label>

                                <div class="col-md-10">
                                    @foreach($selectOption['male_smoking'][App::getLocale()] as $key => $value)
                                        <div class="form-checkbox">
                                            <input type="radio" class="radio" name="male_smoking" value="{{ $key }}"
                                                   @if (!empty($user->userProfile) && $user->userProfile->male_smoking === $key) checked
                                                   @endif
                                                   id="{{ $value }}"/>
                                            <label for="{{ $value }}">{{ $value }} </label>
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
                                             rows="3">{{ !empty($user->userProfile) ? $user->userProfile->male_alcohol : '' }}</textarea>
                                </div><!--col-->
                            </div><!--form-group-->
                            <div class="form-group row">
                                <label class="col-md-2 form-control-label"
                                       for="income">@lang('users.label.income')</label>
                                <div class="col-md-2">
                                    <select class="custom-select" name="income" id="income">
                                        @foreach($selectOption['income'][App::getLocale()] as $key => $income)
                                            @if (!empty($user->userProfile)  && $user->userProfile->income == $key)
                                                <option value="{{ $key }}"
                                                        selected> {{ $income }}</option>
                                            @else
                                                <option value="{{ $key }}"> {{ $income }}</option>
                                            @endif
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
                                             rows='3'>{{ !empty($user->userProfile) ? $user->userProfile->hobby : '' }}</textarea>
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
                                             rows="3">{!! !empty($user->userProfile) ? html_entity_decode($user->userProfile->comment) : '' !!}</textarea>
                                </div><!--col-->
                            </div><!--form-group-->
                            <div class="form-group row">
                                <label class="col-md-2 form-control-label"
                                       for="label_type">@lang('user_profile.label.receipt_type')</label>

                                <div class="col-md-10">
                                    <input type="radio" class="radio" name="receipt_type" value="0" id="no_receipt"
                                        {{ $user->userProfile->receipt_type === 0 ? 'checked' : '' }}/>
                                    <label for="no_receipt" class="mr-2">@lang('user_profile.label.no_receipt')</label>

                                    <input type="radio" class="radio" name="receipt_type" value="1" id="receipt_mail"
                                        {{ $user->userProfile->receipt_type === 1 ? 'checked' : '' }}/>
                                    <label for="receipt_mail"
                                           class="mr-2">@lang('user_profile.label.receipt_mail')</label>

                                    <input type="radio" class="radio" name="receipt_type" value="2" id="receipt_pdf"
                                        {{ $user->userProfile->receipt_type === 2 ? 'checked' : '' }}/>
                                    <label for="receipt_pdf"
                                           class="mr-2">@lang('user_profile.label.receipt_pdf')</label>
                                    <div
                                        class="receipt_description mt-4 {{ $user->userProfile->receipt_type === 0 ? 'd-none' : '' }}">
                                        <span>@lang('user_profile.label.receipt_detail_title')</span>
                                        <a href="#" data-toggle="modal" data-target="#receiptModal" class="ml-4">
                                            @lang('user_profile.label.receipt_description_guide')
                                        </a>
                                        @include('user.includes.receipt_modal')
                                        <textarea type="text"
                                                  name="receipt_description"
                                                  rows="5"
                                                  placeholder="@lang('placeholder.member.receipt_description')"
                                                  class="form-control">{{ $user->userProfile->receipt_description ? $user->userProfile->receipt_description : '' }}</textarea>
                                    </div>
                                </div><!--col-->
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 form-control-label" for="is_publish">@lang('user_profile.label.is_publish')</label>

                                <div class="col-md-10">
                                    <input type="checkbox" class="radio" name="is_publish" value="1" id="is_publish"
                                            {{ $user->userProfile->is_publish === 1 ? 'checked' : '' }}/>
                                </div><!--col-->
                            </div><!--form-group-->
                        </div>
                    </div> <!-- /form -->
                </div>
            </div>
            <div class="form-group">
                <div class="d-flex justify-content-center">
                    <input type="submit" class="btn btn-primary mr-1 btn-action"
                           id="change-profile" value="@lang('users.label.update')"/>
                    <a href="{{ route('member.index', $user->type_name) }}"
                       class="btn btn-danger btn-action">@lang('labels.general.cancel')</a>
                </div>
            </div> <!--row-->
        </div>
    </form>
</div>
