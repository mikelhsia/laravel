@extends('layout')

@section('content')
	<div class='title'>This is the layout content header</div>
	<hr>
	<div style="display: grid; grid-template-columns: 70% 30%;">
		<div>
			<h4>Posts</h4>
			@foreach ($posts as $post)
				@include('posts.post')
			@endforeach
		</div>
		<div>
			<h4>Archives</h4>
			<ul>
				@foreach ($archives as $archive)
					{{-- expr --}}
					<li>
						{{ $archive['year'] }}-{{ $archive['month'] }} (<a href="/posts?month={{ $archive['month'] }}&year={{ $archive['year'] }}">{{ $archive['published'] }}</a>)
					</li>
				@endforeach
			</ul>
			<h4>Tags</h4>
			<ul>
				@foreach ($tags as $tag)
					{{-- expr --}}
					<li>
						<a href="/posts/tag/{{ $tag }}"> {{ $tag }}</a>
					</li>
				@endforeach
			</ul>
		</div>
	</div>
@endsection

@section('footer')
	<script src='/js/file.js'></script>	
	@include('layouts.nav')
@endsection