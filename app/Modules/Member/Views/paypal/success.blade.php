@extends('layouts.member')

@section('title', app_name() . ' | ' . __('title.member.detail'))

@section('sidebar')
@include('includes.sidebar')
@endsection

@section('content')
<div class="container-balance-detail container">
    <div class="balance-title">
        <div class="detail__balance--title">
            @lang('offers.label.purchase_success')
        </div>
        <div class="detail__balance--description sent-contact">
            @lang('offers.label.purchase_success_des')
        </div>

        <div class="form-group button-tbl-2 mt-4 mb-5 button-tbl-sent-contact">
            <div class="d-flex justify-content-center">
                <a href="/" class="btn btn-outline-secondary btn-sent-contact">
                    @lang('contacts.label.return_to_top')
                </a>
            </div>
        </div>
    </div>

</div>
@endsection
