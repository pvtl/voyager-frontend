@extends('voyager-frontend::layouts.default')
@section('meta_title', 'Blog Posts')
@section('meta_description', 'Blog Posts')

@section('content')
	<div class="grid-container">
		<div class="grid-x grid-padding-x grid-padding-y">
			@foreach($posts as $post)
				<div class="cell small-6 medium-4">
					<a href="/posts/{{ $post->slug }}">
						<img src="{{ Voyager::image( $post->image ) }}" style="width:100%">
						<span>{{ $post->title }}</span>
					</a>
				</div>
			@endforeach
		</div>
	</div>
@endsection