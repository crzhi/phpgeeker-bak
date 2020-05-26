@extends('blog::layouts.app')

@section('title', '404')

@section('content')
	<div id="page-content">
		<div class="container">
			<div class="box404">
				<div class="page404-title">
					<h4>404</h4>
					<h5>抱歉，没有你要找的页面...</h5>
				</div>
				<div class="buttons">
					<div class="pull2-left">
						<a title="返回首页" href="{{ route('blog') }}" class="btn btn-primary">返回首页</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="clearfix"></div>
@stop