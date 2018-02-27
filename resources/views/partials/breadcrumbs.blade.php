@if (Session::has('breadcrumbs'))
    <div class="grid-container">
        <div class="vspace-1"></div>

        <nav aria-label="You are here:" role="navigation">
            <ul class="breadcrumbs">
                @foreach (Session::get('breadcrumbs') as $key => $crumb)
                    <li>
                        <a class="breadcrumb" href="{{ $crumb['link'] }}">
                            @if (($key + 1) === count(Session::get('breadcrumbs')))
                                <span class="show-for-sr">Current: </span>
                            @endif
                            {{ ucwords($crumb['text']) }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </nav>
    </div>
@endif
