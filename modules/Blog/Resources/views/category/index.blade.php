@extends('blog::layouts.app')

@section('title', '分类')

@section('content')
	<div class="page-single">
	    <div class="page-title" style="background-image:url({{ asset('/modules/blog/images/bg.jpg') }});">
	        <div class="container">
	            <h1 class="title">分类</h1>
	            <div class="page-dec"></div>
	        </div>
	    </div>
	    <div class="container">
	    	<div class="page-content">
		        <div class="topic-list row">
	                @if(count($categories))
	                	@foreach($categories as $category)
				            <div class="topic-tag col-xs-12 col-sm-4 col-md-3">
				                <div class="item" style='background-image: url({{ asset("$category->image") }});'>
				                    <a href="{{ route('blog.category', ['category' => $category->id]) }}">
				                        <div class="category overlay"></div>
				                        <div class="title">
				                            <h2>{{ $category->description }}</h2>
				                            <div class="meta">{{ count($category->articles) }}篇文章</div>
				                        </div>
				                        <div class="tag"><span>#{{ $category->title }}</span></div>
				                    </a>
				                </div>
				            </div>
			            @endforeach
			        @endif
		        </div>
		    </div>
	    </div>
	</div>
@stop