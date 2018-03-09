@if ($collection)
    @php $posts = $collection @endphp

    @include('voyager-frontend::modules.posts.posts-grid')
@endif
