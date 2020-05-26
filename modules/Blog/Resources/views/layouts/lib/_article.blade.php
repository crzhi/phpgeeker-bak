@if(count($articles))
    @foreach($articles as $key => $article)
        <div class="ajax-load-con content wow fadeInUp">
            <div class="content-box posts-gallery-box">
                <div class="posts-gallery-img">
                    <a href="{{ route('blog.article', ['article' => $article->id]) }}" title="{{ $article->title }}" target="_blank">
                        <img class="lazy thumbnail" data-original='{{ asset("$article->cover") }}' src='{{ asset("/modules/blog/images/cover.png") }}'/>
                    </a>
                </div>
                <div class="posts-gallery-content">
                    @if(count($article->tags))
                    	<div class="post-entry-categories">
                            @foreach($article->tags as $key => $tag)
                        		<a href="{{ route('blog.tag', ['tag' => $tag->id]) }}">{{ $tag->title }}</a>
                            @endforeach
                    	</div>
                    @endif
                    <h2>
                        <a href="{{ route('blog.article', ['article' => $article->id]) }}" target="_blank">
                            @if($article->topic->id)【{{ $article->topic->title }}】@endif{{ $article->title }}
                        </a>
                    </h2>
                    <div class="posts-gallery-text">{!! $article->description !!}&hellip;</div>
                    <div class="posts-default-info posts-gallery-info">
                        <ul>
                            <li class="icon-category">
                                <a href="{{ route('blog.category', ['category' => $article->category->id]) }}">{{ $article->category->title }}</a>
                            </li>
                            <li class="icon-calendar">
                                {{ substr($article->created_at, 0, 10) }}
                            </li>
                            <li class="icon-view hidden-xs hidden-sm">
                                {{ $article->view }}
                            </li>
                            <li class="icon-comments hidden-xs hidden-sm">
                                {{ $article->comment }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endif