@extends('layout')

@section('content')
<h3>Register</h3>
<form method="POST" action="/register">
	{{ csrf_field() }}
	<div class="mb-3">
		<label for="name">Name</label>
		<div>
			<input type="text" id="name" name="name" required>
			<!-- Client side (browser) validation -->
		</div>
	</div>
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
	<div class="mb-3">
		<label for="password_confirmation">Password Confirmation</label>
		<div>
			<input type="password" id="password_confirmation" name="password_confirmation" required>
		</div>
	</div>
	<hr>
	<button class="btn btn-primary" type="submit">Register</button>
	
	@include('layouts.errors')
</form>
@endsection

@section('footer')
	@include('layouts.nav')
@endsection