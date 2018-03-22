@extends('layout')

@section('content')
	<div class="title">{{ $post->title }}</div>
	<div class="body">{{ $post->body }}</div>
	<hr>
	<div class="comment">
		<ul>
			@foreach ($post->comments as $comment)
				<li style="width:100%; border:1px solid grey; list-style-type:none;">
					<article>
						<strong>{{ $comment->created_at->diffForHumans()}}</strong> <br>
						{{ $comment->body }}
					</article>
				</li>
			@endforeach
		</ul>
	</div>
	<br>
	<div style="margin-left:400px"><a href="/posts">Back to Catalog</a></div>
@endsection

@section('footer')
	@include('layouts.nav')
@endsection