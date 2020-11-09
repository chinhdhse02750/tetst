<div id="message-update-status">
</div>
<div class="row">
    <div class="col text-right preview-top">
        <input type="hidden" id="edit-status-url" value="{{ URL('api/v1/member/' . $user->id . '/status') }}"/>
        <label class="switch switch-label switch-pill switch-primary mr-2 pull-right" for="active-user">
            <input class="switch-input button-active-user"
                   type="checkbox"
                   name="active_user"
                   id="active-user"
                   value="1"
                   @if($user->active === 1) checked @endif />
            <span class="switch-slider" data-checked="on" data-unchecked="off"></span></label>
    </div><!--col-->
</div><?php
