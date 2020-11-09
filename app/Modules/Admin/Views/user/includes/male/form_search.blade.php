<div class="form-group row flex-group">
    <div class="col-md-12">
        <div class="row mt-4 mb-4">
            <div class="col">
                <div class="form-group row">
                    <label for="member_id" class="col-md-2 form-control-label">
                        @lang('users.label.member_id')
                    </label>
                    <div class="col-md-5">
                        <input type="text"
                               id="member-male-id"
                               placeholder="ID"
                               name="id"
                               maxlength="255"
                               class="form-control"/>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="name" class="col-md-2 form-control-label ">
                        @lang('users.label.member_name')
                    </label>
                    <div class="col-md-5">
                        <input type="text" id="name-male" placeholder="Name" name="name"
                               maxlength="255" class="form-control"/>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email"
                           class="col-md-2 form-control-label">@lang('users.label.email')</label>
                    <div class="col-md-5">
                        <input type="text" id="email-male" placeholder="E-mail Address" name="email"
                               class="form-control"/>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="rank"
                           class="col-md-2 form-control-label">@lang('users.label.rank')</label>
                    <div class="col-md-10 pt-7px">
                        @foreach($ranks as $key => $rank)
                            <input name="rank[]"
                                   type="checkbox"
                                   id="rank{{ $key }}"
                                   value="{{ $rank->id }}"/>
                            <label for="rank{{ $key }}"
                                   class="pr-20px ">{{ $rank->name }}</label>
                        @endforeach
                    </div>
                </div>

                <div class="form-group row">
                    <label for="join_date"
                           class="col-md-2 form-control-label">@lang('users.label.join_date')</label>
                    <div class="col-md-3">
                        <input type="text"
                               id="date-from"
                               name="dateFrom"
                               class="form-control"
                               placeholder="yyyy-mm-dd"
                               autocomplete="off"/>

                    </div>
                    ~
                    <div class="col-md-3">
                        <input type="text"
                               id="date-to"
                               name="dateTo"
                               class="form-control"
                               placeholder="yyyy-mm-dd"
                               autocomplete="off"/>
                    </div>
                </div>

                <div class="form-group row">
                    <label
                        class="col-md-2 form-control-label">@lang('users.label.status')</label>
                    <div class="col-md-10 pt-7px">
                        <input type="radio" class="radio pdr-5" name="status" value="1"  id="release" checked/>
                        <label for="release" class="pr-20px">@lang('users.label.public')</label>
                        <input type="radio" class="radio" name="status" value="0" id="private"/>
                        <label for="private" class="pr-20px">@lang('users.label.private')</label>

                    </div><!--col-->
                </div>
            </div>
        </div> <!-- /form -->
    </div>
</div><!--row-->
