@extends('blog::layouts.app')

@section('title', $thisCategory->title . ' - ' . '分类')

@section('content')
	<div id="page-content" class="page-content-110">
	    <div class="main-content">
	        <div class="container">
	            <div class="row">
	                <div class="article col-xs-12 col-sm-8 col-md-8">
	                    <div class="post-nav">
                			<a href="{{ route('blog') }}"><span class="new-post">最新</span></a>
	                        @if(count($categories))
                                @foreach($categories as $category)
                        			<a href="{{ route('blog.category', ['category' => $category->id]) }}">
                        				<span class="cat-post @if($category->id == $thisCategory['id']) current @endif">{{ $category->title }}</span>
                        			</a>
                                @endforeach
	                        @endif
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
	</div>
@stop