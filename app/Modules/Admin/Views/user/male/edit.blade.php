@extends('layouts.admin')
@section('pagespecificstyles')
    <!-- flot charts css-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet"/>
@stop
@section('content')
    @include('user.includes.active_button')
    <ul class="nav nav-pills" id="pills-tab" role="tablist">
        <li class="nav-item">
            <a class="nav-link btn btn-outline active" id="pills-login-tab" data-toggle="pill"
               href="#pills-login" role="tab" aria-controls="pills-login"
               aria-selected="false">@lang('users.label.login_information')</a>
        </li>
        <li class="nav-item">
            <a class="nav-link btn btn-outline" id="pills-register-tab" data-toggle="pill"
               href="#pills-register" role="tab" aria-controls="pills-register"
               aria-selected="false">@lang('users.label.registration_information')</a>
        </li>
        <li class="nav-item">
            <a class="nav-link  btn btn-outline" id="pills-male-profile-tab" data-toggle="pill"
               href="#pills-male-profile" role="tab" aria-controls="pills-male-profile"
               aria-selected="true">@lang('users.label.profile_information')</a>
        </li>
        <li class="nav-item">
            <a class="nav-link btn btn-outline" id="pills-profile-image-tab" data-toggle="pill"
               href="#pills-profile-image" role="tab" aria-controls="pills-profile-image"
               aria-selected="false">@lang('users.label.profile_image')</a>
        </li>
        <li class="nav-item">
            <a class="nav-link btn btn-outline" id="pills-public-image-tab" data-toggle="pill"
               href="#pills-public-image" role="tab" aria-controls="pills-public-image"
               aria-selected="false">@lang('users.label.public_photos')</a>
        </li>
    </ul>
    <div id="pills-tabContent" class="tab-content">
        @include('user.includes.edit_login')
        @include('user.includes.edit_register')
        @include('user.includes.male.edit_profile')
        @include('user.includes.edit_profile_image')
        @include('user.includes.edit_public_image')
    </div>
@endsection

@section('pagespecificscripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
    <script src="//cdn.ckeditor.com/4.14.0/full/ckeditor.js"></script>
    {!! script(('assets/admin/js/editUser.js')) !!}
    {!! script(('assets/admin/js/dropzone.js')) !!}
    {!! script(('assets/admin/js/fixScrollHeader.js')) !!}
    {!! script(('assets/admin/js/editor.js')) !!}
    {!! script(('assets/admin/js/userProfile.js')) !!}
    {!! script(('assets/admin/js/datetimePicker.js')) !!}
    <script>
        $(document).ready(function () {
            $('#public-previews').sortable();
            $('#private-previews').sortable();
            $('.dz-remove').on("click", function () {
                let id = $(this).data("id");
                $('#' + id).remove();
                if($(this).hasClass('profile-image')){
                    Dropzone.forElement('#image-profile-dropzone').removeAllFiles(true);
                    Dropzone.forElement('#image-profile-dropzone').options.maxFiles = 1;
                }
            });
            $("#area").on('change', function () {
                let areaId = $(this).val();
                let url = "{{ url("api/v1/areas/:area_id/prefectures")  }}".replace(':area_id', areaId);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'GET',
                    url: url,
                    data: {areaId: areaId},
                    success: function (data) {
                        let select = $('#prefecture');
                        select.find('option').remove();
                        $.each(data.prefectures, function (key, value) {
                            let dataImages = `<option value="${value.id}"> ${value.name}</option>`;
                            select.append(dataImages);
                        });

                    },
                    error: function (exception) {
                        alert('Exeption:' + exception);
                    }
                });
            });
        });

        let url  = '{{ url('api/media') }}';
        let token  = '{{ csrf_token() }}';
        let buttonDelete = '@lang('labels.general.delete')';
        let maxInput = '{{ empty($dataProfile) }}';
        createDropzone(url, token, buttonDelete, maxInput);
    </script>
@stop
