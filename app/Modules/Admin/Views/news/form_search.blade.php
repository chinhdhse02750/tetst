<div class="form-group row flex-group">
    <div class="col-md-12">
        <div class="row mt-4">
            <div class="col">
                <div class="form-group row flex-group">
                    <label for="join_date"
                           class="col-md-2 form-control-label">@lang('news.label.post_time')</label>
                    <div class="col-md-3">
                        <input type="text"
                               id="date-from-news"
                               name="start_time"
                               class="form-control"
                               placeholder="{{ trans('news.label.public_start_time') }}"
                               autocomplete="off"/>
                    </div>
                    ~
                    <div class="col-md-3">
                        <input type="text"
                               id="date-to-news"
                               name="end_time"
                               class="form-control"
                               placeholder="{{ trans('news.label.public_end_time') }}"
                               autocomplete="off"/>
                    </div>
                </div>

                <div class="form-group row">
                    <label
                        class="col-md-2 form-control-label">@lang('news.label.status')</label>
                    <div class="col-md-10 pt-7px">
                        <input type="radio" class="radio pdr-5" name="active" value="1"
                               id="public"/>
                        <label for="public"
                               class="pr-20px">@lang('news.label.public')</label>
                        <input type="radio"
                               class="radio"
                               name="active"
                               value="0"
                               id="private"/>
                        <label for="private"
                               class="pr-20px">@lang('news.label.private')</label>
                    </div><!--col-->
                </div>
            </div>
        </div> <!-- /form -->
    </div>
</div><!--row-->
@section('pagespecificscripts')
    {!! script(('assets/admin/js/news.js')) !!}
@stop
