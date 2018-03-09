@extends('voyager-frontend::layouts.default')
@section('meta_title', 'Search Results')
@section('meta_description', 'Search Results')
@section('page_title', 'Search Results')

@section('content')
    @include('voyager-frontend::partials.page-title')

    <div class="vspace-2"></div>

    <div class="grid-container">
        <div class="cell small-12">
            <div class="grid-x grid-padding-x">
                @php $noResultsCount = 0; @endphp

                @foreach($resultCollections as $key => $collection)
                    @if (count($collection) > 0)
                        @php $bladeName = $collection->name @endphp

                        <h4>{{ ucfirst($collection->name) }}</h4>

                        @include("voyager-frontend::modules.search.$bladeName")

                        @if (count($resultCollections) - 1 !== $key)
                            <hr />
                        @endif
                    @else
                        @php $noResultsCount += 1 @endphp
                    @endif
                @endforeach

                @if ($noResultsCount === count($resultCollections))
                    <p>No search results found.</p>
                @endif
            </div> <!-- /.grid -->
        </div> <!-- /.cell -->
    </div> <!-- /.grid-container -->
@endsection
