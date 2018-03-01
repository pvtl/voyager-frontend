<div class="page-title">
    <div class="grid-container">
        <h1>@yield('page_title')</h1>
        @if (trim($__env->yieldContent('page_subtitle')))
            <p>@yield('page_subtitle')</p>
        @endif
    </div> <!-- /.grid-container -->
</div> <!-- /.page-title -->

@include('voyager-frontend::partials.breadcrumbs')
