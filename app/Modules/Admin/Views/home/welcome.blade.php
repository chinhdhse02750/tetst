@extends('layouts.admin')
@section('content')
    <div id="pills-tabContent" class="tab-content reset-tab-content">
        <div class="tab-pane fade show active" id="pills-female" role="tabpanel" aria-labelledby="pills-female-tab">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-5">
                            <h4 class="card-title mb-0">
                                @lang('users.label.count_member')
                            </h4>
                        </div><!--col-->
                    </div><!--row-->

                    <div class="row mt-4 mb-4 pd-lr-20">
                        <div class="col-sm-12">
                           <span class="text--small">
                               <span
                                   class="mr-5">@lang('top_header.label.total_users'): {{ $allUser->count() }} @lang('users.label.person')</span>
                               <span
                                   class="mr-5">@lang('users.label.female'): {{ $totalFemale }} @lang('users.label.person')</span>
                               <span
                                   class="mr-5">@lang('users.label.male'): {{ $totalMale }} @lang('users.label.person')</span>
                           </span>
                        </div><!--col-->
                    </div><!--row-->
                </div><!--card-body-->
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-5">
                            <h4 class="card-title mb-0">
                                @lang('users.label.user_list')
                            </h4>
                        </div><!--col-->
                    </div><!--row-->
                    <div class="row mt-4">
                        <div class="col">
                            <div class="table-responsive">
                                <table class="table adm__user-list">
                                    <thead>
                                    <tr>
                                        <th>@lang('labels.general.id')</th>
                                        <th>@lang('users.label.name')</th>
                                        <th>@lang('users.label.email')</th>
                                        <th>@lang('users.label.sex')</th>
                                        <th>@lang('users.label.rank')</th>
                                        <th>@lang('users.label.expired')</th>
                                        <th>@lang('users.label.join_date')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(!empty($users))
                                        @foreach($users as $user)
                                            <tr {{ active_class(!$user->deleted_at, '', ' class=deleted') }}>
                                                <td>
                                                    {!! $user->link_id !!}
                                                </td>
                                                <td>{{ !empty($user->userProfile) ? $user->userProfile->name : '' }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->sex }}</td>
                                                <td>{{ !empty($user->userProfile) ? $user->userProfile->rank_name : '' }}</td>
                                                <td>{{ $user->expired }}</td>
                                                <td>{{ !empty($user->userProfile) ? $user->userProfile->created_at : '' }}</td>
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
                                @if(!empty($users))
                                    {{ __('labels.general.total_number', ['total_number' => $users->total() ]) }}
                                @endif
                            </div>
                        </div><!--col-->

                        <div class="col-5">
                            <div class="float-right">
                                {!! $users->render() !!}
                            </div>
                        </div><!--col-->
                    </div><!--row-->
                </div><!--card-body-->
            </div>
        </div>
    </div>
@endsection
