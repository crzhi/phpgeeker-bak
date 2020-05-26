@extends('blog::layouts.app')

@section('title', '友情链接')

@section('content')
	<div class="page-single">
	    <div class="page-title" style="background-image:url({{ asset('/modules/blog/images/bg.jpg') }});">
	        <div class="container">
	            <h1 class="title">友情链接</h1>
	            <div class="page-dec"></div>
	        </div>
	    </div>
	    <div class="container">
	        <div class="page-content">
	        	@if(count($links))
		            <ul class="link-items fontSmooth">
		            	@foreach($links as $link)
			                <li class="link-item">
			                    <a class="link-item-inner effect-apollo" href="{{ $link->url }}" title="{{ $link->title }}" target="_blank">
			                        <img alt="favicon.ico" src="{{ $link->ico }}">
			                        <span class="sitename">{{ $link->title }}</span>
			                    </a>
			                </li>
		                @endforeach
		            </ul>
	            @endif
	            <div class="clearfix"></div>
	        </div>
	        <div class="clear"></div>
	    </div>
	</div>
@stop