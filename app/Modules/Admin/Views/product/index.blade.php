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
                        <a href="{{ route('products.create') }}" class="btn btn-primary mr-1 btn-action"
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
                                <th width="15%">@lang('product.label.image')</th>
                                <th width="15%">@lang('product.label.name')</th>
                                <th width="15%">@lang('product.label.parent')</th>
                                <th width="10%">@lang('product.label.cost')</th>
                                <th width="10%">@lang('product.label.price')</th>
                                <th width="10%">@lang('product.label.discount_price')</th>
                                <th width="10%">@lang('product.label.unit')</th>
                                <th width="10%">@lang('product.label.status')</th>
                                <th width="10%">@lang('labels.general.action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($products))
                                <!-- Table Body -->
                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td class="table-text">

                                        <div>{{$product->id}}</div>
                                    </td>
                                    <td class="table-text">
                                        <div class="image-frames"><img class="dz-image-display"
                                                  alt="{{ $product->image }}"
                                                  src="{{ url('storage/tmp/'.$product->image) }}">
                                        </div>
                                    </td>
                                    <td class="table-text">
                                        <div>{{$product->name}}</div>
                                    </td>
                                    <td class="table-text">
                                        @foreach($product->category as $key => $value)
                                            {!! $value->name. "</br>" !!}
                                        @endforeach
                                    </td>
                                    <td class="table-text">
                                        <div>{{$product->cost}}</div>
                                    </td>
                                    <td class="table-text">
                                        <div>{{$product->price}}</div>
                                    </td>
                                    <td class="table-text">
                                        <div>{{ $product->discount_price }}</div>
                                    </td>
                                    <td class="table-text">
                                        <div>{{$product->units->name}}</div>
                                    </td>

                                    <td class="table-text">
                                        <div>
                                            <span class="{{ $product->status === 1 ? "badge badge-success" : "badge badge-danger" }}">
                                                {{$product->status === 1 ? "ON" : "OFF"}}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <form action="{{ route('products.destroy', $product->id) }}"
                                              method="POST">
                                            <a href="{{ route('products.show', $product->id) }}"
                                               class="btn btn-default"><i class="fas fa-eye"></i></a>
                                            <a href="{{ route('products.edit', $product->id) }}"
                                               class="btn btn-success"><i class="fas fa-pencil-alt"></i></a>
                                            <a href="{{ route('products.destroy', $product->id) }}"
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
                        {{ __('labels.general.total_number', ['total_number' => $products->total()]) }}
                    </div>
                </div><!--col-->
                <div class="col-5">
                    <div class="float-right">
                        {{$products->links()}}
                    </div>
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->
    </div>
@endsection


