@extends('voyager-frontend::layouts.default')
@section('meta_title', $page->title)
@section('meta_description', $page->meta_description)

@section('content')
    <!-- Intro (block) -->
    <!-- ================================================================== -->
    <div class="callout extra-large background-image">
        <div class="grid-container column text-center">
            <h1>Changing the World Through Design</h1>
            <p class="lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in dui mauris.</p>
            <a href="#" class="button large">Learn More</a>
            <a href="#" class="button large hollow">Learn Less</a>
        </div>
    </div>
    <!-- / END BLOCK -->

    <!-- 2 Column Cards (block) -->
    <!-- ================================================================== -->
    <div class="grid-container">
        <div class="grid-x grid-padding-x grid-padding-y">
            <div class="cell small-12 medium-6">
                <div class="card">
                    <img src="https://images.unsplash.com/photo-1464823063530-08f10ed1a2dd?auto=format&fit=crop&w=500&q=50">
                    <div class="card-section">
                        <h4>HTML Experts.</h4>
                        <p>It has an easy to override visual style, and is appropriately subdued.</p>
                        <a href="#" class="button">Learn More</a>
                    </div> <!-- /.card-section -->
                </div> <!-- /.card -->
            </div> <!-- /.cell -->

            <div class="cell small-12 medium-6">
                <div class="card">
                    <img src="https://images.unsplash.com/photo-1473800447596-01729482b8eb?auto=format&fit=crop&w=500&q=50">
                    <div class="card-section">
                        <h4>JS Guns.</h4>
                        <p>It has an easy to override visual style, and is appropriately subdued.</p>
                        <a href="#" class="button">Learn More</a>
                    </div> <!-- /.card-section -->
                </div> <!-- /.card -->
            </div> <!-- /.cell -->
        </div>
    </div>
    <!-- / END BLOCK -->

    <!-- Image/Text (block) -->
    <!-- ================================================================== -->
    <div class="grid-container">
        <div class="block-image-text">
            <div class="block-image-text-img">
                <img src="https://images.unsplash.com/photo-1464823063530-08f10ed1a2dd?auto=format&fit=crop&w=500&q=50">
            </div> <!-- /.block-image-text-img -->

            <div class="block-image-text-content">
                <h4>HTML Experts.</h4>
                <p>It has an easy to override visual style, and is appropriately subdued.</p>
                <a href="#" class="button round">Learn More</a>
            </div> <!-- /.block-image-text-content -->
        </div> <!-- /.block-image-text -->

        <div class="block-image-text">
            <div class="block-image-text-content">
                <h4>HTML Experts.</h4>
                <p>It has an easy to override visual style, and is appropriately subdued.</p>
                <a href="#" class="button round">Learn More</a>
            </div> <!-- /.block-image-text-content -->

            <div class="block-image-text-img">
                <img src="https://images.unsplash.com/photo-1464823063530-08f10ed1a2dd?auto=format&fit=crop&w=500&q=50">
            </div> <!-- /.block-image-text-img -->
        </div> <!-- /.block-image-text -->
    </div> <!-- /.grid-container -->
    <!-- / END BLOCK -->

    <!-- 3 Column Cards (block) -->
    <!-- ================================================================== -->
    <div class="grid-container">
        <div class="grid-x grid-padding-x grid-padding-y">
            <div class="cell small-12 medium-4">
                <div class="card">
                    <img src="https://images.unsplash.com/photo-1464823063530-08f10ed1a2dd?auto=format&fit=crop&w=500&q=50">
                    <div class="card-section">
                        <h4>HTML Experts.</h4>
                        <p>It has an easy to override visual style, and is appropriately subdued.</p>
                        <a href="#" class="button">Learn More</a>
                    </div> <!-- /.card-section -->
                </div> <!-- /.card -->
            </div> <!-- /.cell -->

            <div class="cell small-12 medium-4">
                <div class="card">
                    <img src="https://images.unsplash.com/photo-1473800447596-01729482b8eb?auto=format&fit=crop&w=500&q=50">
                    <div class="card-section">
                        <h4>JS Guns.</h4>
                        <p>It has an easy to override visual style, and is appropriately subdued.</p>
                        <a href="#" class="button">Learn More</a>
                    </div> <!-- /.card-section -->
                </div> <!-- /.card -->
            </div> <!-- /.cell -->

            <div class="cell small-12 medium-4">
                <div class="card">
                    <img src="https://images.unsplash.com/photo-1494441822480-6bda707f0bd0?auto=format&fit=crop&w=500&q=50">
                    <div class="card-section">
                        <h4>PHP Runts.</h4>
                        <p>It has an easy to override visual style, and is appropriately subdued.</p>
                        <a href="#" class="button">Learn More</a>
                    </div> <!-- /.card-section -->
                </div> <!-- /.card -->
            </div> <!-- /.cell -->
        </div>
    </div>
    <!-- / END BLOCK -->

    <!-- 1 Column Content (block) -->
    <!-- ================================================================== -->
    <div class="grid-container">
        <div class="grid-x">
            <h1>Welcome</h1>
            <p>Vivamus luctus urna sed urna ultricies ac tempor dui sagittis. In condimentum facilisis porta. Sed nec diam eu diam mattis viverra. Nulla fringilla, orci ac euismod semper, magna.</p>
        </div>
    </div>

    <hr />
    <!-- / END BLOCK -->

    <!-- 2 Column Content (block) -->
    <!-- ================================================================== -->
    <div class="grid-container">
        <div class="grid-x grid-padding-x grid-padding-y">
            <div class="cell small-12 medium-6">
                <h3>Photoshop</h3>
                <p>Vivamus luctus urna sed urna ultricies ac tempor dui sagittis. In condimentum facilisis porta. Sed nec diam eu diam mattis viverra. Nulla fringilla, orci ac euismod semper, magna.</p>
            </div>

            <div class="cell small-12 medium-6">
                <h3>Javascript</h3>
                <p>Vivamus luctus urna sed urna ultricies ac tempor dui sagittis. In condimentum facilisis porta. Sed nec diam eu diam mattis viverra. Nulla fringilla, orci ac euismod semper, magna.</p>
            </div>
        </div>
    </div>

    <hr />
    <!-- / END BLOCK -->

    <!-- 3 Column Content (block) -->
    <!-- ================================================================== -->
    <div class="grid-container">
        <div class="grid-x grid-padding-x grid-padding-y">
            <div class="cell small-12 medium-4">
                <h3>Photoshop</h3>
                <p>Vivamus luctus urna sed urna ultricies ac tempor dui sagittis. In condimentum facilisis porta. Sed nec diam eu diam mattis viverra. Nulla fringilla, orci ac euismod semper, magna.</p>
            </div>

            <div class="cell small-12 medium-4">
                <h3>Javascript</h3>
                <p>Vivamus luctus urna sed urna ultricies ac tempor dui sagittis. In condimentum facilisis porta. Sed nec diam eu diam mattis viverra. Nulla fringilla, orci ac euismod semper, magna.</p>
            </div>

            <div class="cell small-12 medium-4">
                <h3>React</h3>
                <p>Vivamus luctus urna sed urna ultricies ac tempor dui sagittis. In condimentum facilisis porta. Sed nec diam eu diam mattis viverra. Nulla fringilla, orci ac euismod semper, magna.</p>
            </div>
        </div>
    </div>
    <!-- / END BLOCK -->
@endsection
