<li class="comment">
	<div id="comment-{{ $reComment->id }}" data-id="{{ $reComment->id }}">
		<div class="comment-avatar">
			<img alt="" src='{{ asset(Auth::user()->avatar) }}' class="avatar avatar-96 photo" height="96" width="96">
		</div>
		<div class="comment-body">
			<div class="comment_author">
				<span class="name">{{ Auth::user()->nickname }} 回复 {{ $respondUser->nickname }} :</span>
				<em>{{ $reComment->created_at }}</em>
			</div>
			<div class="comment-text"><p>{{ $reComment->content }}</p></div>
			<div class="comment_reply">         
				<a class="comment-reply-link" data-href="{{ route('blog.message.respond') }}" data-id="{{ $reComment['id'] }}" onclick="respond($(this))">回复</a>
			</div>
		</div>
	</div>
</li>