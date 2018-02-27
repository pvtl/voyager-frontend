@foreach($items as $menu_item)
    <li>
        <a href="{{ $menu_item->link() }}">
            <i class="fab {{ $menu_item->icon_class }} fa-2x"></i>
        </a>
    </li>
@endforeach