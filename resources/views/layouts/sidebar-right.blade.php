@include('voyager-frontend::partials.meta')
@include('voyager-frontend::partials.header')
@include('voyager-frontend::partials.page-title')

<main class="main-content">
    <div class="grid-container">
        <div class="grid-x grid-padding-x">
            <div class="vspace-2"></div>
            <div class="cell small-12 medium-9">
                @yield('content')
            </div>

            <div class="cell small-12 medium-3 sidebar">
                <div class="card">
                    <ul class="vertical menu">
                        <li><a href="#">Page One</a></li>
                        <li><a href="#">Page Two</a></li>
                        <li><a href="#">Page Three</a></li>
                        <li><a href="#">Page Four</a></li>
                    </ul>
                </div>

                <div class="card">
                    <img alt="" src="https://images.unsplash.com/photo-1473800447596-01729482b8eb?auto=format&fit=crop&w=500&q=50">
                    <div class="card-section">
                        <h4>JS Guns.</h4>
                        <p>It has an easy to override visual style, and is appropriately subdued.</p>
                        <a href="#" class="button">Learn More</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="vspace-2"></div>
    </div>
</main>

@include('voyager-frontend::partials.footer')
