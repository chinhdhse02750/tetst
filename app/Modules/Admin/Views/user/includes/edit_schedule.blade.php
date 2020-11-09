<div class="tab-pane fade" id="pills-schedule" role="tabpanel" aria-labelledby="pills-schedule-tab">
    <form id="schedule-form" action="{{ route('member.update', ['id'=>$user->id, 'type_user'=> $user->type_name]) }}"
          method="POST">
        {{ csrf_field() }}
        @method('PUT')
        <input type="hidden" name="schedule-form" value="yes">
        <div id="scheduleCalendarHidden" class="d-none">
            {!! $user->schedule_html !!}
        </div>
        <div class="card-body">
            <div class="form-group row flex-group">
                <div class="col-md-12">
                    <div class="member-schedule__edit">
                        <div
                            id="memberSchedule"
                            data-noon-ok="@lang('users.label.noon_ok')"
                            data-night-ok="@lang('users.label.night_ok')"
                            data-noon="@lang('users.label.noon')"
                            data-night="@lang('users.label.night')"
                            data-lang="{{ lang_schedule() }}"
                            data-edit="1"
                            data-schedules="{{ $user->data_schedules }}"></div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="d-flex justify-content-center">
                    <input type="submit" class="btn btn-primary mr-1 btn-action"
                           id="update-schedule" value="@lang('users.label.update')"/>
                    <a href="{{ route('member.index', $user->type_name) }}"
                       class="btn btn-danger btn-action">@lang('labels.general.cancel')</a>
                </div>
            </div> <!--row-->
        </div>
    </form>
</div>
