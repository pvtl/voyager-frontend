@foreach($items as $menu_item)
    <a class="py-2 d-none d-md-inline-block" href="{{ $menu_item->link() }}">{{ $menu_item->title }}</a><
@endforeach