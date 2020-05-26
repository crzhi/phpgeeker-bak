@extends('blog::layouts.app')

@section('title', '标签')

@section('content')
	<div class="page-single">
	    <div class="page-title" style="background-image:url({{ asset('/modules/blog/images/bg.jpg') }});">
	        <div class="container">
	            <h1 class="title">标签</h1>
	            <div class="page-dec"></div>
	        </div>
	    </div>
	    <div class="container">
	        <div class="page-content">
	        	@if(count($tags))
		            <ul class="tag-clouds clearfix">
		            	@foreach($tags as $tag)
			                <li>
			                    <a class="tagname" href="{{ route('blog.tag', ['tag' => $tag->id]) }}">{{ $tag->title }}</a>
			                    <strong class="qwer" data-tag="{{ $tag->id}}">
			                    	<span>x {{ count($tag->articles) }}篇</span>
			                    </strong><br>
			                </li>
		                @endforeach
		            </ul>
		        @endif
	        </div>
	    </div>
	</div>
@stop