<div class="tab-pane fade" id="pills-public-image" role="tabpanel" aria-labelledby="pills-public-image-tab">
    <form id="public-photo-form" action="{{ route('member.update', ['id'=>$user->id, 'type_user'=> $user->type_name]) }}"
          method="POST">
        {{ csrf_field() }}
        @method('PUT')
        <input type="hidden" name="public-image-form" value="yes">
        <div class="card-body">
            <div class="form-group row flex-group">
                <div class="col-md-12">
                    <span class="upload-note"><i class="cil-warning"></i> @lang('alerts.upload.accept_extension_image')</span>
                    <div class="row mt-4 mb-4" role="form">
                        <div class="col">
                            <div class="form-group">
                                <div class="needsclick dropzone" id="image-public-dropzone"></div>
                            </div>
                            <div id="public-previews" class="previews-image" >
                                @foreach($user->medias as $key => $value)
                                    @if($value->pivot->type === $isPublic)
                                        <div class="dz-image" id="{{ $value->id }}">
                                            <div class="image-frames" >
                                                <img class="dz-image-display"
                                                     src="{{ $value->thumbnail_url ? $value->thumbnail_url : $value->media_url }}"
                                                     alt="{{ $value->name }}">
                                            </div>
                                            <span class="file-size dz-name-display">{{ $value->size }}</span>
                                            <input type="hidden" name="nameMedia[]" value="{{ $value->name }}">
                                            <input type="hidden" name="nameThumbnailMedia[]"
                                                   value="{{ $value->thumbnail_name }}">
                                            <input type="hidden" name="images[]"
                                                   data-id="{{ $value->pivot->media_id }}"
                                                   value="{{ $value->name }}|{{  $value->thumbnail_name }}|{{ $value->type }}|{{  $value->size }}|{{ $value->thumbnail_size }}">
                                            <button type="button" class="btn btn-danger pull-right dz-remove"
                                                    data-id="{{ $value->id }}">@lang('users.label.delete')
                                            </button>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div> <!-- /form -->
                </div>
            </div>
            <div class="form-group">
                <div class="d-flex justify-content-center">
                    <input type="submit" class="btn btn-primary mr-1 btn-action"
                           id="change-public-media" value="@lang('users.label.update')"/>
                    <a href="{{ route('member.index', $user->type_name) }}"
                       class="btn btn-danger btn-action">@lang('labels.general.cancel')</a>
                </div>
            </div> <!--row-->
        </div>
    </form>
</div>
