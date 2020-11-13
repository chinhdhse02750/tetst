@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-body">
            @include('includes.alerts.messages')
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        @lang('units.label.list')
                    </h4>
                </div><!--col-->
                <div class="col-sm-7 @cannot('create category') d-none @endcannot">
                    <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                        <a href="{{ route('units.create') }}" class="btn btn-primary mr-1 btn-action"
                           data-original-title="Create New">@lang('units.label.create')</a>
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
                                <th width="20%">@lang('units.label.name')</th>
                                <th width="35%">@lang('units.label.description')</th>
                                <th width="15%">@lang('labels.general.created_at')</th>
                                <th width="15%">@lang('labels.general.updated_at')</th>
                                <th width="10%">@lang('labels.general.action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($units))
                                <!-- Table Body -->
                            <tbody>
                            @foreach($units as $unit)
                                <tr>
                                    <td class="table-text">
                                        <div>{{$unit->id}}</div>
                                    </td>
                                    <td class="table-text">
                                        <div>{{$unit->name}}</div>
                                    </td>
                                    <td class="table-text">
                                        <div>{{$unit->description}}</div>
                                    </td>
                                    <td class="table-text">
                                        <div>{{$unit->created_at}}</div>
                                    </td>
                                    <td class="table-text">
                                        <div>{{$unit->updated_at}}</div>
                                    </td>
                                    <td>
                                        <form action="{{ route('units.destroy', $unit->id) }}"
                                              method="POST">
                                            <a href="{{ route('units.show', $unit->id) }}"
                                               class="btn btn-default"><i class="fas fa-eye"></i></a>
                                            <a href="{{ route('units.edit', $unit->id) }}"
                                               class="btn btn-success"><i class="fas fa-pencil-alt"></i></a>
                                            <a href="{{ route('units.destroy', $unit->id) }}"
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
                        {{ __('labels.general.total_number', ['total_number' => $units->total()]) }}
                    </div>
                </div><!--col-->
                <div class="col-5">
                    <div class="float-right">
                        {{$units->links()}}
                    </div>
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->
    </div>
@endsection


