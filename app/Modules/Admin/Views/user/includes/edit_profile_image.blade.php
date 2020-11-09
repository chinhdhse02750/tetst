<div class="tab-pane fade" id="pills-profile-image" role="tabpanel" aria-labelledby="pills-profile-image-tab">
    <form id="profile-image-form"
          action="{{ route('member.update', ['id'=>$user->id, 'type_user'=> $user->type_name]) }}"
          method="POST">
        {{ csrf_field() }}
        @method('PUT')
        <input type="hidden" name="profile-image-form" value="yes">
        <div class="card-body">
            <div class="form-group row flex-group">
                <div class="col-md-12">
                    <span class="upload-note"><i class="cil-warning"></i> @lang('alerts.upload.accept_extension_image')</span>
                    <div class="row mt-4 mb-4" role="form">
                        <div class="col">
                            <div class="form-group">
                                <div class="needsclick dropzone" id="image-profile-dropzone"></div>
                            </div>
                            <input type="hidden" name="maxFile" value="{{ empty($dataProfile) }}">
                            <div id="profile-previews" class="previews-image">
                                @if($dataProfile)
                                    <div class="dz-image" id="{{ $dataProfile->id }}">
                                        <div class="image-frames" >
                                            <img class="dz-image-display"
                                                 src="{{ $dataProfile->thumbnail_url ? $dataProfile->thumbnail_url : $dataProfile->media_url }}"
                                                 alt="{{ $dataProfile->name }}">
                                        </div>
                                        <span class="file-size dz-name-display">{{ $dataProfile->size }}</span>
                                        <input type="hidden" name="old-profile-image"
                                               value="true">
                                        <input type="hidden" name="profile-image[]"
                                               data-id="{{ $dataProfile->id }}"
                                               value="{{ $dataProfile->name }}|{{  $dataProfile->thumbnail_name }}|{{ $dataProfile->type }}|{{  $dataProfile->size }}|{{ $dataProfile->thumbnail_size }}">
                                        <button type="button" class="btn btn-danger pull-right dz-remove profile-image"
                                                data-id="{{ $dataProfile->id }}">@lang('users.label.delete')
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div> <!-- /form -->
                </div>
            </div>
            <div class="form-group">
                <div class="d-flex justify-content-center">
                    <input type="submit" class="btn btn-primary mr-1 btn-action"
                           id="change-profile-media" value="@lang('users.label.update')"/>
                    <a href="{{ route('member.index', $user->type_name) }}"
                       class="btn btn-danger btn-action">@lang('labels.general.cancel')</a>
                </div>
            </div> <!--row-->
        </div>
    </form>
</div>
