@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-body">
            @include('includes.alerts.messages')
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        @lang('labels.account.list')
                    </h4>
                </div><!--col-->
                <div class="col-sm-7">
                    <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                        <a href="{{ route('accounts.create') }}" class="btn btn-primary mr-1 btn-action"
                           data-original-title="Create New">@lang('labels.general.register')</a>
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
                                <th>@lang('users.label.name')</th>
                                <th>@lang('users.label.email')</th>
                                <th>@lang('labels.general.role')</th>
                                <th>@lang('labels.general.created_at')</th>
                                <th>@lang('labels.general.updated_at')</th>
                                <th width="5%">@lang('labels.general.action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($accounts))
                                @foreach($accounts as $account)
                                <tr>
                                    <td class="table-text">
                                        <span>{{ !empty($account->id) ? $account->id : '' }}</span>
                                    </td>
                                    <td class="table-text">
                                        <span>{{ !empty($account->name) ? $account->name : '' }}</span>
                                    </td>
                                    <td class="table-text">
                                        <span>{{ !empty($account->email) ? $account->email : '' }}</span>
                                    </td>
                                    <td class="table-text">
                                        <span>{!! $account->all_roles_name !!}</span>
                                    </td>
                                    <td class="table-text">
                                        <span>{{ !empty($account->created_at) ? $account->created_at : '' }}</span>
                                    </td>
                                    <td class="table-text">
                                        <span>{{ !empty($account->updated_at) ? $account->updated_at : '' }}</span>
                                    </td>
                                    <td>
                                        @if (!$account->hasRole('super_admin'))
                                            <form action="{{ route('accounts.destroy', $account->id) }}" method="POST">
                                                @if ($account->deleted_at === null)
                                                    <a href="{{ route('accounts.edit', $account->id) }}"
                                                       class="btn btn-success"><i class="fas fa-pencil-alt"></i></a>
                                                    <a href="{{ route('accounts.destroy', $account->id) }}"
                                                       class="btn btn-danger"
                                                       data-method="delete"
                                                       data-trans-button-cancel="@lang('labels.general.cancel')"
                                                       data-trans-button-confirm="@lang('labels.general.delete')"
                                                       data-trans-title="@lang('alerts.general.confirm.delete')">
                                                        <i class="far fa-trash-alt"></i>
                                                    </a>
                                                @else
                                                    <a href="{{ route('accounts.restore', $account->id) }}"
                                                       class="btn btn-primary"
                                                       data-method="post"
                                                       data-trans-button-cancel="@lang('labels.general.cancel')"
                                                       data-trans-button-confirm="@lang('labels.general.yes')"
                                                       data-trans-title="@lang('alerts.general.confirm.restore')">
                                                        <i class="fas fa-undo"></i>
                                                    </a>
                                                @endif
                                            </form>
                                        @endif
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
                        {{ __('labels.general.total_number', ['total_number' => $accounts->total()]) }}
                    </div>
                </div><!--col-->
                <div class="col-5">
                    <div class="float-right">
                        {{$accounts->links()}}
                    </div>
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->
    </div>
@endsection


