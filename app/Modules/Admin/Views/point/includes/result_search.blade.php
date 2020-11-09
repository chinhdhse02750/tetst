<div class="card-body">
    <div class="row">
        <div class="col-sm-5">
            <h4 class="card-title mb-0">
                @lang('point.label.search_result_list')
            </h4>
        </div><!--col-->
{{--        <div class="col-sm-7 pull-right">--}}
{{--            <input type="button" class="btn btn-primary mr-1 btn-action pull-right"--}}
{{--                   id="download-csv" value="@lang('point.label.download_csv')">--}}
{{--        </div>--}}

    </div><!--row-->

    <div class="row mt-4">
        <div class="col">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>@lang('point.label.member_id')</th>
                        <th>@lang('point.label.member_name')</th>
                        <th>@lang('users.label.email')</th>
                        <th>@lang('point.label.transaction')</th>
                        <th>@lang('point.label.balance')</th>
                        <th>@lang('point.label.date_time')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!empty($balances))
                        @foreach($balances as $balance)
                            <tr>
                                <td>{{ !empty($balance->user) ? $balance->user->id  : '' }}</td>
                                <td>{{ !empty($balance->user) ? $balance->user->userProfile->name : '' }}</td>
                                <td>{{ !empty($balance->user) ? $balance->user->email : '' }}</td>
                                <td>{{  $balance->transaction }}</td>
                                <td>{{  $balance->balance }}</td>
                                <td>{{  !empty($balance) ? $balance->created_at  : ''}}</td>
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
                @if(!empty($balances))
                    {{ __('labels.general.total_number', ['total_number' => $balances->total()]) }}
                @endif
            </div>
        </div><!--col-->

        <div class="col-5">
            <div class="float-right">
                {!! $balances->render() !!}
            </div>
        </div><!--col-->
    </div><!--row-->
</div><!--card-body-->
