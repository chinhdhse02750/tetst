@foreach($menu->childrenCategories as $menu)
    <option value="{{ $menu->id }}"  @if($categories->parent == $menu->id) selected @endif>
        {{ $char }}{{ $menu->name }}</option>
    @include('category.editChildItems', ['char' => $char."|---" , 'categories' => $categories] )
@endforeach
