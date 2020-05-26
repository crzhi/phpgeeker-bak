@extends('mall::layouts.app')

@section('title', '我的收藏')

@section('content')
	<div class="layui-container house-usercol userpublic">
		<div class="layui-row layui-col-space20">
			<p class="layui-hide-xs title">首页 &gt;<span>个人中心</span></p>
			@include('mall::layouts.lib._userSider')
			<div class="layui-col-sm10">
				<div class="layui-tab layui-tab-brief">
					<ul class="layui-tab-title">
						<li class="layui-this">我的收藏</li>
					</ul>
					<div class="layui-tab-content layui-row layui-col-space30">
						@if(count($products))
							@foreach($products as $product)
								<div class="layui-col-xs3">
									<div class="goods">
										<a href="{{ route('mall.products.show', ['product' => $product->id])}}">
											<img src="{{ $product->image_url}}">
											<p>{{ $product->title}}</p>
										</a>
										<p class="price">￥{{ $product->price }}</p>
										<a class="del" data-href="{{ route('mall.products.favor', ['product'=>$product->id]) }}">&times;</a>
									</div>
								</div>
							@endforeach
						@endif
					</div>
					<div id="userList"></div>
				</div>
			</div>
		</div>
	</div>
@stop
