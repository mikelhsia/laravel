<div>
	<div>
		<h3>
			<a href="/posts/{{ $post->id }}">{{ $post->title }}</a>
		</h3>
	</div>
	<div style="text-decoration: underline;">
		<span style='text-decoration: none; color: blue;'> {{ $post->user()['name'] }}</span>
		 on 
		<!-- Carbon Library - https://carbon.nesbot.com/docs/ -->
		{{ $post->created_at->toFormattedDateString() }}
	</div>
	<div class="body" style="font-size:1.5em;">
		{{ $post->body }}
	</div>
	<hr>
</div>