<li class="comment">
    <div id="comment-{{ $comment->id }}" data-id="{{ $comment->id }}">
        <div class="comment-avatar">
        	<img alt="user.png" src='{{ asset($comment->user->avatar) }}' class="avatar avatar-96 photo">
        </div>
        <div class="comment-body">
            <div class="comment_author">
            	<span class="name">{{ $comment->user->nickname }}</span><em>{{ $comment->created_at }}</em>
            </div>
            <div class="comment-text"><p>{{ $comment->content }}</p></div>
            <div class="comment_reply">
            	<a class="comment-reply-link" data-href="{{ route('blog.message.respond') }}" data-id="{{ $comment['id'] }}" onclick="respond($(this))">回复</a>
            </div>
        </div>
    </div>
    <ul class="children"></ul>
</li>