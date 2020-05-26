@extends('blog::layouts.app')

@section('title', '搜索 "' . $keywords . '"')

@section('content')
    <div id="page-content">
	    <div class="container">
	        <div class="row">
	            <div class="article col-xs-12 col-sm-8 col-md-8">
	                <div class="breadcrumbs">
	                    <span>
	                        <a href="{{ route('blog') }}" class="home"><span><i class="icon-location"></i> 首页</span></a>
	                    </span>
	                    <span class="sep">›</span>
	                    <span class="current">搜索关键词 '{{ $keywords }}', 共 {{ $number }} 篇</span>
	                </div>
	                <div class="ajax-load-box posts-con">
						@include('blog::layouts.lib._article')	
	                </div>
	                <div class="clearfix"></div>
	                <div id="ajax-load-posts"></div>
	            </div>
	            @include('blog::layouts.lib._sider')	
	        </div>
	    </div>
	</div>
@stop