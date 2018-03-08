@if ($posts)
		<div class="vspace-2"></div>

		<div class="grid-container">
				<div class="cell small-12">
						<div class="grid-x grid-padding-x">
								@foreach($posts as $post)
										<div class="cell small-12 medium-4 large-3">
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
																@if ($post->excerpt)
																	<p>{{ str_limit($post->excerpt, 50, '&hellip;') }}</p>
																@endif
														</div> <!-- /.card-section -->
												</div> <!-- /.card -->
										</div> <!-- /.cell -->
								@endforeach
						</div> <!-- /.grid -->
				</div> <!-- /.cell -->
		</div> <!-- /.grid-container -->

		<div class="vspace-1"></div>
@endif