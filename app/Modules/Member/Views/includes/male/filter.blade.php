<script src="https://code.jquery.com/jquery-3.5.1.js"></script>

<div class="filter">
    <div class="js-top__title-filter top__title-filter d-md-none">
        <span>
            <svg id="icon-filtter" xmlns="http://www.w3.org/2000/svg" width="25.5" height="21.5" viewBox="0 0 25.5 21.5">
                <path d="M-40.747-3.192h2.36l.059.166a2.75,2.75,0,0,0,2.581,1.834,2.749,2.749,0,0,0,2.58-1.834l.06-.166h16.36a.751.751,0,0,0,.75-.75.752.752,0,0,0-.75-.75h-16.36l-.06-.166a2.749,2.749,0,0,0-2.58-1.834,2.75,2.75,0,0,0-2.581,1.834l-.059.166h-2.36a.751.751,0,0,0-.75.75A.75.75,0,0,0-40.747-3.192Zm5-2a1.252,1.252,0,0,1,1.25,1.25,1.252,1.252,0,0,1-1.25,1.25A1.251,1.251,0,0,1-37-3.942,1.251,1.251,0,0,1-35.747-5.192Z" transform="translate(41.497 6.692)" fill="#be8854"/>
                <path d="M-16.747,3.308h-2.36l-.06-.166a2.749,2.749,0,0,0-2.58-1.834,2.75,2.75,0,0,0-2.581,1.834l-.059.166h-16.36a.751.751,0,0,0-.75.75.75.75,0,0,0,.75.75h16.36l.059.166a2.75,2.75,0,0,0,2.581,1.834,2.749,2.749,0,0,0,2.58-1.834l.06-.166h2.36a.751.751,0,0,0,.75-.75A.752.752,0,0,0-16.747,3.308Zm-5,2A1.251,1.251,0,0,1-23,4.058a1.251,1.251,0,0,1,1.25-1.25,1.252,1.252,0,0,1,1.25,1.25A1.252,1.252,0,0,1-21.747,5.308Z" transform="translate(41.497 6.692)" fill="#be8854"/>
                <path d="M-16.747,11.308h-12.36l-.06-.166a2.749,2.749,0,0,0-2.58-1.834,2.75,2.75,0,0,0-2.581,1.834l-.059.166h-6.36a.751.751,0,0,0-.75.75.75.75,0,0,0,.75.75h6.36l.059.166a2.75,2.75,0,0,0,2.581,1.834,2.749,2.749,0,0,0,2.58-1.834l.06-.166h12.36a.751.751,0,0,0,.75-.75A.752.752,0,0,0-16.747,11.308Zm-15,2A1.251,1.251,0,0,1-33,12.058a1.251,1.251,0,0,1,1.25-1.25,1.252,1.252,0,0,1,1.25,1.25A1.252,1.252,0,0,1-31.747,13.308Z" transform="translate(41.497 6.692)" fill="#be8854"/>
            </svg>
            絞り込み
        </span>
    </div>
    <form class="filter__form" method="GET" id="filter_form">
        <div class="filter__form-group">
            <div class="form-group filter__form-group-item">
                <div class="filter__item">
                    <a href="javascript:void(0)" class="filter__header filter__header-collapse" data-toggle="collapse" data-target="#filterItemAge">
                        @lang('users.label.age')
                    </a>
                    <div class="collapse js-collapse" id="filterItemAge">
                        <label class="filter__form-check" for="checkAllAge">
                            <input class="filter__form-check-input check-all" type="checkbox" name="check_all_age" id="checkAllAge" value="-1">
                            <span class="checkmark checkmark__radio"></span>
                            <span class="checkmark__label">@lang('filters.member.all')</span>
                        </label>
                        @foreach($selectOption['male_ages'][App::getLocale()] as $key => $age)
                            <label class="filter__form-check" for="check_age_{{ $key }}">
                                <input class="filter__form-check-input check_age"
                                       type="checkbox"
                                       name="check_male_age[{{ $key }}]"
                                       id="check_age_{{ $key }}"
                                       value="{{ $key }}"
                                       data-name="{{ $age }}">
                                <span class="checkmark checkmark__checkbox"></span>
                                <span class="checkmark__label">{{$age}}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="filter__form-group">
            <div class="form-group filter__form-group-item">
                <div class="filter__item">
                    <a href="javascript:void(0)" class="filter__header filter__header-collapse" data-toggle="collapse" data-target="#filterItemDating">
                        @lang('filters.member.dating_type')
                    </a>
                    <div class="collapse js-collapse" id="filterItemDating">
                        <label class="filter__form-check" for="checkAllDatingType">
                            <input class="filter__form-check-input check-all" type="checkbox" name="checkAllDatingType" id="checkAllDatingType" value="-1">
                            <span class="checkmark checkmark__radio"></span>
                            <span class="checkmark__label">@lang('filters.member.all')</span>
                        </label>
                        @foreach($selectOption['favorite_dating_type'][App::getLocale()] as $key => $dating_type)
                            <label class="filter__form-check" for="check_dating_type_{{ $key }}">
                                <input class="filter__form-check-input dating_type"
                                       type="checkbox"
                                       name="favorite_dating_type[{{ $key }}]"
                                       id="check_dating_type_{{ $key }}"
                                       value="{{ $key }}"
                                       data-name="{{ $dating_type }}">
                                <span class="checkmark checkmark__checkbox"></span>
                                <span class="checkmark__label">{{ $dating_type }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="filter__form-group">
            <div class="form-group filter__form-group-item">
                <div class="filter__item">
                    <a href="javascript:void(0)" class="filter__header filter__header-collapse" data-toggle="collapse" data-target="#filterItemRank">
                        @lang('users.label.rank')
                    </a>
                    <div class="collapse js-collapse" id="filterItemRank">
                        <label class="filter__form-check" for="checkAllRank">
                            <input class="filter__form-check-input check-all" type="checkbox" name="checkAllRank" id="checkAllRank" value="0">
                            <span class="checkmark checkmark__radio"></span>
                            <span class="checkmark__label">@lang('filters.member.all')</span>
                        </label>
                        @foreach($ranks as $key => $rank)
                            <label class="filter__form-check" for="check_rank_{{ $rank->id }}">
                                <input class="filter__form-check-input rank"
                                       type="checkbox"
                                       name="check_rank[{{ $rank->id }}]"
                                       id="check_rank_{{ $rank->id }}"
                                       value="{{ $rank->id }}"
                                       data-name="{{ $rank->name }}">
                                <span class="checkmark checkmark__checkbox"></span>
                                <span class="checkmark__label">{{ $rank->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="filter__form-group">
            <div class="form-group filter__form-group-item">
                <div class="filter__item">
                    <a href="javascript:void(0)" class="filter__header filter__header-collapse" data-toggle="collapse" data-target="#filterItemSmoking">
                        @lang('users.label.smoking')
                    </a>
                    <div class="collapse js-collapse" id="filterItemSmoking">
                        <label class="filter__form-check" for="checkAllMaleSmoking">
                            <input class="filter__form-check-input check-all" type="checkbox" name="checkAllMaleSmoking" id="checkAllMaleSmoking" value="-1">
                            <span class="checkmark checkmark__radio"></span>
                            <span class="checkmark__label">@lang('filters.member.all')</span>
                        </label>
                        @foreach($selectOption['male_smoking'][App::getLocale()] as $key => $smoking)
                            <label class="filter__form-check" for="check_smoking_{{ $key }}">
                                <input class="filter__form-check-input smoking"
                                       type="checkbox"
                                       name="check_male_smoking[{{ $key }}]"
                                       id="check_smoking_{{ $key }}"
                                       value="{{ $key }}"
                                       data-name="{{ $smoking }}">
                                <span class="checkmark checkmark__checkbox"></span>
                                <span class="checkmark__label">{{ $smoking }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

{!! script(('js/filterMember.js')) !!}
