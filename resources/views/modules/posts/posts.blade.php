@extends('voyager-frontend::layouts.default')
@section('meta_title', 'Blog Posts')
@section('meta_description', 'Blog Posts')
@section('page_title', 'Blog Posts')

@section('content')
    @include('voyager-frontend::partials.page-title')

    <div class="vspace-2"></div>

    @if ($featuredPost)
        <div class="grid-container">
            <div class="grid-x grid-padding-x">
                <div class="cell small-12">
                    <div class="block-image-text">
                        @if (!empty($featuredPost->image))
                            <a href="{{ route('voyager-frontend.posts.post', ['slug' => $featuredPost->slug]) }}"
                               class="block-image-text-img"
                            >
                                <img src="{{ imageUrl($featuredPost->image, 585, 390) }}">
                            </a>
                        @endif

                        <div class="block-image-text-content">
                            @if (!empty($featuredPost->title))
                                <h4>{{ $featuredPost->title }}</h4>
                            @endif

                            @if (!empty($featuredPost->excerpt))
                                <p>{{ $featuredPost->excerpt }}</p>
                            @endif

                            <a href="{{ route('voyager-frontend.posts.post', ['slug' => $featuredPost->slug]) }}"
                               class="button round"
                            >
                                Read Post
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @include('voyager-frontend::modules.posts.posts-grid')
@endsection
