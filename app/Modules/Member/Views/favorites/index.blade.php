@extends('layouts.member')

@section('title', app_name() . ' | ' . __('title.member.detail'))

@section('content')
    <div class="main-container__list-item mt-4" id="list-member">
        @if(Auth::user()->female)
            @include('includes.male.member_list')
        @else
            @include('includes.female.member_list')
        @endif
    </div>
    <div class="main-container__pagination">
        <nav aria-label="navigation">
            <ul class="pagination">
                @include('pagination.link', ['paginator' => $members])
            </ul>
        </nav>
    </div>
@endsection
