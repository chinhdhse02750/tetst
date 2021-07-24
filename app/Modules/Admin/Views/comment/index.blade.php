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
                                <th width="5%">ID</th>
                                <th width="10%">Sản phẩm</th>
                                <th width="10%">Tên bình luận</th>
                                <th width="10%">Email</th>
                                <th width="30%">Nội dung</th>
                                <th width="5%">Số sao</th>
                                <th width="15%">Trạng thái</th>
                                <th width="10%">Ngày bình luận</th>
                                <th width="10%">@lang('labels.general.action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($comments))
                                <!-- Table Body -->
                            <tbody>
                            @foreach($comments as $comment)
                                <tr>
                                    <td class="table-text">
                                        <div>{{$comment->id}}</div>
                                    </td>
                                    <td class="table-text">
                                        <div>{{$comment->product->name}}</div>
                                    </td>
                                    <td class="table-text">
                                        <div>{{$comment->name}}</div>
                                    </td>
                                    <td class="table-text">
                                        <div>{{$comment->email}}</div>
                                    </td>
                                    <td class="table-text">
                                        <div>{{$comment->description}}</div>
                                    </td>
                                    <td class="table-text">
                                        <div>{{$comment->rating}}</div>
                                    </td>
                                    <td class="table-text">
                                        <div>
                                            <label class="switch">
                                                <input data-id="{{$comment->id}}"
                                                       class="enable_status" type="checkbox"
                                                       @if($comment->status === 1) checked  value="1" @else value="0" @endif >
                                                <span class="slider round"></span>
                                            </label>

                                            {{--<span class="{{ $comment->status === 1 ? "badge badge-success" : "badge badge-danger" }}">--}}
                                                {{--{{$comment->status === 1 ? "Hiển thị" : "Không hiển thị"}}</span>--}}
                                        </div>
                                    </td>
                                    <td class="table-text">
                                        <div>{{$comment->created_at}}</div>
                                    </td>
                                    <td>
                                        <a href="{{ route('comments.destroy', $comment->id) }}"
                                           class="btn btn-danger"
                                           data-method="delete"
                                           data-trans-button-cancel="@lang('labels.general.cancel')"
                                           data-trans-button-confirm="@lang('labels.general.delete')"
                                           data-trans-title="@lang('alerts.general.confirm.delete')">
                                            <i class="far fa-trash-alt"></i>
                                        </a>
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
                        {{ __('labels.general.total_number', ['total_number' => $comments->total()]) }}
                    </div>
                </div><!--col-->
                <div class="col-5">
                    <div class="float-right">
                        {{$comments->links()}}
                    </div>
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->
    </div>
@endsection


@section('pagespecificscripts')
    <!-- flot charts scripts-->
    <script>
        $(document).ready(function () {
            $(".enable_status").change(function(){
                let id = $(this).data('id');
                let isChecked = 0;
                if($(this).is(":checked")){
                    isChecked = 1;
                }
                let url = '{{ url('/admin/comments/update-status') }}';
                let data = {
                    id: id, status: isChecked,
                };

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: url,
                    data: data,        //POST variable name value
                    success: function(msg){
                        if(msg.status == 'success'){
                            if(msg.key_status == 1){
                                alert('Comment đã được hiển thị');
                            }else{
                                alert('Comment đã được ẩn đi');
                            }

                        }
                        else{
                            alert('Cập nhật không thành công!');
                        }
                    }
                });
            });
        });
    </script>
@stop





