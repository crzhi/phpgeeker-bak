<ul class="layui-nav layui-nav-tree" lay-shrink="all" id="LAY-system-side-menu" lay-filter="layadmin-system-side-menu">
    <li class="layui-nav-item layui-nav-itemed">
        <a href="javascript:;">
            <i class="layui-icon layui-icon-home"></i>
            <cite>主页</cite>
        </a>
        <dl class="layui-nav-child">
            <dd class="layui-this">
                <a href="{{ route('admin.blog') }}">控制台</a>
            </dd>
            <dd class="layui-nav-itemed">
                <a href="javascript:;">主页一</a>
                <dl class="layui-nav-child">
                    <dd  class="layui-this"><a href="javascript:;">等比例列表排列</a></dd>
                    <dd><a href="javascript:;">按移动端排列</a></dd>
                    <dd><a href="javascript:;">移动桌面端组合</a></dd>
                    <dd><a href="javascript:;">全端复杂组合</a></dd>
                    <dd><a href="javascript:;">低于桌面堆叠排列</a></dd>
                    <dd><a href="javascript:;">九宫格</a></dd>
                </dl>
            </dd>
            <dd>
                <a href="javascript:;">主页二</a>
            </dd>
        </dl>
    </li>
</ul>