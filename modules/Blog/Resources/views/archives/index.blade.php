@extends('blog::layouts.app')

@section('title', '文章归档')

@section('content')
	<div class="page-single">
	    <div class="page-title" style="background-image:url({{ asset('/modules/blog/images/bg.jpg') }});">
	        <div class="container">
	            <h1 class="title">文章归档</h1>
	            <div class="page-dec"></div>
	        </div>
	    </div>
	    <div class="container">
	        <div class="page-content">
	        	@if(count($datas))
		            <div class="mod-archive">
		            	@foreach($datas as $data)
			                @if(count($data['articles']))
				                <div id="{{ $data['year'] }}" class="mod-archive-year">{{ $data['year'] }}</div>
				                <ul class="mod-archive-list">
				                	@foreach($data['articles'] as $article)
					                    <li>
					                        <time class="mod-archive-time">{{ substr($article->created_at, 5,5) }}</time>
					                        <span><i class="icon-view"></i> {{ $article->view }}</span>
					                        <a href="{{ route('blog.article', ['article' => $article->id]) }}" target="_blank">
					                        	@if($article->topic->id)【{{ $article->topic->title }}】@endif{{ $article->title }}
					                        </a>
					                    </li>
					            	@endforeach
				                </ul>
					        @endif
		                @endforeach
		            </div>
		        @endif
	        </div>
	        <div class="clear"></div>
	    </div>
	</div>
@stop