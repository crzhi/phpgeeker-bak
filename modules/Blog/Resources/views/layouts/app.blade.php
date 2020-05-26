<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>个人笔记记录 - phpgeeker.com</title>
        <meta name="keywords" content="{{ $set->keywords }}" />
        <meta name="description" content="{{  $set->description }}" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE;chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, minimal-ui">
        <link rel='stylesheet' type='text/css' href="{{ asset('/modules/blog/css/nicetheme.css') }}" />
        <link rel='stylesheet' type='text/css' href="{{ asset('/modules/blog/css/reset.css') }}" />
        <link rel='stylesheet' type='text/css' href="{{ asset('/modules/blog/css/style.css') }}" />
        <link rel='stylesheet' type='text/css' href="{{ asset('/modules/blog/css/font-style.css') }}" />
        @yield('style')
    </head>
    <body class="home blog off-canvas-nav-left">

    	<!-- header -->
    	@include('blog::layouts.lib._header')
    	<!-- end header -->

    	<!-- content -->
    	@yield('content')
        <div class="clearfix"></div>
    	<!-- end content -->

    	<!-- footer -->
    	@include('blog::layouts.lib._footer')
    	<!-- end footer -->

        <script src="{{ asset('/static/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('/modules/blog/js/suxingme.js') }}"></script>
        <script src="{{ asset('/modules/blog/js/lazyload.min.js') }}"></script>
        <script src="{{ asset('/modules/blog/js/wow.min.js') }}"></script>
        @yield('script')
        <!-- 百度统计 -->
        <script>
            var _hmt = _hmt || [];
            (function() {
                var hm = document.createElement("script");
                hm.src = "https://hm.baidu.com/hm.js?75fe9b0cc7ff38f87a0a2bbd1eb71dfc";
                var s = document.getElementsByTagName("script")[0];
                s.parentNode.insertBefore(hm, s);
            })();
        </script>
    </body>
</html>