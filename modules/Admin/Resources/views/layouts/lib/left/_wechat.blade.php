<ul class="layui-nav layui-nav-tree">
	<li class="layui-nav-item @if(Request::is('wechat')) layui-nav-itemed @endif">
	    <a href="{{ route('admin.wechat') }}" class="@if(Request::is('wechat')) layui-this @endif">
	        <i class="layui-icon layui-icon-home"></i>
	        <cite>首页</cite>
	    </a>
	</li>
	<li class="layui-nav-item @if(Request::is('wechat/menu*')) layui-nav-itemed @endif">
	    <a href="{{ route('admin.wechat.menu') }}" class="@if(Request::is('wechat/menu*')) layui-this @endif">
	        <i class="layui-icon layui-icon-list"></i>
	        <cite>菜单</cite>
	    </a>
	</li>
</ul>