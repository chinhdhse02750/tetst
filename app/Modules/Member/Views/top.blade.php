@extends('layouts.app')

@section('content')
<div class="main-container">
    <div class="main-container__mix">
        <div class="mix">
            <div class="mix__filter-selected">
                <div class="mix__filter-has-selected" id="filter-selected"></div>
                <div class="mix__filter-total-result">{{ __('filters.member.search_result', ['total' => $members->count()]) }} </div>
            </div>
            <div class="mix__order-by">
                <div class="form-group mix__order-by-group">
                    <label for="selectOrderBy" class="mix__order-by-label d-none d-md-block">@lang('filters.member.sort')</label>
                    <select class="form-control mix__order-select" id="selectOrderBy" name="order_by">
                        <option value="desc" {{ app('request')->input('order_by') == 'desc' ? 'selected' : '' }}>
                            @lang('filters.member.registration_date_latest')
                        </option>
                        <option value="asc" {{ app('request')->input('order_by') == 'asc' ? 'selected' : '' }}>
                            @lang('filters.member.registration_date_oldest')
                        </option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="main-container__list-item" id="list-member">
        @if(Auth::user()->female)
            @include('includes.male.member_list')
        @else
            @include('includes.female.member_list')
        @endif
        <div class="main-container__pagination">
            <nav aria-label="navigation">
                <ul class="pagination">
                    @include('pagination.link', ['paginator' => $members])
                </ul>
            </nav>
        </div>
    </div>
</div>
    <div class="container__video"></div>
    <div class="template__loading">
        <i class="icon icon__loading"></i>
    </div>

@endsection

@push('script')
    <script>
            $('.js-item-detail__capture').on('click', function () {
                let url = "{{ url('api/member/') }}/" + $(this).attr('data-id');
                $('.template__loading').addClass('active');
                $.ajax({
                    url: url,
                    type: 'GET',
                    error: function() {
                        $('.template__loading').removeClass('active');
                    },
                    success: function(data) {
                        $('.template__loading').removeClass('active');
                        $(this).lightGallery({
                            dynamic: true,
                            mode: 'lg-fade',
                            addClass: 'fixed-size',
                            thumbnail: false,
                            download: false,
                            startClass: '',
                            counter: false,
                            speed: 500,
                            dynamicEl: data.data.private_photos
                        })
                    }
                });
            });

            $('.js-item-detail__video').on('click', function () {
                let url = "{{ url('api/member/') }}/" + $(this).attr('data-id');
                $('.template__loading').addClass('active');
                $.ajax({
                    url: url,
                    type: 'GET',
                    error: function() {
                        $('.template__loading').removeClass('active');
                    },
                    success: function(data) {
                        let htmlVideo = '';
                        $('.template__loading').removeClass('active');
                        $.each(data.data.videos, function(index, value) {
                            htmlVideo += '<div style="display:none;" id="video' + value.id + '">\n' +
                                '<video class="lg-video-object lg-html5" controls preload="none">\n' +
                                '<source src="' + value.video + '" type="video/mp4">\n' +
                                'Your browser does not support HTML5 video.\n' +
                                '</video>\n' +
                                '</div>';
                        });
                        $('.container__video').html(htmlVideo);
                        $(this).lightGallery({
                            dynamic: true,
                            mode: 'lg-fade',
                            addClass: 'fixed-size',
                            thumbnail: false,
                            download: false,
                            startClass: '',
                            counter: false,
                            speed: 500,
                            dynamicEl: data.data.videos
                        })
                    }
                });
            });
    </script>

    {!! script(('js/filterMember.js')) !!}
@endpush
