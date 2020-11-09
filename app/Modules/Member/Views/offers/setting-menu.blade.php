<div class="section">
    <div id="flow_navi" class="mt-5 mt-button-setting">
        <div class="other-flow_01_on flow-setting {{ active_class(!Route::is('offer.index'), 'd-none d-sm-none d-md-block') }}">
            <button type="button"
                    class="btn  btn-setting {{ active_class(Route::is('offer.index'), 'btn-setting-active') }}">
                @lang('offers.label.setting_list')</button>
        </div>
        <div class="other-flow_arrow flow-setting">→</div>
        <div class="other-flow_02 flow-setting {{ active_class(!Route::is('offer.detail'), 'd-none d-sm-none d-md-block') }}">
            <button type="button"
                    class="btn btn-setting {{ active_class(Route::is('offer.detail'), 'btn-setting-active') }}">
                @lang('offers.label.enter_setting_detail')</button>
        </div>
        <div class="other-flow_arrow flow-setting">→</div>
        <div class="other-flow_03 flow-setting {{ active_class(!Route::is('offer.confirm'), 'd-none d-sm-none d-md-block') }}">
            <button type="button"
                    class="btn btn-setting {{ active_class(Route::is('offer.confirm'), 'btn-setting-active') }}">
                @lang('offers.label.confirm_setting')
            </button>
        </div>
        <div class="other-flow_arrow flow-setting">→</div>
        <div class="other-flow_04 flow-setting {{ active_class(!Route::is('offer.success'), 'd-none d-sm-none d-md-block') }}">
            <button type="button" class="btn btn-setting {{ active_class(Route::is('offer.success'), 'btn-setting-active') }}">
                @lang('offers.label.send_request')
            </button>
        </div>
    </div>
    <div class="clr"></div>
</div>
