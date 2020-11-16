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
                            <h3>@lang('product.label.register_title')</h3>
                            <div class="panel-body pt-2">
                                <form action="{{ route('products.store') }}" method="POST"
                                      class="form-horizontal">
                                    {{ csrf_field() }}
                                    <div class="row form-group">
                                        <label class="control-label col-sm-2">
                                            @lang('product.label.name')
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-sm-10">
                                            <input type="text" name="name" id="name" class="form-control"
                                                   maxlength="255" required>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <label
                                                class="control-label col-sm-2">@lang('categories.label.description')</label>
                                        <div class="col-sm-10">
                                            <textarea name="description" id="description"
                                                      class="form-control" maxlength="255"></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-2 form-control-label"
                                               for="content">@lang('product.label.content')</label>

                                        <div class="col-md-10">
                                    <textarea class="form-control"
                                              type="text"
                                              name="content"
                                              id="content"
                                              maxlength="5000"
                                              placeholder=""
                                              rows='3'>{{ old('content') }}</textarea>
                                        </div><!--col-->
                                    </div><!--form-group-->

                                    <div class="row form-group">
                                        <label class="col-md-2 form-control-label"
                                               for="dating_type">@lang('categories.label.select_category')
                                            <span class="required">*</span></label>
                                        <div class="col-md-10">
                                            @php
                                                $char = "|---";
                                            @endphp

                                            <select class="custom-select" name="parent" id="parent">
                                                <option value="0">--Root--</option>
                                                @foreach($categories as $menu)

                                                    <option value="{{ $menu->id }}">{{ $char }}{{ $menu->name }}</option>

                                                    @include('category.childItems', ['char' => $char."|---"] )
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <label
                                                class="form-control-label col-sm-2">@lang('product.label.alias')
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-sm-10">
                                            <input type="text" name="alias" id="alias" class="form-control"
                                                   maxlength="255" required>
                                        </div>
                                    </div>

                                    <div class="form-group row flex-group">
                                        <div class="col-md-2 control-label">
                                            <span>@lang('categories.label.image')</span>
                                        </div>
                                        <div class="col-md-10">
                                            <small class="upload-note"><i
                                                        class="cil-warning"></i> @lang('alerts.upload.accept_extension_image')
                                            </small>
                                            <div class="row mt-4 mb-4" role="form">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <div class="needsclick dropzone" id="image-dropzone"></div>
                                                    </div>
                                                    <div id="private-previews" class="previews-image"></div>
                                                </div>
                                            </div> <!-- /form -->
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-2 form-control-label"
                                               for="status">@lang('categories.label.status')
                                        </label>

                                        <div class="col-md-2">
                                            <input type='hidden' value='0' name='status'>
                                            <input type="checkbox" class="radio" name="status" value="1" id="status"/>
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
    {!! script(('assets/admin/js/dropzone.js')) !!}
    {!! script(('assets/admin/js/editor.js')) !!}

    <script>
        let url = '{{ url('api/media') }}';
        let token = '{{ csrf_token() }}';
        let buttonDelete = '@lang('labels.general.delete')';
        createDropzone(url, token, buttonDelete, 5);
    </script>
@stop
