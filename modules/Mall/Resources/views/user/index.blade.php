@extends('mall::layouts.app')

@section('title', '个人中心')

@section('content')
	<div class="layui-container userpublic house-userPer">
		<div class="layui-row layui-col-space20">
			<p class="layui-hide-xs title">首页 &gt;<span>个人中心</span></p>
			@include('mall::layouts.lib._userSider')
			<div class="layui-col-sm10">
				<div class="user-person">
					<div class="person">
						<img src="{{ Auth::user()->avatar}}">
						<div class="name">
							<p>{{ Auth::user()->email}}</p>
							<!-- <span><i>VIP2</i></span> -->
						</div>
					</div>
<!-- 					<ul>
						<li>优惠券<span>10张</span></li>
						<li>礼品卡<span>1张</span></li>
						<li>积分<span>1000</span></li>
						<li>待发货<span>12个</span></li>
						<li>待收货<span>2个</span></li>
						<li>待评价<span>2个</span></li>
					</ul> -->
				</div>
			</div>
		</div>
	</div>
@stop
