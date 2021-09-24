@extends('layouts.admin')
@section('content')
    @include('includes.alerts.messages')
    <div class="card pd-lr-20">
        <div class="card-body">
            <form id="search-form" class="search-reset-form" onsubmit="return false">
                @include('product.form_search')
                <div class="form-group">
                    <div class="d-flex justify-content-center">
                        <input type="submit" class="btn btn-primary mr-1 btn-action button-search-user"
                               id="search-user" value="Tìm kiếm sản phẩm"/>
                        <input type="hidden" value="{{ url('admin/search-product') }}" id="url-search">
                    </div>
                </div> <!--row-->
            </form>
        </div><!--card-body-->
    </div>
    <div class="card search-append" id="search-female-append">
        @include('product.result_search')
    </div>
@endsection
@section('pagespecificscripts')
    {!! script(('assets/admin/js/user.js')) !!}
    {!! script(('assets/admin/js/fixScrollHeader.js')) !!}
    {!! script(('assets/admin/js/datetimePicker.js')) !!}
@stop


