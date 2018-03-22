@extends('layout')

@section('content')
	<div class="title">{{ $post->title }}</div>
	<div class="body">{{ $post->body }}</div>
	<hr>
	<div style="margin-left:400px"><a href="/posts">Back to Catalog</a></div>
@endsection

@section('footer')
	@include('layouts.nav')
@endsection