@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-body">
            @include('includes.alerts.messages')
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        @lang('product.label.list')
                    </h4>
                </div><!--col-->
                <div class="col-sm-7 @cannot('create category') d-none @endcannot">
                    <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                        <a href="{{ route('blogs.create') }}" class="btn btn-primary mr-1 btn-action"
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
                                <th width="15%">@lang('blogs.label.title')</th>
                                <th width="15%">Image</th>
                                <th width="15%">@lang('blogs.label.created')</th>
                                <th width="15%">@lang('blogs.label.updated')</th>
                                <th width="10%">@lang('labels.general.action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($blogs))
                                <!-- Table Body -->
                            <tbody>
                            @foreach($blogs as $blog)
                                <tr>
                                    <td class="table-text">
                                        <div>{{$blog->id}}</div>
                                    </td>
                                    <td class="table-text">
                                        <div>{{$blog->blog_title}}</div>
                                    </td>
                                    <td class="table-text">
                                        <div>
                                            <img src="{{$blog->blog_img_preivew}}" height="auto" width="200px">
                                        </div>
                                    </td>
                                    <td class="table-text">
                                        <div>{{date('Y-m-d H:i', strtotime($blog->created_at))}}</div>
                                    </td>
                                    <td class="table-text">
                                        <div>{{date('Y-m-d H:i', strtotime($blog->updated_at))}}</div>
                                    </td>
                                    <td>
                                        <form action="{{ route('blogs.destroy', $blog->id) }}"
                                              method="POST">
                                            <a href="{{ route('blogs.edit', $blog->id) }}"
                                               class="btn btn-success"><i class="fas fa-pencil-alt"></i></a>
                                            <a href="{{ route('blogs.destroy', $blog->id) }}"
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
                        {{ __('labels.general.total_number', ['total_number' => $blogs->total()]) }}
                    </div>
                </div><!--col-->
                <div class="col-5">
                    <div class="float-right">
                        {{$blogs->links()}}
                    </div>
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->
    </div>
@endsection


