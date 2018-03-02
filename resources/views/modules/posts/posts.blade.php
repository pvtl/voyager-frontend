@extends('voyager-frontend::layouts.default')
@section('meta_title', 'Blog Posts')
@section('meta_description', 'Blog Posts')
@section('page_title', 'Blog Posts')

@section('content')
		@include('voyager-frontend::partials.page-title')

		<div class="vspace-2"></div>

		<div class="grid-container">
				<div class="cell small-12">
						<div class="grid-x grid-padding-x">
								@foreach($posts as $post)
										<div class="cell small-12 medium-4">
												<div class="card">
														<a href="/posts/{{ $post->slug }}">
																<img src="{{ Voyager::image( $post->image ) }}" style="width:100%">
														</a>
														<div class="card-section">
																<span class="label secondary">
																		{{ $post->created_at->format('M. jS Y') }}
																</span>
																<a href="/posts/{{ $post->slug }}">
																		<h4>{{ $post->title }}</h4>
																</a>
														</div> <!-- /.card-section -->
												</div> <!-- /.card -->
										</div> <!-- /.cell -->
								@endforeach
						</div> <!-- /.grid -->
				</div> <!-- /.cell -->
		</div> <!-- /.grid-container -->

		<div class="vspace-1"></div>
@endsection