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
        <link rel="stylesheet" href="{{ asset('/modules/passport/css/login.css') }}" media="all">
    </head>
    <body class="layui-layout-body">
        <div class="layadmin-tabspage-none">
            <div class="layadmin-user-login layadmin-user-display-show">
                <div class="layadmin-user-login-main">
                    <div class="layadmin-user-login-box layadmin-user-login-header">
                        <h2>@yield('sub_title')</h2>
                        <p></p>
                    </div>
                    <div class="layadmin-user-login-box layadmin-user-login-body layui-form">
                        @yield('content')
                    </div>
                    <div class="layui-trans layui-form-item layadmin-user-login-other">
                        <label>社交账号登入</label>
                        <a href="{{ route('login.qq') }}"><i class="layui-icon layui-icon-login-qq"></i></a>
                        <a class="wechat-login"><i class="layui-icon layui-icon-login-wechat"></i></a>
                        <a href="{{ route('login.weibo') }}"><i class="layui-icon layui-icon-login-weibo"></i></a>
                        <a href="{{ route('login.github') }}" class="github-login">
                            <svg class="octicon octicon-mark-github v-align-middle" height="26" viewBox="0 0 16 16" version="1.1" width="26" aria-hidden="true">
                                <path fill-rule="evenodd" d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.013 8.013 0 0 0 16 8c0-4.42-3.58-8-8-8z"></path>
                            </svg>
                        </a>
                        @yield('where')
                    </div>
                </div>
                <div class="layui-trans layadmin-user-login-footer">
                    Copyright ©个人笔记记录
                    PHPGEEKER.COM
                    <a href="http://beian.miit.gov.cn" target="_blank">鲁ICP备19032188号</a>
                </div>
            </div>
        </div>
        <div id="globalPopMessageBg"></div>
        <div class="login_box">
            <div class="box_center">
                <a class="w_login_close icon_c" href="javascript:;"><i class="layui-icon layui-icon-close"></i></a>
                <div class="icon_c row_1 login_nav"></div>
                <div class="row_2 login_main">
                    <div class="login_main_short leftInRight" id="login_short_scan">
                        <div class="short_login">
                            <div class="wx_Qr_box">
                                <img class="wx_Qr_img" src="{{ asset('/modules/passport/images/wx-sys.gif') }}" />
                                <p><i class="layui-icon layui-icon-login-wechat"></i>微信扫码登录</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="{{ asset('/static/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('/static/jquery/jquery.form.min.js') }}"></script>
        <script src="{{ asset('/static/layer/layer.js') }}"></script>
        <script type="text/javascript">
            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
            });

            $('#form').ajaxForm(function(data) {
                layer.msg(data.message, {icon:data.code});
                if(data.url) {
                    setTimeout(function(){ 
                        window.location.href = data.url;
                    }, 1500);
                }
            });

            let timer = null;
            $(document).on('click', '.wechat-login', function () {
                // layer.msg('功能测试中，请耐心等待。')
                $('#globalPopMessageBg').show();
                $('.login_box').show();
                $.post("{{ route('login.wechat.qrcode') }}", function(data){
                    // console.log(data)
                    $('.wx_Qr_img').attr('src', data.url);
                    timer = setInterval(() => {
                        // 请求参数是二维码中的场景值
                        $.post("{{ route('login.wechat.check') }}", {wechat_flag: data.qrcodeFlag}, function(param){
                            // console.log(param)
                            if(param.status) {
                                clearInterval(timer);
                                setTimeout(function(){ 
                                    window.location.href = "{{ route('www') }}";
                                }, 1500);
                            }
                        });
                    }, 2000);
                });

            });

             $(document).on('click', '.w_login_close', function () {
                $('#globalPopMessageBg').hide();
                $('.login_box').hide();
                clearInterval(timer);
             })
        </script>
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