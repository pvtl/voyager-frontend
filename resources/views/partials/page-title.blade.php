<div
    class="page-title"
    @if (View::hasSection('page_banner')) style="background-image: url(@yield('page_banner'))" @endif
>
    <div class="grid-container">
        <h1>@yield('page_title')</h1>
        @if (View::hasSection('page_subtitle'))
            <p>@yield('page_subtitle')</p>
        @endif
    </div> <!-- /.grid-container -->
</div> <!-- /.page-title -->

@include('voyager-frontend::partials.breadcrumbs')

