@extends('blog::layouts.app')

@section('title', $article->title)

@section('style')
	<link rel="stylesheet" type="text/css" href='{{ asset("/modules/blog/css/prism.min.css") }}'>
@stop

@section('content')
	<div id="page-content">
	    <div class="container">
	        <div class="row">
	            <div class="article col-xs-12 col-sm-8 col-md-8">
	                <div class="post">
	                    <div class="post-title">
	                        <div class="breadcrumbs">
	                            <span><a href="{{ route('blog') }}" class="home"><span><i class="icon-location"></i> 首页</span></a></span>
	                            <span class="sep">›</span>
	                            <span>
	                                <a href="{{ route('blog.category', ['category' => $article->category->id]) }}">
	                                	<span>{{ $article->category->title }}</span>
	                                </a>
	                            </span>
	                            <span class="sep">›</span>
	                            <span class="current">正文</span>
	                        </div>
                            <div class="post-entry-categories">
                            	@if(count($article->tags))
	                            	@foreach($article->tags as $tag)
	                            		<a href="{{ route('blog.tag', ['tag' => $tag->id]) }}">{{ $tag->title }}</a>
	                            	@endforeach
                            	@endif
                            </div>
                        	<h1 class="title">@if($article->topic->id)【{{ $article->topic->title }}】@endif{{ $article->title }}</h1>
                        	<div class="post_icon">
	                            <span class="postcat">
	                            	<i class="icon-category"></i>
	                            	<a href="{{ route('blog.category', ['category' => $article->category->id]) }}"> {{ $article->category->title }}</a>
	                            </span>
	                            <span class="postclock"><i class="icon-calendar"></i> {{ substr($article->created_at, 0, 10) }}</span>
	                            <span class="posteye"><i class="icon-view"></i> {{ $article->view }}</span>
	                            <span class="postcomment"><i class="icon-comments"></i> {{ $article->comment }}</span>
	                        </div>
	                    </div>
	                    <div class="post-content">{!! $article->html !!}</div>
	                    <div class="clearfix"></div>
	                    <div class="post-options"></div>
	                    <div class="next-prev-posts clearfix">
	                		@if($prevArticle)
		                        <div class="prev-post">
		                            <a href="{{ route('blog.article', ['article' => $prevArticle->id]) }}" class="prev has-background" style=' background-image: url({{ asset("$prevArticle->cover") }})' alt="{{ $prevArticle->title }}">
		                                <span>上一篇</span>
		                                <h4>{{ $prevArticle->title }}</h4>
		                            </a>
		                        </div>
		                    @else
		                        <div class="prev-post">
		                            <a href="JavaScript:;" class="prev has-background">
		                                <span>上一篇</span>
		                                <h4>没有了</h4>
		                            </a>
		                        </div>
		                    @endif
	                		@if($nextArticle)
		                        <div class="next-post">
		                            <a href="{{ route('blog.article', ['article' => $nextArticle->id]) }}" class="next has-background" style=' background-image: url({{ asset("$nextArticle->cover") }})' alt="{{ $nextArticle->title }}">
		                                <span>下一篇</span>
		                                <h4>{{ $nextArticle->title }}</h4>
		                            </a>
		                        </div>
		                    @else
		                        <div class="next-post">
		                            <a href="JavaScript:;" class="next has-background">
		                                <span>下一篇</span>
		                                <h4>没有了</h4>
		                            </a>
		                        </div>
							@endif
	                    </div>
	                </div>
	                <div class="clear"></div>
	                <div id="comments" class="clearfix">
	                    <div id="respond" class="respond-box">
	                        <h3 class="comments-title">发表评论</h3>
	                        <form action="{{ route('blog.article.comment', ['article'=>$article->id]) }}" method="post" id="commentform">
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
	                        <h3 class="comments-title">全部评论：<span class="comments-num">{{ $article->comment }}条</span></h3>
	                        <div id="loading-comments"><i class="icon-spin6 animate-spin"></i>加载中...</div>
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
			                                        	<a class='comment-reply-link' data-href="{{ route('blog.article.respond', ['article' => $article->id]) }}" data-id="{{ $comment['id'] }}" onclick="respond($(this))">回复</a>
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
																		<a class="comment-reply-link" data-href="{{ route('blog.article.respond', ['article' => $article->id]) }}" data-id="{{ $reComment['id'] }}" onclick="respond($(this))">回复</a>
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
	            @include('blog::layouts.lib._sider')
	        </div>
	    </div>
	</div>
@stop

@section('script')
	<script src="{{ asset('/modules/blog/js/prism.js') }}"></script>
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