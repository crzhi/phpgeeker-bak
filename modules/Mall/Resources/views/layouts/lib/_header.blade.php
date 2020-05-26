<div class="house-header">
    <div class="layui-container">
        <div class="house-nav">
            <span class="layui-breadcrumb" lay-separator="|">
                @auth
                    <a href="{{ route('mall.user') }}">{{Auth::user()->email}}</a>
                    <a href="{{ route('mall.user.orders') }}">我的订单</a>
                    <a href="{{ route('logout') }}" target="_blank">退出</a>
                @else
                    <a href="{{ route('login') }}" target="_blank">登录</a>
                    <a href="{{ route('register') }}" target="_blank">注册</a>
                @endif
            </span>
            <span class="layui-breadcrumb house-breadcrumb-icon" lay-separator=" ">
                <a id="search"><i class="layui-icon layui-icon-search"></i></a>
                <a href="{{ route('mall.user') }}"><i class="layui-icon layui-icon-username"></i></a>
                <a href="{{ route('mall.cart') }}"><i class="layui-icon layui-icon-cart"></i></a>
            </span>
        </div>
        <div class="house-banner layui-form">
            <a class="banner" href="/"><img src="/modules/mall/images/logo.png" alt="家居商城"></a>
            <div class="layui-input-inline">
                <input type="text" name="search" placeholder="搜索好物" class="layui-input search-input" data-url="{{ route('mall.products.index') }}">
                <i class="layui-icon layui-icon-search"></i>
            </div>
            <a class="shop" href="{{ route('mall.cart') }}">
                <i class="layui-icon layui-icon-cart"></i>
               <span class="layui-badge">{{ $cartBadge }}</span>
            </a>
        </div>
    </div>
</div>
