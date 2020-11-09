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
            <div class="form-group">
                <div class="filter__header">@lang('filters.member.news')</div>
                <label class="filter__form-check" for="checkAllNew">
                    <input class="filter__form-check-input check-all"
                           type="radio"
                           name="member_info"
                           id="checkAllNew"
                           value="1"
                           data-name="@lang('filters.member.all')">
                    <span class="checkmark checkmark__radio"></span>
                    <span class="checkmark__label">@lang('filters.member.all')</span>
                </label>
                <label class="filter__form-check" for="checkMemberNew">
                    <input class="filter__form-check-input"
                           type="radio"
                           name="member_info"
                           id="checkMemberNew"
                           value="2"
                           data-name="@lang('filters.member.new_member')">
                    <span class="checkmark checkmark__radio"></span>
                    <span class="checkmark__label">@lang('filters.member.new_member')</span>
                </label>
                <label class="filter__form-check" for="checkPickUp">
                    <input class="filter__form-check-input"
                           type="radio"
                           name="member_info"
                           id="checkPickUp"
                           value="3"
                           data-name="@lang('filters.member.pick_up')">
                    <span class="checkmark checkmark__radio"></span>
                    <span class="checkmark__label">@lang('filters.member.pick_up')</span>
                </label>
                <label class="filter__form-check" for="checkNewComment">
                    <input class="filter__form-check-input"
                           type="radio"
                           name="member_info"
                           id="checkNewComment"
                           value="5"
                           data-name="@lang('filters.member.new_comment')">
                    <span class="checkmark checkmark__radio"></span>
                    <span class="checkmark__label">@lang('filters.member.new_comment')</span>
                </label>
            </div>
        </div>
        <div class="filter__form-group" style="display: none">
            <div class="form-group filter__form-group-item">
                <label for="selectArea" class="filter__header">エリア</label>
                <select class="form-control filter__form-select" id="selectArea" name="area">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                </select>
            </div>
        </div>
        <div class="filter__form-group">
            <div class="form-group filter__form-group-item">
                <div class="filter__item">
                    <a href="javascript:void(0)" class="filter__header filter__header-collapse" data-toggle="collapse" data-target="#filterItemArea" aria-expanded="true">
                        @lang('filters.member.residential_areas')
                    </a>
                    <div class="collapse js-collapse show" id="filterItemArea">
                        <label class="filter__form-check" for="checkAllArea">
                            <input class="filter__form-check-input check-all" type="checkbox" name="checkAllArea" id="checkAllArea" value="-1">
                            <span class="checkmark checkmark__radio"></span>
                            <span class="checkmark__label">@lang('filters.member.all')</span>
                        </label>
                        @if(!empty($areas))
                            @foreach($areas as $area)
                                <div class="filter__item">
                                    <a href="javascript:void(0)" class="filter__header filter__header-collapse" data-toggle="collapse" data-target="#filterItem{{ $area->id }}">
                                        {{ $area->name }}
                                    </a>
                                    @if(!empty($area->prefectures))
                                        @foreach($area->prefectures as $prefecture)
                                            <div class="collapse js-collapse filterItem{{ $area->id }}" id="filterItem{{ $area->id }}">
                                                <label class="filter__form-check" for="prefecture_ids_{{ $prefecture->id }}">
                                                    <input class="filter__form-check-input prefecture"
                                                           type="checkbox"
                                                           name="prefecture_ids[{{ $prefecture->id }}]"
                                                           id="prefecture_ids_{{ $prefecture->id }}"
                                                           value="{{ $prefecture->id }}"
                                                           data-name="{{ $prefecture->name }}"
                                                           data-area-id="{{ $area->id }}">
                                                    <span class="checkmark checkmark__checkbox"></span>
                                                    <span class="checkmark__label">{{ $prefecture->name }}</span>
                                                </label>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="filter__form-group">
            <div class="form-group filter__form-group-item">
                <div class="filter__item">
                    <a href="javascript:void(0)" class="filter__header filter__header-collapse" data-toggle="collapse" data-target="#filterItemAge">
                        @lang('users.label.age')
                    </a>
                    <div class="collapse js-collapse" id="filterItemAge">
                        @foreach($selectOption['ages'][App::getLocale()] as $key => $age)
                            @if($key == 0)
                                <label class="filter__form-check" for="checkAllAge">
                                    <input class="filter__form-check-input check-all" type="checkbox" name="checkAllAge" id="checkAllAge" value="-1">
                                    <span class="checkmark checkmark__radio"></span>
                                    <span class="checkmark__label">{{$age}}</span>
                                </label>
                            @else
                                <label class="filter__form-check" for="check_age_{{$key}}">
                                    <input class="filter__form-check-input check_age"
                                           type="checkbox"
                                           name="check_age[{{$key}}]"
                                           id="check_age_{{$key}}"
                                           value="{{$key}}"
                                           data-name="{{$age}}">
                                    <span class="checkmark checkmark__checkbox"></span>
                                    <span class="checkmark__label">{{$age}}</span>
                                </label>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="filter__form-group">
            <div class="form-group filter__form-group-item">
                <div class="filter__item">
                    <a href="javascript:void(0)" class="filter__header filter__header-collapse" data-toggle="collapse" data-target="#filterItemBustCup">
                        @lang('filters.member.underwear_type')
                    </a>
                    <div class="collapse js-collapse" id="filterItemBustCup">
                        <label class="filter__form-check" for="checkAllCup">
                            <input class="filter__form-check-input check-all" type="checkbox" name="check_cup[]" id="checkAllCup" value="-1">
                            <span class="checkmark checkmark__radio"></span>
                            <span class="checkmark__label">@lang('filters.member.all')</span>

                        </label>

                        <label class="filter__form-check" for="checkA_C">
                            <input class="filter__form-check-input check_cup"
                                   type="checkbox"
                                   name="check_cup[]"
                                   id="checkA_C"
                                   value="1"
                                   data-name="A～C">
                            <span class="checkmark checkmark__checkbox"></span>
                            <span class="checkmark__label">A～C</span>

                        </label>

                        <label class="filter__form-check" for="checkD_F">
                            <input class="filter__form-check-input check_cup"
                                   type="checkbox"
                                   name="check_cup[]"
                                   id="checkD_F"
                                   value="2"
                                   data-name="D～F">
                            <span class="checkmark checkmark__checkbox"></span>
                            <span class="checkmark__label">D～F</span>

                        </label>

                        <label class="filter__form-check" for="checkG">
                            <input class="filter__form-check-input check_cup"
                                   type="checkbox"
                                   name="check_cup[]"
                                   id="checkG"
                                   value="3"
                                   data-name="G～">
                            <span class="checkmark checkmark__checkbox"></span>
                            <span class="checkmark__label">G～</span>

                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="filter__form-group">
            <div class="form-group filter__form-group-item">
                <div class="filter__item">
                    <a href="javascript:void(0)" class="filter__header filter__header-collapse" data-toggle="collapse" data-target="#filterItemHeight">
                        @lang('users.label.height')
                    </a>
                    <div class="collapse js-collapse" id="filterItemHeight">
                        @foreach($selectOption['heights'][App::getLocale()] as $key => $height)
                            @if($key == 0)
                                <label class="filter__form-check" for="checkAllHeight">
                                    <input class="filter__form-check-input check-all" type="checkbox" name="checkAllHeight" id="checkAllHeight" value="-1">
                                    <span class="checkmark checkmark__radio"></span>
                                    <span class="checkmark__label">{{$height}}</span>
                                </label>
                            @else
                                <label class="filter__form-check" for="check_height_{{$key}}">
                                    <input class="filter__form-check-input check_height"
                                           type="checkbox"
                                           name="check_height[{{$height}}]"
                                           id="check_height_{{$key}}"
                                           value="{{$key}}"
                                           data-name="{{$height}}">
                                    <span class="checkmark checkmark__checkbox"></span>
                                    <span class="checkmark__label">{{$height}}</span>
                                </label>
                            @endif
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
                            <input class="filter__form-check-input check-all" type="checkbox" name="checkAllDatingType" id="checkAllDatingType" value="0">
                            <span class="checkmark checkmark__radio"></span>
                            <span class="checkmark__label">@lang('filters.member.all')</span>
                        </label>
                        @foreach($selectOption['dating_types'][App::getLocale()] as $key => $dating_type)
                            <label class="filter__form-check" for="check_dating_type_{{$key}}">
                                <input class="filter__form-check-input dating_type"
                                       type="checkbox"
                                       name="check_dating_type[{{$key}}]"
                                       id="check_dating_type_{{$key}}"
                                       value="{{$key}}"
                                       data-name="{{$dating_type}}">
                                <span class="checkmark checkmark__checkbox"></span>
                                <span class="checkmark__label">{{$key}}.{{$dating_type}}</span>
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
                            <label class="filter__form-check" for="check_rank_{{$rank->id}}">
                                <input class="filter__form-check-input rank"
                                       type="checkbox"
                                       name="check_rank[{{$rank->id}}]"
                                       id="check_rank_{{$rank->id}}"
                                       value="{{$rank->id}}"
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
                        <label class="filter__form-check" for="checkAllSmoking">
                            <input class="filter__form-check-input check-all"
                                   type="radio"
                                   name="smoking"
                                   id="checkAllSmoking"
                                   value="2"
                                   data-name="@lang('filters.member.all')">
                            <span class="checkmark checkmark__radio"></span>
                            <span class="checkmark__label">@lang('filters.member.all')</span>
                        </label>
                        <label class="filter__form-check" for="checkSmoking">
                            <input class="filter__form-check-input smoking"
                                   type="radio"
                                   name="smoking"
                                   id="checkSmoking"
                                   value="1"
                                   data-name="@lang('filters.member.smoking')">
                            <span class="checkmark checkmark__radio"></span>
                            <span class="checkmark__label">@lang('filters.member.smoking')</span>
                        </label>
                        <label class="filter__form-check" for="checkNoSmoking">
                            <input class="filter__form-check-input smoking"
                                   type="radio"
                                   name="smoking"
                                   id="checkNoSmoking"
                                   value="0"
                                   data-name="@lang('filters.member.no_smoking')">
                            <span class="checkmark checkmark__radio"></span>
                            <span class="checkmark__label">@lang('filters.member.no_smoking')</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="filter__form-group">
            <div class="form-group filter__form-group-item">
                <div class="filter__item">
                    <a href="javascript:void(0)" class="filter__header filter__header-collapse" data-toggle="collapse" data-target="#filterItemAlcohol">
                        @lang('users.label.alcohol')
                    </a>
                    <div class="collapse js-collapse" id="filterItemAlcohol">
                        <label class="filter__form-check" for="checkAllAlcohol">
                            <input class="filter__form-check-input check-all"
                                   type="radio"
                                   name="alcohol"
                                   id="checkAllAlcohol"
                                   value="2">
                            <span class="checkmark checkmark__radio"></span>
                            <span class="checkmark__label">@lang('filters.member.all')</span>
                        </label>
                        <label class="filter__form-check" for="checkAlcohol">
                            <input class="filter__form-check-input alcohol"
                                   type="radio"
                                   name="alcohol"
                                   id="checkAlcohol"
                                   value="1"
                                   data-name="@lang('filters.member.drink')">
                            <span class="checkmark checkmark__radio"></span>
                            <span class="checkmark__label">@lang('filters.member.drink')</span>
                        </label>
                        <label class="filter__form-check" for="checkNoAlcohol">
                            <input class="filter__form-check-input alcohol"
                                   type="radio"
                                   name="alcohol"
                                   id="checkNoAlcohol"
                                   value="0"
                                   data-name="@lang('filters.member.no_drink')">
                            <span class="checkmark checkmark__radio"></span>
                            <span class="checkmark__label">@lang('filters.member.no_drink')</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

{!! script(('js/filterMember.js')) !!}
