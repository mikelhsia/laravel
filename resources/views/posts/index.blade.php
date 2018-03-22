@extends('layout')

@section('content')
	<div class='title'>This is the layout content header</div>
	<hr>
	@foreach ($posts as $post)
		@include('posts.post')
	@endforeach
@endsection

@section('footer')
	<script src='/js/file.js'></script>	
	@include('layouts.nav')
@endsection