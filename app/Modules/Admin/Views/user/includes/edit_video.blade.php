<div class="tab-pane fade" id="pills-video" role="tabpanel" aria-labelledby="pills-video-tab">
    <form id="video-form" action="{{ route('member.update', ['id'=>$user->id, 'type_user'=> $user->type_name]) }}"
          method="POST">
        {{ csrf_field() }}
        @method('PUT')
        <input type="hidden" name="video-form" value="yes">
        <div class="card-body">
            <div class="form-group row flex-group">
                <div class="col-md-12">
                    <span class="upload-note"><i class="cil-warning"></i> @lang('alerts.upload.accept_extension_video')</span>
                    <div class="row mt-4 mb-4" role="form">
                        <div class="col">
                            <div class="form-group">
                                <div class="needsclick dropzone" id="video-dropzone"></div>
                            </div>
                            <div id="video-previews">
                                @foreach($user->videos as $key => $value)
                                    <div class="dz-image" id="{{ $value->id }}">
                                        <video width="150" controls poster="{{ $value->thumbnail_url }}">
                                            <source src="{{ $value->video_url }}" type="video/{{ $value->type }}">
                                        </video>
                                        <span class="file-size dz-name-display">{{ $value->size }}</span>
                                        <input type="hidden" name="nameVideos[]" value="{{ $value->name }}">
                                        <input type="hidden" name="nameThumbnailVideo[]"
                                               value="{{ $value->thumbnail_name }}">
                                        <input type="hidden" name="videos[]" data-id="{{ $value->pivot->video_id }}"
                                               value="{{ $value->name }}|{{  $value->thumbnail_name }}|{{ $value->type }}|{{  $value->size }}|{{ $value->thumbnail_size }}">
                                        <button type="button" class="btn btn-danger pull-right dz-remove"
                                                data-id="{{ $value->id }}">@lang('labels.general.delete')</button>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div> <!-- /form -->
                </div>
            </div>
            <div class="form-group">
                <div class="d-flex justify-content-center">
                    <input type="submit" class="btn btn-primary mr-1 btn-action"
                           id="change-video" value="@lang('users.label.update')"/>
                    <a href="{{ route('member.index', $user->type_name) }}"
                       class="btn btn-danger btn-action">@lang('labels.general.cancel')</a>
                </div>
            </div> <!--row-->
        </div>
    </form>
</div>
