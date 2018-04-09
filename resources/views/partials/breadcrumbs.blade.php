@if (isset($breadcrumbs) && count($breadcrumbs) > 1)
    <div class="breadcrumbs-container background-color-lightgray">
        <div class="grid-container">
            <div class="vspace-1"></div>

            <nav aria-label="You are here:" role="navigation">
                <ul class="breadcrumbs">
                    @foreach ($breadcrumbs as $key => $crumb)
                        <li>
                            @if (($key + 1) === count($breadcrumbs))
                                <span class="breadcrumb">{{ $crumb['text'] }}</span>
                            @else
                                <a class="breadcrumb" href="{{ $crumb['link'] }}">{{ $crumb['text'] }}</a>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </nav>

            <div class="vspace-1"></div>
        </div> <!-- /.grid-container -->
    </div> <!-- /.breadcrumbs-container -->
@endif
