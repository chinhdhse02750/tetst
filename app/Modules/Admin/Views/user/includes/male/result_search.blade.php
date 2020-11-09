<div class="card-body">
    <div class="row">
        <div class="col-sm-5">
            <h4 class="card-title mb-0">
                @lang('users.label.search_result_list')
            </h4>
        </div><!--col-->
    </div><!--row-->

    <div class="row mt-4">
        <div class="col">
            <div class="table-responsive table-user-responsive">
                <table class="table adm__user-list">
                    <thead>
                    <tr>
                        <th width="5%">@lang('users.label.member_id')</th>
                        <th width="10%">@lang('users.label.member_name')</th>
                        <th width="15%">@lang('users.label.email')</th>
                        <th width="10%">@lang('users.label.rank')</th>
                        <th width="10%">@lang('users.label.balance')</th>
                        <th width="15%">@lang('users.label.expired')</th>
                        <th width="15%">@lang('users.label.join_date')</th>
                        <th width="15%">@lang('users.label.operation')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!empty($maleUsers))
                        @foreach($maleUsers as $user)
                            <tr {{ active_class(!$user->deleted_at, '', ' class=deleted') }}>
                                <td>{{ $user->id }}</td>
                                <td>{{ !empty($user->userProfile) ? $user->userProfile->name : '' }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ !empty($user->userProfile) ? $user->userProfile->rank_name: '' }}</td>
                                <td>{{ $user->total_amount_label }}</td>
                                <td>{{ $user->expired }}</td>
                                <td>{{ !empty($user->userProfile) ? $user->userProfile->created_at : '' }}</td>
                                <td class="btn-td btn-action-user">@include('user.includes.action', ['user' => $user])</td>
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
                @if(!empty($maleUsers))
                    {{ __('labels.general.total_number', ['total_number' => $maleUsers->total() ]) }}
                @endif
            </div>
        </div><!--col-->

        <div class="col-5">
            <div class="float-right">
                {!! $maleUsers->render() !!}
            </div>
        </div><!--col-->
    </div><!--row-->
</div><!--card-body-->
