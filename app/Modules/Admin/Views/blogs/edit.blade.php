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
                            <h3>@lang('blogs.label.blog_edit')</h3>
                            <div class="panel-body pt-2">
                                <form action="{{ route('blogs.update', $blog->id) }}" method="POST"
                                      enctype="multipart/form-data"
                                      class="form-horizontal">
                                    {{ csrf_field() }}
                                    @method('PUT')
                                    <div class="row form-group">
                                        <label class="control-label col-sm-2">
                                            @lang('blogs.label.title')
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-sm-10">
                                            <input type="text" name="title" id="title" class="form-control"
                                                   value="{{ $blog->blog_title }}"
                                                   maxlength="255" required>
                                        </div>
                                    </div>


                                    <div class="row form-group">
                                        <label class="control-label col-sm-2">
                                            Hình Ảnh
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-sm-10">
                                            <div>
                                                <input accept="image/*" type='file' name="image" onchange="loadFile(event)"/>
                                            </div>
                                            <div class="img_preview">
                                                <img id="edit_preview_img" src="{{ $blog->blog_img_preivew }}"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-2 form-control-label"
                                               for="content">@lang('blogs.label.content')</label>

                                        <div class="col-md-10">
                                    <textarea class="form-control"
                                              type="text"
                                              name="content"
                                              id="content"
                                              maxlength="5000"
                                              placeholder=""
                                              rows='3'>{{ $blog->blog_content }}</textarea>
                                        </div><!--col-->
                                    </div><!--form-group-->

                                    <div class="form-group">
                                        <div class="d-flex justify-content-center">
                                            <input type="submit" class="btn btn-success mr-1 btn-action"
                                                   value="@lang('categories.label.register')"/>
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
    </div>
@endsection

@section('pagespecificscripts')
    <!-- flot charts scripts-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
    <script src="//cdn.ckeditor.com/4.14.0/full/ckeditor.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.min.js"></script>
    {!! script(('assets/admin/js/dropzone.js')) !!}
    {!! script(('assets/admin/js/editor.js')) !!}

    <script>
        $(document).ready(function () {
            $('#private-previews').sortable();
            $('.dz-remove').on("click", function () {
                let id = $(this).data("id");
                $('#' + id + '').remove();
                if($(this).hasClass('profile-image')){
                    Dropzone.forElement('#image-product-dropzone').removeAllFiles(true);
                    Dropzone.forElement('#image-product-dropzone').options.maxFiles = 1;
                }
            });

            let url = '{{ url('api/media') }}';
            let token = '{{ csrf_token() }}';
            let buttonDelete = '@lang('labels.general.delete')';
            createDropzone(url, token, buttonDelete, 5);

            $('.select-category').select2();

            $('.select-category').on('select2:select', function (e) {
                let data = e.params.data;
                if ($('#category_id').val() === "") {
                    $('#category_id').val(data.id);
                } else {
                    $('#category_id').val($('#category_id').val() + ',' + data.id);
                }
            });
            $('.select-category').on('select2:unselect', function (e) {
                let listID = $('#category_id').val();
                let data = e.params.data;
                if (listID.indexOf(data.id) != -1) {
                    $('#category_id').val($('#category_id').val().replace(data.id, '').replace(/^,|,$/g, '').replace(/,,/g, ','));
                }
            });


            $('.select-tag').select2();

            $('.select-tag').on('select2:select', function (e) {
                let data = e.params.data;
                if ($('#tag_id').val() === "") {
                    $('#tag_id').val(data.id);
                } else {
                    $('#tag_id').val($('#tag_id').val() + ',' + data.id);
                }
            });
            $('.select-tag').on('select2:unselect', function (e) {
                let listID = $('#tag_id').val();
                let data = e.params.data;
                if (listID.indexOf(data.id) != -1) {
                    $('#tag_id').val($('#tag_id').val().replace(data.id, '').replace(/^,|,$/g, '').replace(/,,/g, ','));
                }
            });
        });

    </script>

    <script>
        var loadFile = function(event) {
            var output = document.getElementById('edit_preview_img');
            output.classList.remove("hidden");
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
    </script>
@stop
