@extends('layouts.admin')
@section('pagespecificstyles')
    <!-- flot charts css-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet"/>
@stop
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    @include('includes.alerts.messages')
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3>@lang('categories.label.edit')</h3>
                        </div>
                        <div class="panel-body">
                            <form action="{{ route('tags.update', $tags->id) }}" method="POST"
                                  class="form-horizontal">
                                {{ csrf_field() }}
                                @method('PUT')
                                <div class="row form-group">
                                    <label class="control-label col-sm-2">
                                        @lang('categories.label.name')
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text" name="name" id="name" class="form-control"
                                               value="{{ $tags->name }}"
                                               maxlength="255" required>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label
                                            class="control-label col-sm-2">@lang('categories.label.description')</label>
                                    <div class="col-sm-10">
                                        <textarea name="description" id="description" class="form-control"
                                                  maxlength="255">{{ $tags->description }}</textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="d-flex justify-content-center">
                                        <input type="submit" class="btn btn-primary mr-1 btn-action"
                                               value="@lang('labels.general.update')"/>
                                        <a href="{{ route('categories.index') }}"
                                           class="btn btn-danger btn-action">@lang('labels.general.cancel')</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('pagespecificscripts')
    <!-- flot charts scripts-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
    <script src="//cdn.ckeditor.com/4.14.0/full/ckeditor.js"></script>
    {!! script(('assets/admin/js/dropzone.js')) !!}
    {!! script(('assets/admin/js/editor.js')) !!}

    <script>
        $(document).ready(function () {
            let url = '{{ url('api/media') }}';
            let token = '{{ csrf_token() }}';
            let buttonDelete = '@lang('labels.general.delete')';

            $('.dz-remove').on("click", function () {
                let id = $(this).data("id");
                $('#' + id + '').remove();
                if ($(this).hasClass('image')) {
                    Dropzone.forElement('#image-dropzone').removeAllFiles(true);
                    Dropzone.forElement('#image-dropzone').options.maxFiles = 1;
                }
            });

            let maxInput = '{{ empty($categories->image) ? 1 : 0 }}';
            createDropzone(url, token, buttonDelete, maxInput);
        });
    </script>
@stop


