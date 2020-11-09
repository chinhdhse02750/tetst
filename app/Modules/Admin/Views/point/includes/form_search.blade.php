<div class="form-group row flex-group">
    <div class="col-md-12">
        <div class="row mt-4 mb-4">
            <div class="col">
                <div class="form-group row">
                    <label for="member_id" class="col-md-2 form-control-label">
                        @lang('point.label.member_id')
                    </label>
                    <div class="col-md-5">
                        <input type="text"
                               id="member-id"
                               placeholder="ID"
                               name="id"
                               maxlength="255"
                               class="form-control"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email"
                           class="col-md-2 form-control-label">@lang('users.label.email')</label>
                    <div class="col-md-5">
                        <input type="text" id="email" placeholder="E-mail Address" name="email"
                               class="form-control"/>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="date_time"
                           class="col-md-2 form-control-label">@lang('point.label.points_earned')</label>
                    <div class="col-md-3">
                        <input type="text"
                               class="form-control"
                               name="dateFrom"
                               id="date-from"
                               placeholder="yyyy-mm-dd"
                               autocomplete="off"/>
                    </div>
                    ~
                    <div class="col-md-3">
                        <input type="text"
                               class="form-control"
                               name="dateTo"
                               id="date-to"
                               placeholder="yyyy-mm-dd"
                               autocomplete="off"/>
                    </div>
                </div>

                <div class="form-group row">
                    <label
                        class="col-md-2 form-control-label">@lang('point.label.transaction')</label>
                    <div class="col-md-10 pt-7px">
                        <input type='hidden' value='0' name='adjustment'>
                        <input type="checkbox" class="radio pdr-5" name="adjustment" value="Adjustment" checked/>
                        <label class="pr-20px">@lang('point.label.adjustment')</label>

                    </div><!--col-->
                </div>

                <div class="form-group row">
                    <label
                        class="col-md-2 form-control-label">@lang('users.label.status')</label>
                    <div class="col-md-10 pt-7px">
                        <input type="radio" class="radio pdr-5" name="status" value="1"
                               id="release"
                               checked/>
                        <label for="release"
                               class="pr-20px">@lang('users.label.public')</label>
                        <input type="radio" class="radio" name="status" value="0" id="private"/>
                        <label for="private"
                               class="pr-20px">@lang('users.label.private')</label>

                    </div><!--col-->
                </div>
            </div>
        </div> <!-- /form -->
    </div>
</div><!--row-->
