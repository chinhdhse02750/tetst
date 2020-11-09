<div class="form-group row flex-group">
    <div class="col-md-2 control-label">
        <span>@lang('users.label.schedule')</span>
    </div>
    <div class="col-md-10">
        <div class="row">
            <div class="col">
                <div class="mt-4 mb-4 p-5 bg-white">
                    <div
                        id="memberSchedule"
                        data-noon-ok="@lang('users.label.noon_ok')"
                        data-night-ok="@lang('users.label.night_ok')"
                        data-noon="@lang('users.label.noon')"
                        data-night="@lang('users.label.night')"
                        data-lang="{{ lang_schedule() }}"></div>
                </div>
            </div>
        </div>
    </div>
</div>
