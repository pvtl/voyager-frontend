@if ($collection)
    <div class="cell small-12">
        <div class="grid-x">
            @foreach($collection as $page)
                <div class="cell small-12">
                    <a href="/{{ $page->slug }}">
                        <h4>{{ $page->title }}</h4>
                    </a>

                    @if ($page->excerpt)
                        <p>{{ str_limit($page->excerpt, 50, '&hellip;') }}</p>
                    @endif
                </div> <!-- /.cell -->
            @endforeach
        </div> <!-- /.grid -->
    </div> <!-- /.cell -->
@endif
