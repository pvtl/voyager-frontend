@extends('voyager-frontend::layouts.default')
@section('meta_title', $post->title)
@section('meta_description', $post->meta_description)

@section('content')
	<div class="grid-container">
			<div class="grid-x">
					<h1>{{ $post->title }}</h1>
					<img src="{{ Voyager::image( $post->image ) }}" style="width:100%">
					<p>{!! $post->body !!}</p>
			</div>
	</div>
@endsection