<div class="tab-pane fade" id="pills-register" role="tabpanel" aria-labelledby="pills-register-tab">
    <form id="register-form" action="{{ route('member.update', ['id'=>$user->id, 'type_user'=> $user->type_name]) }}" method="POST">
        {{ csrf_field() }}
        <input type="hidden" name="register-form" value="true">
        @method('PUT')
        <div class="card-body">
            <div class="form-group row flex-group">
                <div class="col-md-12">
                    <div class="mt-4 mb-4">
                        <div class="col">
                            <div class="form-group row">
                                <label class="col-md-2 form-control-label"
                                       for="name">@lang('users.label.name')<span
                                        class="required">*</span></label>
                                <div class="col-md-10">
                                    <input class="form-control {{ $errors->has('name') ? "field-error" : '' }}"
                                           required
                                           type="text"
                                           name="name"
                                           id="name"
                                           maxlength="255"
                                           placeholder="Name"
                                           value="{{ !empty($user->userProfile) ?  $user->userProfile->name : '' }}">
                                </div><!--col-->
                            </div><!--form-group-->
                            <div class="form-group row">
                                <label class="col-md-2 form-control-label"
                                       for="rank_id">@lang('users.label.rank')</label>
                                <div class="col-md-2">
                                    <select class="custom-select" name="rank_id" id="rank">
                                        @foreach($ranks as $key => $rank)
                                            @if (!empty($user->userProfile) &&  $user->userProfile->rank_id  === $rank->id)
                                                <option value="{{ $rank->id }}" selected>
                                                    {{ !empty($rank->name) ? $rank->name : '' }}
                                                </option>
                                            @else
                                                <option value="{{ $rank->id }}">
                                                    {{ !empty($rank->name) ? $rank->name : '' }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div><!--col-->
                            </div><!--form-group-->
                            <div class="form-group row">
                                <label class="col-md-2 form-control-label"
                                       for="tel">@lang('users.label.tel') <span
                                        class="required">*</span></label>
                                <div class="col-md-10">
                                    <input class="form-control {{ $errors->has('tel') ? "field-error" : '' }}"
                                           required
                                           type="number"
                                           name="tel"
                                           id="tel"
                                           placeholder="Cellphone number"
                                           value="{{ !empty($user->userProfile) ? $user->userProfile->tel : '' }}">
                                </div><!--col-->

                            </div><!--form-group-->
                            <div class="form-group row">
                                <label class="col-md-2 form-control-label"
                                       for="line_id">@lang('users.label.line_id')</label>

                                <div class="col-md-10">
                                    <input class="form-control"
                                           type="text"
                                           name="line_id"
                                           id="line_id"
                                           maxlength="255"
                                           placeholder="Line ID"
                                           value="{{ !empty($user->userProfile) ? $user->userProfile->line_id : '' }}">
                                </div><!--col-->
                            </div><!--form-group-->
                            <div class="form-group row">
                                <label class="col-md-2 form-control-label"
                                       for="expired_at">@lang('users.label.expired')</label>

                                <div class="col-md-3">
                                    <input type="text"
                                           class="form-control"
                                           name="expired_at"
                                           id="expired"
                                           placeholder="yyyy-mm-dd"
                                           autocomplete="off"
                                           @if(!empty($user->userProfile) && $user->userProfile->expired_at )
                                           value="{{ \Carbon\Carbon::parse($user->userProfile->expired_at)->format('Y-m-d') }}"
                                        @endif>
                                </div><!--col-->
                            </div><!--form-group-->
                        </div>
                    </div> <!-- /form -->
                </div>
            </div>
            <div class="form-group">
                <div class="d-flex justify-content-center">
                    <input type="submit" class="btn btn-primary mr-1 btn-action"
                           value="@lang('labels.general.update')"/>
                    <a href="{{ route('member.index', $user->type_name) }}"
                       class="btn btn-danger btn-action">@lang('labels.general.cancel')</a>
                </div>
            </div> <!--row-->
        </div>
    </form>
</div>
