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
            </div><!--row-->
            <form method="post" id="pref-form"  action="{{ route('shipping.store') }}" >
                <input type="hidden" name="_token" id="csrf-token" value="{{ csrf_token() }}" />
                <div class="row mt-4">
                    <div class="col">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th width="5%">ID</th>
                                    <th width="10%">Tên tỉnh thành</th>
                                    <th width="10%">Phí ship</th>
                                </thead>
                                <tbody>
                                @if(!empty($prefs))
                                    <!-- Table Body -->
                                <tbody>
                                    @foreach($prefs as $pref)
                                        <tr>
                                            <td class="table-text">
                                                <div>{{ $pref->id }}</div>
                                            </td>
                                            <td class="table-text">
                                                <div>{{ $pref->name }}</div>
                                            </td>
                                            @if($pref->shipping)
                                            <td class="table-text">
                                                <input type="hidden" name="{{ $pref->id }}[pref_id]" value="{{ $pref->id }}">
                                                <input type="text" name="{{ $pref->id }}[price]" value="{{$pref->shipping->price}}"/>
                                            </td>
                                            @else
                                                <td class="table-text">
                                                    <input type="hidden" name="{{ $pref->id }}[pref_id]" value="{{ $pref->id }}">
                                                    <input type="text" name="{{ $pref->id }}[price]" value="0"/>
                                                </td>
                                            @endif
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
                    <div class="col-sm-6 @cannot('create category') d-none @endcannot">
                        <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                            <button id = "submit-form-pref"
                                    class="btn btn-success mr-1 btn-action" type="submit"> Đăng ký
                            </button>
                        </div><!--btn-toolbar-->
                    </div><!--col-->
                </div><!--row-->
            </form>
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





