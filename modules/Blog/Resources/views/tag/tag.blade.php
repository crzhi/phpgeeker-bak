@extends('blog::layouts.app')

@section('title', $tag->title . ' - ' . '标签')

@section('content')
    <div id="page-content">
	    <div class="container">
	        <div class="row">
	            <div class="article col-xs-12 col-sm-8 col-md-8">
	                <div class="breadcrumbs">
	                    <span>
	                        <a href="{{ route('blog')}}" class="home"><span><i class="icon-location"></i> 首页</span></a>
	                    </span>
	                    <span class="sep">›</span>
	                    <span class="current">
	                        <a href="{{ route('blog.tags') }}" class="home">标签</a>
	                    </span>
	                    <span class="sep">›</span>
	                    <span class="current">{{ $tag->title }}</span>
	                </div>
	                <div class="ajax-load-box posts-con">
						@include('blog::layouts.lib._article')	
	                </div>
	                <div class="clearfix"></div>
                    <div class="pagination-content wow fadeInUp">
                    	{{ $articles->links() }}
                    </div>
	            </div>
	            @include('blog::layouts.lib._sider')	
	        </div>
	    </div>
	</div>
@stop