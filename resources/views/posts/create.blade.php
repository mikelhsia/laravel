@extends('layout')

@section('content')
<h3>Create a Post</h3>
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
@endsection

@section('footer')
	@include('layouts.nav')
@endsection