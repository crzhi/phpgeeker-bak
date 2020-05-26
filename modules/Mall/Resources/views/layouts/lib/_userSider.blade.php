<div class="layui-col-sm2">
	<ul class="user-list">
		<li @if(Request::is('user')) class="active" @endif><a href="{{ route('mall.user') }}">个人中心</a></li>
		<li @if(Request::is('user/orders*')) class="active" @endif><a href="{{ route('mall.user.orders') }}">订单管理</a></li>
		<li @if(Request::is('user/address*')) class="active" @endif><a href="{{ route('mall.user.address') }}">地址管理</a></li>
		<li @if(Request::is('user/favorite*')) class="active" @endif><a href="{{ route('mall.user.favorite') }}">我的收藏</a></li>
		<!-- <li @if(Request::is('user/ticket*')) class="active" @endif><a href="/user/ticket">优惠券</a></li> -->
		<!-- <li @if(Request::is('user/service*')) class="active" @endif><a href="/user/service">服务中心</a></li> -->
	</ul>
</div>
