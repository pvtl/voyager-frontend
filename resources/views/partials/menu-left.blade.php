@foreach($items as $menu_item)
    @if(count($menu_item->children) > 0)<ul class="dropdown menu" data-dropdown-menu>@endif
        <li>
            <a href="{{ $menu_item->link() }}">{{ $menu_item->title }}</a>
            @if(count($menu_item->children) > 0)
                <ul class="dropdown menu" data-dropdown-menu>
                    @foreach($menu_item->children as $menu_item_2)
                        <li>
                            <a href="{{ $menu_item_2->link() }}">{{ $menu_item_2->title }}</a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </li>
    @if(count($menu_item->children) > 0)</ul>@endif
@endforeach