<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>个人笔记记录 - phpgeeker.com</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link rel="stylesheet" href="{{ asset('/static/layui/css/layui.css') }}">
        <link rel="stylesheet" href="{{ asset('/modules/mall/css/mall.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('/modules/mall/css/index.css') }}">
        <script type="text/javascript" src="{{ asset('/static/jquery/jquery.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('/static/jquery/jquery.cookie.js') }}"></script>
        <script type="text/javascript" src="{{ asset('/static/jquery/jquery.form.min.js') }}"></script>
        <script type="text/javascript">
            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
            });
        </script>
    </head>
    <body>
        @include('mall::layouts.lib._header')
        @yield('content')
        @include('mall::layouts.lib._footer')
        <script src="{{ asset('/static/layui/layui.all.js') }}"></script>
        <script src="{{ asset('/modules/mall/js/helpers.js') }}"></script>
        <script>
            layui.config({
                base: '/modules/mall/js/'
            }).use('house');
        </script>
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