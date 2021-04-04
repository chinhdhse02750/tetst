{{--<ul class="submenu">--}}
    {{--@foreach($childs as $child)--}}
        {{--<li><a class="department-link" href="{{ route('cate.view', $menu->alias) }}">{{ $child->name }}--}}
                {{--@if(count($child->childrenCategories))--}}
                    {{--<span class="submenu-indicator">+</span>--}}
                {{--@endif--}}
            {{--</a>--}}
            {{--@if(count($child->childrenCategories))--}}
                {{--@include('includes.menu_sub',['childs' => $child->childrenCategories])--}}
            {{--@endif--}}
        {{--</li>--}}
    {{--@endforeach--}}
{{--</ul>--}}

<ul class="sub-menu collapse" id="{{ $target }}">
    @foreach($childs as $child)
        <li class="menu-toggle" style="padding-left: 15px">
            <a class="nav-link department-link" href="{{ route('cate.view', $child->alias) }}">{{ $child->name }}</a>
            @if(count($child->childrenCategories))
                <span data-toggle="collapse"
                      data-target="#{{ $child->alias }}"
                      class="collapsed text-truncate submenu-indicator"><i class="icon_plus"></i></span>
            @endif
            @if(count($child->childrenCategories))
                @include('includes.menu_sub',['childs' => $child->childrenCategories, 'target' => $child->alias])
            @endif
        </li>
    @endforeach
</ul>