@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-body">
            @include('includes.alerts.messages')
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        @lang('categories.label.list')
                    </h4>
                </div><!--col-->
                <div class="col-sm-7 @cannot('create category') d-none @endcannot">
                    <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                        <a href="{{ route('tags.create') }}" class="btn btn-primary mr-1 btn-action"
                           data-original-title="Create New">@lang('categories.label.create')</a>
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
                                <th width="15%">@lang('categories.label.name')</th>
                                <th width="30%">@lang('categories.label.description')</th>
                                <th width="15%">@lang('labels.general.created_at')</th>
                                <th width="10%">@lang('labels.general.action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($tags))
                                <!-- Table Body -->
                            <tbody>
                            @foreach($tags as $tag)
                                <tr>
                                    <td class="table-text">

                                        <div>{{$tag->id}}</div>
                                    </td>
                                    <td class="table-text">
                                        <div>{{$tag->name}}</div>
                                    </td>
                                    <td class="table-text">
                                        <div>{{$tag->description}}</div>
                                    </td>
                                    <td class="table-text">
                                        <div>{{$tag->created_at}}</div>
                                    </td>
                                    <td>
                                        <form action="{{ route('categories.destroy', $tag->id) }}"
                                              method="POST">
                                            {{--<a href="{{ route('categories.show', $tag->id) }}"--}}
                                               {{--class="btn btn-default"><i class="fas fa-eye"></i></a>--}}
                                            <a href="{{ route('tags.edit', $tag->id) }}"
                                               class="btn btn-success"><i class="fas fa-pencil-alt"></i></a>
                                            <a href="{{ route('tags.destroy', $tag->id) }}"
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
                        {{ __('labels.general.total_number', ['total_number' => $tags->total()]) }}
                    </div>
                </div><!--col-->
                <div class="col-5">
                    <div class="float-right">
                        {{$tags->links()}}
                    </div>
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->
    </div>
@endsection


