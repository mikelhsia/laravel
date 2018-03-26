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

	{{-- A section to add a comment --}}
	<hr>
	<div class="card" style="border:1px solid grey; border-radius: 3px;">
		<form method="POST" action="/posts/{{ $post->id }}/comments">
			{{ csrf_field() }}
			<div>
				<textarea name='body' id='body' placeholder="Place your comment here" required></textarea>
			</div>
			<div>
				<button type="submit">Add Comment</button>
			</div>
		</form>
		@include('layouts.errors')
	</div>
@endsection

@section('footer')
	@include('layouts.nav')
@endsection