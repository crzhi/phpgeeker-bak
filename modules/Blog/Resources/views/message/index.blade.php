@extends('blog::layouts.app')

@section('title', '留言板')

@section('content')
	<div id="page-content">
	    <div class="container">
	        <div class="row">
	            <div class="article  col-xs-12 col-sm-12 col-md-12">
	                <div class="post page">
	                    <div class="post-title">
	                        <h1 class="title">留言板</h1></div>
	                    <div class="post-content">
	                        <div class="item-intro-content">
	                            <p>期待你的评论</p>
	                            <div class="clearfix"></div>
	                        </div>
	                    </div>
	                </div>
	                <div class="clearfix"></div>
	                <div id="comments" class="clearfix">
	                    <div id="respond" class="respond-box">
	                        <h3 class="comments-title">发表评论</h3>
	                        <form action="{{ route('blog.message.comment') }}" method="post" id="commentform">
	                            <div class="comment-from-main clearfix">
	                                <div class="comment-form-textarea">
	                                    <div class="comment-textarea-box">
	                                        <textarea class="comment-textarea" name="content" placeholder="说点什么吧..."></textarea>
	                                        @guest
	                                        	<div id="comment_message">请登录以评论</div>
	                                        @endguest
	                                    </div>
	                                </div>
	                                <div class="form-submit">
	                                    <input class="btn-comment pull-right" type="submit" value="发表评论">
	                                </div>
	                            </div>
	                        </form>
	                    </div>
	                    <div class="comments-box">
	                        <h3 class="comments-title">全部留言：</h3>
	                        <div id="loading-comments"><span><i class="icon-spin6 animate-spin"></i>加载中...</span></div>
	                        <ol class="commentlist">
	                        	@if(count($comments))
		                        	@foreach($comments as $comment)
			                            <li class="comment">
			                                <div id="comment-{{ $comment['id'] }}" data-id="{{ $comment['id'] }}">
			                                    <div class="comment-avatar">
			                                    	<img alt='user.png' src='{{ asset($comment["avatar"]) }}' class='avatar avatar-96 photo'/>
			                                    </div>
			                                    <div class="comment-body">
			                                        <div class="comment_author">
			                                        	<span class="name">{{ $comment['nickname'] }}</span>
			                                        	<em>{{ $comment['created_at'] }}</em>
			                                        </div>
			                                        <div class="comment-text"><p>{{ $comment['content'] }}</p></div>
			                                        <div class="comment_reply">
			                                        	<a class='comment-reply-link' data-href="{{ route('blog.message.respond') }}" data-id="{{ $comment['id'] }}" onclick="respond($(this))">回复</a>
			                                        </div>
			                                    </div>
			                                </div>
											<ul class="children">
			                                	@if(count($comment['reComments']))
													@foreach($comment['reComments'] as $reComment)
														<li class="comment">
															<div id="comment-{{ $reComment['id'] }}" data-id="{{ $reComment['id'] }}">
																<div class="comment-avatar">
																	<img alt="" src='{{ asset($reComment["avatar"]) }}' class="avatar avatar-96 photo" height="96" width="96">
																</div>
																<div class="comment-body">
																	<div class="comment_author">
																		<span class="name">{{ $reComment['nickname'] }} 回复 {{ $reComment['reply_name'] }} :</span>
																		<em>{{ $reComment['created_at'] }}</em>
																	</div>
																	<div class="comment-text"><p>{{ $reComment['content'] }}</p></div>
																	<div class="comment_reply">         
																		<a class="comment-reply-link" data-href="{{ route('blog.message.respond') }}" data-id="{{ $reComment['id'] }}" onclick="respond($(this))">回复</a>
																	</div>
																</div>
															</div>
														</li>
													@endforeach
			                                	@endif
											</ul>
			                            </li>
			                        @endforeach
	                       		@endif
	                        </ol>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
@stop

@section('script')
	<script src="{{ asset('/static/layer/layer.js') }}"></script>
    <script src="{{ asset('/static/jquery/jquery.form.min.js') }}"></script>
    <script type="text/javascript">
	    $.ajaxSetup({
	        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
	    });
	    /*
	    -------------------------
	    提交评论
	    -------------------------
	    */
	    $('#commentform').ajaxForm(function(data) {
	        if(typeof(data) == 'object') {
	            layer.msg(data.message);
	            return false;
	        }
	        layer.msg('评论成功');
	        $('.comment-textarea').val('');
	        $('.commentlist').prepend(data);
	    });
    </script>
@stop