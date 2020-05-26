@extends('blog::layouts.app')

@section('title', '专题')

@section('content')
	<div class="page-single">
	    <div class="page-title" style="background-image:url({{ asset('/modules/blog/images/bg.jpg') }});">
	        <div class="container">
	            <h1 class="title">专题</h1>
	            <div class="page-dec"></div>
	        </div>
	    </div>
	    <div class="container">
	    	<div class="page-content">
		        <div class="topic-list row">
		        	@if(count($topics))
			        <div class="suxingme_topic">
						<ul class="widget_suxingme_topic">
							@foreach($topics as $topic)
								<li class="col-xs-12 col-sm-4 col-md-4">
									<a href="{{ route('blog.topic', ['topic'=>$topic->id]) }}" title="{{ $topic->title }}">
										<div class="overlay"></div>
										<div class="image" style='background-image: url({{ asset("$topic->image") }});'></div>
										<div class="title">
											<h4>{{ $topic->title }}</h4>
											<div class="meta">
												<span>查看专题</span>
											</div>
										</div>
									</a>
								</li>
							@endforeach
						</ul>
					</div>
					@endif
		        </div>
		    </div>
	    </div>
	</div>
@stop