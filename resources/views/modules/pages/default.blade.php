@extends('voyager-frontend::layouts.default')
@section('meta_title', $page->title)
@section('meta_description', $page->meta_description)

@section('content')
	<div class="row">
		<div class="col-md-8 col-md-offset-2">

			<h1>{{ $page->title }}</h1>
			<img src="{{ Voyager::image( $page->image ) }}" style="width:100%">
			<p>{!! $page->body !!}</p>

		</div>
	</div>
@endsection
