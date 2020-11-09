<div class="form-group row flex-group">
    <div class="col-md-12">
        <div class="row mt-4 mb-4">
            <div class="col">
                <div class="form-group row">
                    <label for="member_id" class="col-md-2 form-control-label">
                        @lang('offers.label.member_id')
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
                           class="col-md-2 form-control-label">@lang('offers.label.offer_date')</label>
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
                        class="col-md-2 form-control-label">@lang('offers.label.member_rank')</label>
                    <div class="col-md-10 pt-7px">
                        @foreach($ranks as $key=>$rank)
                            <input name="ranks[]"
                                   type="checkbox"
                                   id="rank{{ $key }}"
                                   value="{{ $rank->id }}"/>
                            <label for="rank{{ $key }}"
                                   class="pr-20px ">{{ $rank->name }}</label>
                        @endforeach
                    </div><!--col-->
                </div>
            </div>
        </div> <!-- /form -->
    </div>
</div><!--row-->
