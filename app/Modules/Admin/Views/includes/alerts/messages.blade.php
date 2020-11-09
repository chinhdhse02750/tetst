@if(Session::has('success_msg'))
    <div class="alert alert-success">
        <button class="close" data-dismiss="alert">x</button>
        {{ Session::get('success_msg') }}
    </div>
@endif
@if(Session::has('error_msg'))
    <div class="alert alert-danger">
        <button class="close" data-dismiss="alert">x</button>
        {{ Session::get('error_msg') }}
    </div>
@endif
@if($errors->any())
    <div class="alert alert-danger">
        <button class="close" data-dismiss="alert">x</button>
        @foreach($errors->all() as $error)
            <p>{{$error}}</p>
        @endforeach()
    </div>
@endif
