@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-body">
            @include('includes.alerts.messages')
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        @lang('labels.menu.banner')
                    </h4>
                </div><!--col-->
                <div class="col-sm-7">
                    <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                        <a href="{{ route('banners.create') }}" class="btn btn-primary mr-1 btn-action"
                           data-original-title="Create New">@lang('banners.label.create')</a>
                    </div>
                </div><!--col-->
            </div><!--row-->
            <div class="row mt-4">
                <div class="col">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th width="5%">@lang('labels.general.id')</th>
                                <th width="25%">@lang('banners.label.image')</th>
                                <th width="20%">@lang('banners.label.redirect_url')</th>
                                <th width="10%">@lang('banners.label.order')</th>
                                <th width="10%">@lang('labels.general.created_at')</th>
                                <th width="10%">@lang('labels.general.updated_at')</th>
                                <th width="10%">@lang('banners.label.active')</th>
                                <th width="10%">@lang('labels.general.action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($banners))
                                <!-- Table Body -->
                            <tbody>
                            @foreach($banners as $banner)
                                <tr @if($banner->active == 0) class="inactive" @endif>
                                    <td class="table-text">
                                        <div>{{$banner->id}}</div>
                                    </td>
                                    <td class="table-text">
                                        <div>
                                            <img src="{{$banner->media->media_url}}" height="auto" width="200px">
                                        </div>
                                    </td>
                                    <td class="table-text">
                                        <div>{{$banner->redirect_url}}</div>
                                    </td>
                                    <td class="table-text">
                                        <div>{{$banner->order}}</div>
                                    </td>
                                    <td class="table-text">
                                        <div>{{$banner->created_at}}</div>
                                    </td>
                                    <td class="table-text">
                                        <div>{{$banner->updated_at}}</div>
                                    </td>
                                    <td class="table-text">
                                        @if($banner->active == 1)
                                            <span class="badge badge-info">@lang('banners.label.active')</span>
                                        @else
                                            <label class="badge badge-secondary">@lang('banners.label.inactive')</label>
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{ route('banners.destroy', $banner->id) }}"
                                              method="POST">
                                            <a href="{{ route('banners.edit', $banner->id) }}"
                                               class="btn btn-success"><i class="fas fa-pencil-alt"></i></a>
                                            <a href="{{ route('banners.destroy', $banner->id) }}"
                                               class="btn btn-danger"
                                               data-method="delete"
                                               data-trans-button-cancel="@lang('labels.general.cancel')"
                                               data-trans-button-confirm="@lang('labels.general.delete')"
                                               data-trans-title="@lang('alerts.general.confirm.delete')">
                                                <i class="far fa-trash-alt"></i>
                                            </a>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div><!--col-->
            </div><!--row-->
            <div class="row">
                <div class="col-7">
                    <div class="float-left">
                        {{ __('labels.general.total_number', ['total_number' => $banners->total()]) }}
                    </div>
                </div><!--col-->
                <div class="col-5">
                    <div class="float-right">
                        {{$banners->links()}}
                    </div>
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->
    </div>
@endsection


