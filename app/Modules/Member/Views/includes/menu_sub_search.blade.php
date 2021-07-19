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
<ul class="sub-menu collapse show">
    @foreach($childs as $child)
        <li class="menu-toggle  menu-children" style="padding-left: 20px">
            <a class="nav-link department-link link-children" href="{{ route('cate.view', $child->alias) }}">{{ $child->name }}</a>
            @if(count($child->childrenCategories))
                <span data-toggle="collapse"
                      data-target="#{{ $child->alias }}"
                      class="collapsed text-truncate submenu-indicator">
                    <i class="icon_minus-06"></i></span>
            @endif
            @if(count($child->childrenCategories))
                @include('includes.menu_sub_search',[
                'childs' => $child->childrenCategories,
                'target' => $child->alias,
                'pluck' => $child->childrenCategories->pluck('alias')
                 ])
            @endif
        </li>
    @endforeach
</ul>