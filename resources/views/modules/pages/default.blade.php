@extends('voyager-frontend::layouts.default')
@section('meta_title', $page->title)
@section('meta_description', $page->meta_description)

@section('content')
    <!-- Intro (block) -->
    <!-- ================================================================== -->
    <div class="callout large">
        <div class="grid-container column text-center">
            <h1>Changing the World Through Design</h1>
            <p class="lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in dui mauris.</p>
            <a href="#" class="button large">Learn More</a>
            <a href="#" class="button large hollow">Learn Less</a>
        </div>
    </div>
    <!-- / END BLOCK -->

    <!-- 1 Column Content (block) -->
    <!-- ================================================================== -->
    <div class="grid-container">
        <div class="grid-x">
            <h1>{{ $page->title }}</h1>
            <img src="{{ Voyager::image( $page->image ) }}" style="width:100%">
            <p>{!! $page->body !!}</p>
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
