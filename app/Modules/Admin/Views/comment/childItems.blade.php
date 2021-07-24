@foreach($menu->childrenCategories as $menu)
    <option value="{{ $menu->id }}">{{ $char }}{{ $menu->name }}</option>
    @include('category.childItems', ['char' => $char."|---"] )
@endforeach
