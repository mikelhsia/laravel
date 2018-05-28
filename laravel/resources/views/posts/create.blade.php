@extends('layout')

@section('content')
<h3>Create a Post</h3>
<div style="display: grid; grid-template-columns: 70% 30%;">
	<div>
		<form method="POST" action="/posts">
			{{ csrf_field() }}
			<div class="form-group">
				<label for="title">Title</label>
				<div>
					<input type="text" id="title" name="title" required>
					<!-- Client side (browser) validation -->
				</div>
			</div>
			<div class="mb-3">
				<label for="body">Body</label>
				<div>
					<textarea id="body" name="body" required></textarea>
				</div>
			</div>
			<hr class="mb-4">
			<button class="btn btn-primary" type="submit">Publish</button>
		@include('layouts.errors')
		</form>
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
	@include('layouts.nav')
@endsection