@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-body">
            @include('includes.alerts.messages')
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        @lang('ranks.label.list')
                    </h4>
                </div><!--col-->
                <div class="col-sm-7">
                    <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                        <a href="{{ route('ranks.create') }}" class="btn btn-primary mr-1 btn-action"
                           data-original-title="Create New">@lang('ranks.label.create')</a>
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
                                <th>@lang('ranks.label.name_jp')</th>
                                <th>@lang('ranks.label.name_en')</th>
                                <th>@lang('ranks.label.point')</th>
                                <th>@lang('ranks.label.priority')</th>
                                <th>@lang('ranks.label.color_code')</th>
                                <th>@lang('labels.general.created_at')</th>
                                <th>@lang('labels.general.updated_at')</th>
                                <th width="5%">@lang('labels.general.action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($ranks))
                                @foreach($ranks as $rank)
                                <tr>
                                    <td class="table-text">
                                        <span>{{ !empty($rank->id) ? $rank->id : '' }}</span>
                                    </td>
                                    <td class="table-text">
                                        <span>{{ !empty($rank->name_jp) ? $rank->name_jp : '' }}</span>
                                    </td>
                                    <td class="table-text">
                                        <span>{{ !empty($rank->name_en) ? $rank->name_en : '' }}</span>
                                    </td>
                                    <td class="table-text">
                                        <span>{{ !empty($rank->amount_label) ? $rank->amount_label : '' }}</span>
                                    </td>
                                    <td class="table-text">
                                        <span>{{ !empty($rank->priority) ? $rank->priority : '' }}</span>
                                    </td>
                                    <td class="table-text">
                                        {!! $rank->rank_button !!}
                                    </td>
                                    <td class="table-text">
                                        <span>{{ !empty($rank->created_at) ? $rank->created_at : '' }}</span>
                                    </td>
                                    <td class="table-text">
                                        <span>{{ !empty($rank->updated_at) ? $rank->updated_at : '' }}</span>
                                    </td>
                                    <td>
                                        <form action="{{ route('ranks.destroy', $rank->id) }}" method="POST">
                                            @if ($rank->deleted_at === null)
                                                <a href="{{ route('ranks.edit', $rank->id) }}"
                                                   class="btn btn-success"><i class="fas fa-pencil-alt"></i></a>
                                                <a href="{{ route('ranks.destroy', $rank->id) }}"
                                                   class="btn btn-danger"
                                                   data-method="delete"
                                                   data-trans-button-cancel="@lang('labels.general.cancel')"
                                                   data-trans-button-confirm="@lang('labels.general.delete')"
                                                   data-trans-title="@lang('alerts.general.confirm.delete')">
                                                    <i class="far fa-trash-alt"></i>
                                                </a>
                                            @else
                                                <a href="{{ route('ranks.restore', $rank->id) }}"
                                                   class="btn btn-primary"
                                                   data-method="post"
                                                   data-trans-button-cancel="@lang('labels.general.cancel')"
                                                   data-trans-button-confirm="@lang('labels.general.yes')"
                                                   data-trans-title="@lang('alerts.general.confirm.restore')">
                                                    <i class="fas fa-undo"></i>
                                                </a>
                                            @endif
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div><!--col-->
            </div><!--row-->
            <div class="row">
                <div class="col-7">
                    <div class="float-left">
                        {{ __('labels.general.total_number', ['total_number' => $ranks->total()]) }}
                    </div>
                </div><!--col-->
                <div class="col-5">
                    <div class="float-right">
                        {{$ranks->links()}}
                    </div>
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->
    </div>
@endsection


