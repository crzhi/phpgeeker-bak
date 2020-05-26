<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>个人笔记记录 - phpgeeker.com</title>
        <meta name="renderer" content="webkit">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
        <link rel="stylesheet" href="{{ asset('/static/layui/css/layui.css') }}" media="all">
        <link id="layuicss-layer" rel="stylesheet" href="{{ asset('/static/layui/css/modules/layer/default/layer.css') }}" media="all">
        <link id="layuicss-layuiAdmin" rel="stylesheet" href="{{ asset('/modules/admin/css/admin.css') }}" media="all">
        @yield('style')
        <script src="{{ asset('/static/jquery/jquery.min.js') }}"></script>
    </head>
    <body layadmin-themealias="default" class="layui-layout-body">
        <div id="LAY_app" class="layadmin-tabspage-none">
            <div class="layui-layout layui-layout-admin">

                <!-- 头部区域 -->
                <div class="layui-header">
                    <a href="{{ route('admin') }}" class="layui-logo">
                        <span>极客后台</span>
                    </a>
                    @include('admin::layouts.lib._header')
                </div>
                <!--结束 头部区域 -->

                <!-- 侧边菜单 -->
                <div class="layui-side layui-side-menu">
                    <div class="layui-side-scroll">
                        @yield('left')
                    </div>
                </div>                
                <!--结束 侧边菜单 -->

                <!-- 主体内容 -->
                <div class="layui-body" id="LAY_app_body">
                    <div class="layadmin-tabsbody-item layui-show">
                        <div class="layui-card layadmin-header">
                            <div class="layui-breadcrumb">
                                <a href="{{ route('admin') }}">后台</a><span lay-separator="">/</span>
                                @yield('nav')
                            </div>
                        </div>
                        <div class="layui-fluid">
                            @yield('content')
                        </div>
                    </div>
                </div>
                <!--结束 主体内容 -->
            </div>
        </div>
        <script src="{{ asset('/static/jquery/jquery.form.min.js') }}"></script>
        <script src="{{ asset('/static/layui/layui.all.js') }}"></script>
        <script src="{{ asset('/static/jquery/jquery.helpers.js') }}"></script>
        <script  type="text/javascript">
            // 加载 controller 目录下的对应模块
            // 小贴士：
            // 这里 console 模块对应 的 console.js 并不会重复加载，
            // 然而该页面的视图则是重新插入到容器，那如何保证能重新来控制视图？有两种方式：
            // 1): 借助 layui.factory 方法获取 console 模块的工厂（回调函数）给 layui.use
            // 2): 直接在 layui.use 方法的回调中书写业务代码，即:
            // layui.use('console', function(){ 
            //     //同 console.js 中的 layui.define 回调中的代码 
            // });
            // 这里我们采用的是方式1。其它很多视图中采用的其实都是方式2，因为更简单些，也减少了一个请求数。
            // layui.use('console', layui.factory('console'));
        </script>
        <script  type="text/javascript">
            layui.config({base: "{{asset('/modules/admin/js/') }}/"}).use('index',function() {
                // var layer = layui.layer,
                // admin = layui.admin;
                // layer.ready(function() {
                //     admin.popup({
                //         type: 1,
                //         title: '标题',
                //         content: '单页面专业版默认未开启“多标签”功能，实际运用时，你可以自定义是否开启',
                //         area: '300px',
                //         btnAlign: 'c',
                //         shade: false,
                //     });
                // });
            });
        </script> 
        <script  type="text/javascript">
            $(document).ready(function() {
                $.ajaxSetup({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                });
                $('#AdminForm').ajaxForm(function(data) {
                    toast(data);
                }); 
            });
        </script>
        @yield('script')       
    </body>
</html>