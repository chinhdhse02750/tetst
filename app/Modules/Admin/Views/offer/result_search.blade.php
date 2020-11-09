<div class="card-body">
    <div class="row">
        <div class="col-sm-5">
            <h4 class="card-title mb-0">
                @lang('point.label.search_result_list')
            </h4>
        </div><!--col-->
    </div><!--row-->

    <div class="row mt-4">
        <div class="col">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr class="text-center">
                        <th>ID</th>
                        <th>@lang('offers.label.member_id')</th>
                        <th>@lang('offers.label.member_rank')</th>
                        <th>@lang('offers.label.member_point')</th>
                        <th>@lang('offers.label.total_member_offer')</th>
                        <th>@lang('users.label.status')</th>
                        <th>@lang('offers.label.payment_method')</th>
                        <th>@lang('offers.label.offer_date')</th>
                        <th>@lang('labels.general.action')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!empty($offers))
                        @foreach($offers as $offer)
                            <tr class="text-center">
                                <td width="10%">{{ !empty($offer->id) ? $offer->id  : '' }}</td>
                                <td width="10%">{!! $offer->user->link_id !!}</td>
                                <td width="10%">{{ !empty($offer->user) ? $offer->user->userProfile->rank_name : '' }}</td>
                                <td width="10%">{{ !empty($offer->user) ? $offer->user->offer_point : '' }}</td>
                                <td width="10%">{{ !empty($offer->user) ? $offer->total_member : '' }}</td>
                                <td width="12%">
                                    @foreach($settingMember['offer_status'][App::getLocale()] as $key => $value)
                                        @if($key === (int)$offer->status)
                                            {{ $value }}
                                        @endif
                                    @endforeach
                                </td>
                                <td width="16%">
                                    @foreach($settingMember['payment_method'][App::getLocale()] as $key => $value)
                                        @if($key === (int)$offer->payment_method)
                                            {{ $value }}
                                        @endif
                                    @endforeach
                                </td>
                                <td width="16%">{{  !empty($offer) ? $offer->created_at  : ''}}</td>
                                <td width="16%">
                                    <a href="{{ route('offers.show', $offer->id) }}"
                                       class="btn btn-default"><i class="fas fa-eye"></i></a>
                                    <a href="{{ route('offers.edit', $offer->id) }}"
                                       class="btn btn-success"><i class="fas fa-pencil-alt"></i></a>
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
                @if(!empty($offers))
                    {{ __('labels.general.total_number', ['total_number' => $offers->total()]) }}
                @endif
            </div>
        </div><!--col-->
        <div class="col-5">
            <div class="float-right">
                {!! $offers->render() !!}
            </div>
        </div>
    </div><!--row-->
</div><!--card-body-->
