<div class="sidebar col-xs-12 col-sm-4 col-md-4">
	<div class="theiaStickySidebar">	   
		<div class="widget suxingme_post_author">
			<div class="authors_profile">
				<div class="avatar-panel">
					<a href="javascript:;" class="author_pic">
						<img src="{{ asset($set->admin_avatar) }}" class="avatar avatar-80 photo">
					</a>
				</div>	
				<div class="author_name">
					<a href="javascript:;">{{ $set->admin_name }}</a><span>站长</span>
				</div>
				<p class="author_dec">{{ $set->admin_slogan }}</p>
			</div>
		</div>
	    <div class="widget">
	        <h3><span>搜索</span></h3>
	        <form class="navbar-form" action="{{ route('blog.search') }}" method="get">
				<div class="input-group">
					<input type="text" name="keywords" class="form-control" placeholder="请输入关键字" maxlength="15">
					<span class="input-group-btn">
						<button class="btn btn-default btn-search" type="submit">搜索</button>
					</span>
				</div>
			</form>
	    </div>
	    <div class="widget suxingme_tag">
	        <h3><span>热门标签</span></h3>
	        <div class="widge_tags">
	            <div class="tag-items">
                    @if(count($tags))
                        @foreach($tags as $tag)
	                		<a href="{{ route('blog.tag', ['tag' => $tag->id]) }}" class="tag-item" title="{{ count($tag->articles) }}篇">{{ $tag->title }}</a>
                        @endforeach
                    @endif
                </div>
	        </div>
	    </div>
	    <div class="widget widget_suxingme_mostviews">
		    <h3><span>热门文章</span></h3>
		    @if(count($hotArticles))
			    <ul class="widget_suxingme_post side-hot">
			    	@foreach($hotArticles as $hotArticle)
				        <li>
							<a href="{{ route('blog.article', ['article' => $hotArticle->id]) }}" target="_blank" draggable="false">
								<span class="thumb">
									<img class="lazy thumbnail" data-original='{{ asset("$hotArticle->cover") }}' src='{{ asset("/modules/blog/images/cover.png") }}' alt="{{ $hotArticle->title }}" draggable="false">
								</span>
								<span class="text">{{ $hotArticle->title }}</span>
								<span class="muted"><i class="icon-calendar" aria-hidden="true"></i> {{ substr($hotArticle->created_at, 0, 10) }}</span>
								<span class="muted"><i class="icon-view" aria-hidden="true"></i> {{ $hotArticle->view }}</span>
							</a>
						</li>
					@endforeach
			    </ul>
			@endif
		</div>
	    <div class="widget widget_suxingme_comment">
	        <h3><span>最新评论</span></h3>
		    @if(count($newComments))
		        <ul class="w_comment">
		        	@foreach($newComments as $newComment)
			            <li>
			                <div class="message">
			                    <a href="{{ route('blog.article', ['article' => $newComment->article->id]) }}/#comment-{{ $newComment->id }}" class="comment_t">{{ $newComment->content }}</a>
			                </div>
			                <div class="clearfix meta">
			                    <div class="avatar">
			                        <img src='{{ asset($newComment->user->avatar) }}'>
			                    </div>
			                    <a href="{{ route('blog.article', ['article' => $newComment->article->id]) }}/#comment-{{ $newComment->id }}" class="link">{{ $newComment->user->nickname }} 评 {{ $newComment->article->title }}</a>
			                </div>
			            </li>
			        @endforeach
		        </ul>
	        @endif
	    </div>
	    <div class="widget widget_links">
	        <h3><span>友情链接</span></h3>
	        <ul class="xoxo blogroll">
				@if(count($topLinks))
					@foreach($topLinks as $link)
			            <li>
			            	<a href="{{ $link->url }}" target="_blank">
			            		<img src="{{ $link->ico }}" alt="favicon.ico" draggable="false">{{ $link->title }}
			            	</a>
			            </li>
		            @endforeach
	            @endif
	            <li><a href="{{ route('blog.links') }}"><i class="icon-link" aria-hidden="true"></i>查看全部</a></li>
	        </ul>
	    </div>
	    <div class="widget suxingme_social">
	        <h3><span>联系我</span></h3>
	        <div class="attentionus">
	            <ul class="items clearfix">
	                <span class="social-widget-link social-link-email">
	                    <span class="social-widget-link-count">
	                    	<i class="icon-email"></i>{{ $set->email }}
		                </span>
	                    <span class="social-widget-link-title">邮箱</span>
	                    <a href="mailto:{{ $set->email }}" target="_blank"></a>
	                </span>
	                <span class="social-widget-link social-link-github">
						<span class="social-widget-link-count">
							<i class="icon-github"></i>{{ $set->github_name }}
						</span>
						<span class="social-widget-link-title">github</span>
						<a href="{{ $set->github_url }}" target="_blank" rel="nofollow"></a>
					</span>
	                <span class="social-widget-link social-link-qq">
						<span class="social-widget-link-count">
							<i class="icon-qq"></i>{{ $set->qqgroup }}
						</span>
						<span class="social-widget-link-title">QQ群</span>
						<a href="{{ $set->qqgroup_url}}" target="_blank" rel="nofollow"></a>
					</span>
	                <span class="social-widget-link social-link-wechat">
	                    <span class="social-widget-link-count">
	                    	<i class="icon-wechat"></i>{{ $set->wechat }}
		                </span>
	                    <span class="social-widget-link-title">微信公众号</span>
	                    <a id="tooltip-s-weixin" href="javascript:void(0);"></a>
	                </span>
	            </ul>
	        </div>
	    </div>
	</div>
</div>