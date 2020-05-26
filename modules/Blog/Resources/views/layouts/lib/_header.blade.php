<div id="header" class="navbar-fixed-top">
    <div class="container">
        <h1 class="logo"><a href="{{ route('blog') }}"><img src="{{ asset($set->logo) }}"></a></h1>
        <div role="navigation" class="site-nav  primary-menu">
            <div class="menu-fix-box">
                <ul id="menu-navigation" class="menu">
                    <li class="@if(Request::is('/*')) current-menu-item @endif"><a href="{{ route('blog') }}">首页</a></li>
                    <li class="menu-item-has-children @if(Request::is('category*')) current-menu-item @endif">
                        <a href="{{ route('blog.categories') }}">分类</a>
                        @if(count($categories))
                            <ul class="sub-menu">
                                @foreach($categories as $category)
                                    <li><a href="{{ route('blog.category', ['category' => $category->id]) }}">{{ $category->title }}</a></li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                    <li class="menu-item-has-children @if(Request::is('tag*')) current-menu-item @endif">
                        <a href="{{ route('blog.tags') }}">标签</a>
                        @if(count($tags))
                            <ul class="sub-menu">
                                @foreach($tags as $tag)
                                    <li><a href="{{ route('blog.tag', ['tag' => $tag->id]) }}">{{ $tag->title }}</a></li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                    <li class="menu-item-has-children @if(Request::is('topic*')) current-menu-item @endif">
                        <a href="{{ route('blog.topics') }}">专题</a>
                        @if(count($topics))
                            <ul class="sub-menu">
                                @foreach($topics as $topic)
                                    <li><a href="{{ route('blog.topic', ['topic' => $topic->id]) }}">{{ $topic->title }}</a></li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                    <li class="@if(Request::is('links*')) current-menu-item @endif"><a href="{{ route('blog.links') }}">友情链接</a></li>
                    <li class="@if(Request::is('archives*')) current-menu-item @endif"><a href="{{ route('blog.archives') }}">文章归档</a></li>
                    <li class="@if(Request::is('message*')) current-menu-item @endif"><a href="{{ route('blog.message') }}">留言板</a></li>
                </ul>
            </div>
        </div>
        <div class="right-nav pull-right hidden-xs hidden-sm">
            @auth
                <a href="javascript:;" class="toggle-login">{{ Auth::user()->nickname }}</a>
                <span class="line"></span>
                <a href="{{ route('logout') }}" class="toggle-login">退出</a>
            @else
                <a href="{{ route('login') }}" class="toggle-login" target="_blank">登录</a>
                <span class="line"></span>
                <a href="{{ route('register') }}" class="toggle-login" target="_blank">注册</a>
            @endauth
        </div>
        <div class="navbar-mobile hidden-md hidden-lg">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
            </button>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="{{ route('blog') }}">首页</a></li>
                    <li><a href="{{ route('blog.categories') }}">分类</a></li>
                    <li><a href="{{ route('blog.tags') }}">标签</a></li>
                    <li><a href="{{ route('blog.topics') }}">专题</a></li>
                    <li><a href="{{ route('blog.links') }}">友情链接</a></li>
                    <li><a href="{{ route('blog.archives') }}">文章归档</a></li>
                    <li><a href="{{ route('blog.message') }}">留言板</a></li>
                </ul>
            </div>
            <div class="body-overlay"></div>
        </div>
    </div>
</div>