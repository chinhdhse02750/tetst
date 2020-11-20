@foreach($menu->childrenCategories as $menu)
    <option @if (in_array($menu->id,  $categoryId->toArray()) ) selected @endif
            id="{{ $menu->id }}" value="{{ $menu->id }}">{{ $char }}{{ $menu->name }}</option>
    @include('product.childItems', ['char' => $char."|---", 'menu'=> $menu] )
@endforeach
