<ul class="submenu">
    @foreach($childs as $child)
        <li><a href="#">{{ $child->name }}
                @if(count($child->childrenCategories))
                    <span class="submenu-indicator">+</span>
                @endif
            </a>
            @if(count($child->childrenCategories))
                @include('includes.menu_sub',['childs' => $child->childrenCategories])
            @endif
        </li>
    @endforeach
</ul>
