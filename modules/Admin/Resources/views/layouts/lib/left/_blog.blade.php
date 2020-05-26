<ul class="layui-nav layui-nav-tree">
	<li class="layui-nav-item @if(Request::is('blog')) layui-nav-itemed @endif">
	    <a href="{{ route('admin.blog') }}" class="@if(Request::is('blog')) layui-this @endif">
	        <i class="layui-icon layui-icon-home"></i>
	        <cite>首页</cite>
	    </a>
	</li>
	<li class="layui-nav-item @if(Request::is('blog/article*')) layui-nav-itemed @endif">
	    <a href="{{ route('admin.blog.article') }}" class="@if(Request::is('blog/article*')) layui-this @endif">
	        <i class="layui-icon layui-icon-list"></i>
	        <cite>文章</cite>
	    </a>
	</li>
	<li class="layui-nav-item @if(Request::is('blog/category*')) layui-nav-itemed @endif">
	    <a href="{{ route('admin.blog.category') }}" class="@if(Request::is('blog/category*')) layui-this @endif">
	        <i class="layui-icon layui-icon-align-center"></i>
	        <cite>分类</cite>
	    </a>
	</li>
	<li class="layui-nav-item @if(Request::is('blog/tag*')) layui-nav-itemed @endif">
	    <a href="{{ route('admin.blog.tag') }}" class="@if(Request::is('blog/tag*')) layui-this @endif">
	        <i class="layui-icon layui-icon-note"></i>
	        <cite>标签</cite>
	    </a>
	</li>
	<li class="layui-nav-item @if(Request::is('blog/topic*')) layui-nav-itemed @endif">
	    <a href="{{ route('admin.blog.topic') }}" class="@if(Request::is('blog/topic*')) layui-this @endif">
	        <i class="layui-icon layui-icon-app"></i>
	        <cite>专题</cite>
	    </a>
	</li>
	<li class="layui-nav-item @if(Request::is('blog/comment*')) layui-nav-itemed @endif">
	    <a href="{{ route('admin.blog.comment') }}" class="@if(Request::is('blog/comment*')) layui-this @endif">
	        <i class="layui-icon layui-icon-dialogue"></i>
	        <cite>文章评论</cite>
	    </a>
	</li>
	<li class="layui-nav-item @if(Request::is('blog/message*')) layui-nav-itemed @endif">
	    <a href="{{ route('admin.blog.message') }}" class="@if(Request::is('blog/message*')) layui-this @endif">
	        <i class="layui-icon layui-icon-reply-fill"></i>
	        <cite>留言板</cite>
	    </a>
	</li>
	<li class="layui-nav-item @if(Request::is('blog/link*')) layui-nav-itemed @endif">
	    <a href="{{ route('admin.blog.link') }}" class="@if(Request::is('blog/link*')) layui-this @endif">
	        <i class="layui-icon layui-icon-link"></i>
	        <cite>友情链接</cite>
	    </a>
	</li>
	<li class="layui-nav-item @if(Request::is('blog/setting*')) layui-nav-itemed @endif">
	    <a href="{{ route('admin.blog.setting') }}" class="@if(Request::is('blog/setting*')) layui-this @endif">
	        <i class="layui-icon layui-icon-set"></i>
	        <cite>设置</cite>
	    </a>
	</li>
</ul>