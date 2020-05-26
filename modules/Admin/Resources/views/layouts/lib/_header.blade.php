
	<ul class="layui-nav layui-layout-left">
		<li class="layui-nav-item layadmin-flexible" lay-unselect="">
			<a href="javascript:;" layadmin-event="flexible" title="侧边伸缩">
				<i class="layui-icon layui-icon-shrink-right" id="LAY_app_flexible"></i>
			</a>
		</li>
		<!-- <li class="layui-nav-item">
			<a href="http://www.layui.com/admin/">
				<i class="layui-icon layui-icon-website"></i> WWW
			</a>
		</li> -->
		<li class="layui-nav-item @if(Request::is('blog*')) layui-this @endif">
			<a href="{{ route('admin.blog') }}"><i class="layui-icon layui-icon-list"></i> BLOG</a>
		</li>
		<li class="layui-nav-item @if(Request::is('wechat*')) layui-this @endif">
			<a href="{{ route('admin.wechat') }}"><i class="layui-icon layui-icon-login-wechat"></i> WeChat</a>
		</li>
	</ul>
	<ul class="layui-nav layui-layout-right">
		<li class="layui-nav-item layui-hide-xs">
			<a href="javascript:;" layadmin-event="note">
				<i class="layui-icon layui-icon-note"></i>
			</a>
		</li>
		<li class="layui-nav-item layui-hide-xs">
			<a href="javascript:;" layadmin-event="fullscreen">
				<i class="layui-icon layui-icon-screen-full"></i>
			</a>
		</li>
		<li class="layui-nav-item">
			<a href="javascript:;">
				<cite>{{ Auth::guard('admin')->user()->username }}</cite>
				<span class="layui-nav-more"></span>
			</a>
			<dl class="layui-nav-child">
				<dd><a href="javascript:;">基本资料</a></dd>
				<dd><a href="javascript:;">修改密码</a></dd>
				<hr>
				<dd><a href="{{ route('admin.logout') }}">退出账号</a></dd>
			</dl>
		</li>
		<li class="layui-nav-item">
			<a href="{{ route('admin.info') }}" target="_blank"><i class="layui-icon layui-icon-more-vertical"></i></a>
		</li>
	</ul>