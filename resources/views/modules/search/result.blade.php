<div class="cell small-12">
    <a href="/{{ $result->slug }}">
        <h5>{{ $result["title"] }}</h5>
    </a>

    @if ($result->excerpt)
        <p>{{ str_limit($result->excerpt, 200, '&hellip;') }}</p>
    @endif
</div> <!-- /.cell -->