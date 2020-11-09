<div class="card-body">
    <div class="row">
        <div class="col-sm-5">
            <h4 class="card-title mb-0">
                @lang('news.label.search_result')
            </h4>
        </div><!--col-->
    </div><!--row-->

    <div class="row mt-4">
        <div class="col">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>@lang('labels.general.id')</th>
                        <th>@lang('news.label.content')</th>
                        <th>@lang('news.label.direction')</th>
                        <th>@lang('news.label.display_order')</th>
                        <th>@lang('news.label.public_start_time')</th>
                        <th>@lang('news.label.public_end_time')</th>
                        <th>@lang('news.label.date_and_time')</th>
                        <th>@lang('news.button.operation')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!empty($news))
                        @foreach($news as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ !empty($item->content) ? $item->content: '' }}</td>
                                <td>{{ !empty($item->direction) ? ucfirst($item->direction): '' }}</td>
                                <td>{{ !empty($item->order) ? $item->order: '' }}</td>
                                <td>{{ !empty($item->start_time) ? $item->start_time: '' }}</td>
                                <td>{{ !empty($item->end_time) ? $item->end_time: '' }}</td>
                                <td>{{ !empty($item->created_at) ? $item->created_at: '' }}</td>
                                <td>
                                    <form action="{{ route('news.destroy', $item->id) }}"
                                          method="POST">
                                        <a href="{{ route('news.edit', $item->id) }}"
                                           class="btn btn-success"><i class="fas fa-pencil-alt"></i></a>
                                        <a href="{{ route('news.destroy', $item->id) }}"
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
                    @endif
                    </tbody>
                </table>
            </div>
        </div><!--col-->
    </div><!--row-->
    <div class="row">
        <div class="col-7">
            <div class="float-left">
                @if(!empty($news))
                    {{ __('labels.general.total_number', ['total_number' => $news->total()]) }}
                @endif
            </div>
        </div><!--col-->
    </div><!--row-->
</div>
