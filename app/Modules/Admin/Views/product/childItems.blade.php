@foreach($menu->childrenCategories as $menu)
    <option id="{{ $menu->id }}" value="{{ $menu->id }}">{{ $char }}{{ $menu->name }}</option>
    @include('product.childItems', ['char' => $char."|---", 'menu'=> $menu] )
@endforeach
