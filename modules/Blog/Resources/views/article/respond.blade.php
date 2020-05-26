<div id="respond" class="respond-box respondComment-box">
	<h3 class="comments-title">发表评论
		<span id="cancel-comment-reply"><a onclick="cancelRespond()">取消回复</a></span>
	</h3>
	<form action="{{ route('blog.article.recomment', ['article'=>$article->id]) }}" method="post" id="commentform" class="respondform">
		<div class="comment-from-main clearfix">
			<div class="comment-form-textarea">
				<div class="comment-textarea-box">
					<textarea class="comment-textarea" name="comment" id="comment" placeholder="回复 {{ $respondUser->nickname }}："></textarea>
				</div>
			</div>
			<div class="form-submit">
				<input type="hidden" name="pid" value="{{ $respondId }}">
				<input type="hidden" name="respondUserId" value="{{ $respondUser->id }}">
				<input class="btn-comment pull-right" type="submit" value="发表评论" onclick="respondComment(event @if($respondType), true @endif)">
			</div>
		</div>
	</form>
</div>