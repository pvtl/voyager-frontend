@extends('voyagerfrontend::layouts.default')
@section('meta_title', 'Blog Posts')
@section('meta_description', 'Blog Posts')

@section('content')
	<div class="row">
		@foreach($posts as $post)
			<div class="col-md-3">
				<a href="/posts/{{ $post->slug }}">
					<img src="{{ Voyager::image( $post->image ) }}" style="width:100%">
					<span>{{ $post->title }}</span>
				</a>
			</div>
		@endforeach
	</div>
@endsection