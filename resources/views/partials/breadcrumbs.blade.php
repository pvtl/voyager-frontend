@if (Session::has('breadcrumbs'))
    @foreach (Session::get('breadcrumbs') as $key => $crumb)
        @if ($key > 0 && $key < count(Session::get('breadcrumbs')))
            <span class="breadcrumb-separator">&nbsp;>&nbsp;</span>
        @endif

        <a class="breadcrumb" href="{{ $crumb['link'] }}">{{ ucwords($crumb['text']) }}</a>
    @endforeach
@endif
