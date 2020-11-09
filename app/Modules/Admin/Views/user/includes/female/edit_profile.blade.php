<div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
    <form id="profile-form" action="{{ route('member.update', ['id'=>$user->id, 'type_user'=> 'female']) }}" method="POST">
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
                                       for="age">@lang('users.label.age')</label>
                                <div class="col-md-2">
                                    <input class="form-control {{ $errors->has('age') ? "field-error" : '' }}"
                                           required type="number"
                                           name="age"
                                           id="age"
                                           min="1"
                                           placeholder="Age"
                                           value="{{ !empty($user->userProfile) ? $user->userProfile->age : '' }}">
                                    @if ($errors->has('age'))
                                        <span class="invalid feedback error-alert" role="alert">
                                          <small class="message-alert">{{ $errors->first('age') }}.</small>
                                          </span>
                                    @endif
                                </div><!--col-->
                            </div><!--form-group-->
                            <div class="form-group row">
                                <label class="col-md-2 form-control-label"
                                       for="height">@lang('users.label.height')
                                    <span class="required">*</span></label>

                                <div class="col-md-2">
                                    <input
                                        class="form-control {{ $errors->has('height') ? "field-error" : '' }}"
                                        required type="number"
                                        name="height"
                                        id="height"
                                        min="1"
                                        placeholder="Height"
                                        value="{{!empty($user->userProfile) ? $user->userProfile->height : '' }}">
                                    @if ($errors->has('height'))
                                        <span class="invalid feedback error-alert" role="alert">
                                          <small class="message-alert">{{ $errors->first('height') }}.</small>
                                          </span>
                                    @endif
                                </div>
                                <span class="form-control-label">cm</span>
                            </div><!--form-group-->
                            <div class="form-group row">
                                <label class="col-md-2 form-control-label"
                                       for="weight">@lang('users.label.weight')
                                    <span class="required">*</span></label>

                                <div class="col-md-2">
                                    <input
                                        class="form-control {{ $errors->has('weight') ? "field-error" : '' }}"
                                        required type="number"
                                        name="weight"
                                        id="weight"
                                        min="1"
                                        placeholder="weight"
                                        value="{{ !empty($user->userProfile) ?  $user->userProfile->weight : '' }}">

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
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-2">
                                    <select class="custom-select" name="underwear_type" id="underwear_type">
                                        @foreach($selectOption['underwear_types'][App::getLocale()] as $key => $underwear_type)
                                            @if (!empty($user->userProfile)  && $user->userProfile->underwear_type == $key)
                                                <option value="{{ $key }}"
                                                        selected> {{ $underwear_type }}</option>
                                            @else
                                                <option value="{{ $key }}"> {{ $underwear_type }}</option>
                                            @endif
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
                                        <option value="0"
                                                @if (!empty($user->userProfile) && $user->userProfile->rating_star == 0)
                                                selected="selected"
                                            @endif> 0
                                        </option>
                                        @foreach($selectOption['rating_stars'] as $key => $rating_star)
                                            @if (!empty($user->userProfile) && $user->userProfile->rating_star == $rating_star)
                                                <option value="{{ $rating_star }}" selected> {{ $rating_star }}</option>
                                            @else
                                                <option value="{{ $rating_star }}"> {{ $rating_star }}</option>
                                            @endif
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
                                            @if (!empty($user->userProfile) && $user->userProfile->dating_type == $key)
                                                <option value="{{ $key }}" selected> {{ $dating_type }}</option>
                                            @else
                                                <option value="{{ $key }}"> {{ $dating_type }}</option>
                                            @endif
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
                                                    @if ($userPrefecture->area_id == $area->id) selected="selected"@endif>
                                                {{ $area->name }}</option>
                                        @endforeach
                                    </select>
                                </div><!--col-->

                                <div class="col-md-2">
                                    <select class="custom-select" name="prefecture" id="prefecture" required>
                                        @foreach($prefectures as $key => $prefecture)
                                            <option value="{{ $prefecture->id }}"
                                                    @if ($userPrefecture->id == $prefecture->id) selected="selected"@endif>
                                                {{ $prefecture->name }}</option>
                                        @endforeach
                                    </select>
                                </div><!--col-->
                            </div><!--form-group-->
                            <div class="form-group row">
                                <label class="col-md-2 form-control-label"
                                       for="sign">@lang('users.label.sign')</label>

                                <div class="col-md-10">
                                    <input class="form-control"
                                           type="text"
                                           name="sign"
                                           id="sign"
                                           maxlength="255"
                                           placeholder="Sign"
                                           value="{{ !empty($user->userProfile) ? $user->userProfile->sign : '' }}">

                                </div><!--col-->
                            </div><!--form-group-->
                            <div class="form-group row">
                                <label class="col-md-2 form-control-label"
                                       for="blood_type">@lang('users.label.blood_type')
                                    <span class="required">*</span></label>

                                <div class="col-md-2">
                                    <select class="custom-select" name="blood_type" id="blood_type">
                                        @foreach($selectOption['blood_types'][App::getLocale()] as $key => $blood_type)
                                            @if (!empty($user->userProfile) && $user->userProfile->blood_type == $key)
                                                <option value="{{ $key }}" selected> {{ $blood_type }}</option>
                                            @else
                                                <option value="{{ $key }}"> {{ $blood_type }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
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
                                           placeholder="Occupation"
                                           value="{{ !empty($user->userProfile) ? $user->userProfile->occupation : '' }}">
                                </div><!--col-->
                            </div><!--form-group-->
                            <div class="form-group row">
                                <label class="col-md-2 form-control-label"
                                       for="smoking">@lang('users.label.smoking')
                                    <span class="required">*</span></label>

                                <div class="col-md-10">
                                    <input type="radio" class="radio" name="smoking" value="0" id="n_smoking"
                                           @if (!empty($user->userProfile) && $user->userProfile->smoking === 0) checked @endif/>
                                    <label for="n_smoking">@lang('users.label.no_smoking')</label>
                                    <input type="radio" class="radio" name="smoking" value="1" id="y_smoking"
                                           @if (!empty($user->userProfile) && $user->userProfile->smoking === 1) checked @endif/>
                                    <label for="y_smoking">@lang('users.label.has_smoking')</label>

                                </div><!--col-->
                            </div><!--form-group-->
                            <div class="form-group row">
                                <label class="col-md-2 form-control-label"
                                       for="is_pickup">@lang('users.label.pickup')</label>

                                <div class="col-md-2">
                                    <input type='hidden' value='0' name='is_pickup'>
                                    <input type="checkbox" class="radio" name="is_pickup" value="1" id="pickup"
                                           @if (!empty($user->userProfile) && $user->userProfile->is_pickup === 1) checked @endif/>
                                </div><!--col-->
                            </div><!--form-group-->
                            <div class="form-group row">
                                <label class="col-md-2 form-control-label"
                                       for="alcohol">@lang('users.label.alcohol')</label>

                                <div class="col-md-10">
                                    <input type="radio" class="radio" name="alcohol" value="0" id="n_alcohol"
                                           @if (!empty($user->userProfile) && $user->userProfile->alcohol === 0) checked @endif/>
                                    <label for="n_alcohol">@lang('users.label.no_drink')</label>
                                    <input type="radio" class="radio" name="alcohol" value="1" id="y_alcohol"
                                           @if (!empty($user->userProfile) && $user->userProfile->alcohol === 1) checked @endif/>
                                    <label for="y_alcohol">@lang('users.label.drink')</label>

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
                                           placeholder="Address"
                                           value="{{ !empty($user->userProfile) ? $user->userProfile->address : '' }}">
                                </div><!--col-->
                            </div><!--form-group-->
                            <div class="form-group row">
                                <label class="col-md-2 form-control-label"
                                       for="conversation_lang">@lang('users.label.conversation_lang')</label>

                                <div class="col-md-10">
                                    <input class="form-control"
                                           type="text"
                                           name="conversation_lang"
                                           maxlength="255"
                                           id="conversation_lang"
                                           placeholder="Conversation lang"
                                           value="{{ !empty($user->userProfile) ? $user->userProfile->conversation_lang : '' }}">
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
                                        rows='3'>{{ !empty($user->userProfile) ? $user->userProfile->hobby : '' }}</textarea>
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
                                        rows='3'>{{ !empty($user->userProfile) ? $user->userProfile->offer : '' }}</textarea>
                                </div><!--col-->
                            </div><!--form-group-->
                            <div class="form-group row">
                                <label class="col-md-2 form-control-label"
                                       for="tag">@lang('users.label.tag')</label>

                                <div class="col-md-10">
                                    <input class="form-control"
                                           type="text"
                                           name="tag"
                                           id="tag"
                                           maxlength="255"
                                           placeholder="Tag"
                                           value="{{ !empty($user->userProfile) ? $user->userProfile->tag : '' }}">
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
                                        rows="3">{!! !empty($user->userProfile) ? html_entity_decode($user->userProfile->comment) : '' !!}</textarea>
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
                                        rows="3">{!! !empty($user->userProfile) ? html_entity_decode($user->userProfile->club_comment) : '' !!}</textarea>
                                </div><!--col-->
                            </div><!--form-group-->
                            <div class="form-group row">
                                <label class="col-md-2 form-control-label" for="label_type">@lang('users.label.label_type')</label>

                                <div class="col-md-6">
                                    <input type="radio" class="radio" name="label_type" value="0" id="new_member"
                                        {{ $user->userProfile->label_type == '0' ? 'checked' : '' }}/>
                                    <label for="new_member" class="mr-2">@lang('users.label.new_member')</label>

                                    <input type="radio" class="radio" name="label_type" value="2" id="new_comment"
                                        {{ $user->userProfile->label_type == '2' ? 'checked' : '' }}/>
                                    <label for="new_comment" class="mr-2">@lang('users.label.new_comment')</label>

                                    <input type="radio" class="radio" name="label_type" value="3" id="other"
                                        {{ $user->userProfile->label_type == '3' ? 'checked' : '' }}/>
                                    <label for="other" class="mr-2">@lang('users.label.other')</label>
                                </div><!--col-->
                                <div class="col-md-3 custom-label {{ $user->userProfile->label_type != '3' ? 'd-none' : '' }}">
                                    <input type="text" name="label_title" class="form-control"
                                           value="{{ $user->userProfile->label_title }}"
                                           placeholder="{{trans('placeholder.member.label_title')}}">
                                </div>
                                <div class="col-md-1 custom-label {{ $user->userProfile->label_type != '3' ? 'd-none' : '' }}">
                                    <input type="color" class="form-control" id="label_color"
                                           name="label_color_code"
                                           value="{{ $user->userProfile->label_color_code ? $user->userProfile->label_color_code: \App\Helpers\Constants::DEFAULT_COLOR }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 form-control-label" for="label_type">@lang('user_profile.label.receipt_type')</label>

                                <div class="col-md-10">
                                    <input type="radio" class="radio" name="receipt_type" value="0" id="no_receipt"
                                            {{ $user->userProfile->receipt_type === 0 ? 'checked' : '' }}/>
                                    <label for="no_receipt" class="mr-2">@lang('user_profile.label.no_receipt')</label>

                                    <input type="radio" class="radio" name="receipt_type" value="1" id="receipt_mail"
                                            {{ $user->userProfile->receipt_type === 1 ? 'checked' : '' }}/>
                                    <label for="receipt_mail" class="mr-2">@lang('user_profile.label.receipt_mail')</label>

                                    <input type="radio" class="radio" name="receipt_type" value="2" id="receipt_pdf"
                                            {{ $user->userProfile->receipt_type === 2 ? 'checked' : '' }}/>
                                    <label for="receipt_pdf" class="mr-2">@lang('user_profile.label.receipt_pdf')</label>
                                    <div class="receipt_description mt-4 {{ $user->userProfile->receipt_type === 0 ? 'd-none' : '' }}">
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
