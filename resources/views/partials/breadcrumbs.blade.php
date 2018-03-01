@php
    $httpPath = Request::segments();

    $breadcrumbs = array_map(function ($key, $crumb) use ($httpPath) {
        $crumbPath = join('/', array_slice($httpPath, 0, $key + 1));
        $crumbLink = env('APP_URL') . '/' . $crumbPath;

        return [
            'link' => $crumbLink,
            'text' => str_replace('-', ' ', $crumb),
        ];
    }, array_keys($httpPath), $httpPath);

    array_unshift($breadcrumbs, [
        'link' => '/',
        'text' => 'Home',
    ]);
@endphp

@if (count($breadcrumbs) > 1)
    <div class="grid-container">
        <div class="vspace-1"></div>

        <nav aria-label="You are here:" role="navigation">
            <ul class="breadcrumbs">
                @foreach ($breadcrumbs as $key => $crumb)
                    <li>
                        @if (($key + 1) === count($breadcrumbs))
                            <span class="breadcrumb">
                                {{ $crumb['text'] }}
                            </span>
                        @else
                            <a class="breadcrumb" href="{{ $crumb['link'] }}">
                                {{ $crumb['text'] }}
                            </a>
                        @endif
                    </li>
                @endforeach
            </ul>
        </nav>
    </div>
@endif
