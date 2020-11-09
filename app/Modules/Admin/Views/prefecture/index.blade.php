@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-body">
            @include('includes.alerts.messages')
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        @lang('labels.menu.prefectures')
                    </h4>
                </div><!--col-->
                <div class="col-sm-7">
                    <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                        <a href="{{ route('prefectures.create') }}" class="btn btn-primary mr-1 btn-action"
                           data-original-title="Create New">@lang('prefectures.label.create')</a>
                    </div><!--btn-toolbar-->
                </div><!--col-->
            </div><!--row-->
            <div class="row mt-4">
                <div class="col">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th width="5%">@lang('labels.general.id')</th>
                                <th width="25%">@lang('labels.general.name')</th>
                                <th width="25%">@lang('labels.general.area')</th>
                                <th width="15%">@lang('labels.general.created_at')</th>
                                <th width="15%">@lang('labels.general.updated_at')</th>
                                <th width="15%">@lang('labels.general.action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($prefectures))
                                <!-- Table Body -->
                            <tbody>
                            @foreach($prefectures as $prefecture)
                                <tr>
                                    <td class="table-text">
                                        <div>{{$prefecture->id}}</div>
                                    </td>
                                    <td class="table-text">
                                        <div>{{$prefecture->name}}</div>
                                    </td>
                                    <td class="table-text">
                                        <div>{{$prefecture->area->name}}</div>
                                    </td>
                                    <td class="table-text">
                                        <div>{{$prefecture->created_at}}</div>
                                    </td>
                                    <td class="table-text">
                                        <div>{{$prefecture->updated_at}}</div>
                                    </td>
                                    <td>
                                        <form action="{{ route('prefectures.destroy', $prefecture->id) }}"
                                              method="POST">
                                            <a href="{{ route('prefectures.show', $prefecture->id) }}"
                                               class="btn btn-default"><i class="fas fa-eye"></i></a>
                                            <a href="{{ route('prefectures.edit', $prefecture->id) }}"
                                               class="btn btn-success"><i class="fas fa-pencil-alt"></i></a>
                                            <a href="{{ route('prefectures.destroy', $prefecture->id) }}"
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
                        {{ __('labels.general.total_number', ['total_number' => $prefectures->count()]) }}
                    </div>
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->
    </div>
@endsection


