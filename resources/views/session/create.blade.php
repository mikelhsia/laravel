@extends('layout')

@section('content')
<h3>Sign in</h3>
<form method="POST" action="/login">
	{{ csrf_field() }}
	<div class="mb-3">
		<label for="email">Email</label>
		<div>
			<input type="email" id="email" name="email" required>
		</div>
	</div>
	<div class="mb-3">
		<label for="password">Password</label>
		<div>
			<input type="password" id="password" name="password" required>
		</div>
	</div>
	<hr>
	<button class="btn btn-primary" type="submit">Sign in</button>
	
	@include('layouts.errors')
</form>
@endsection

@section('footer')
	@include('layouts.nav')
@endsection