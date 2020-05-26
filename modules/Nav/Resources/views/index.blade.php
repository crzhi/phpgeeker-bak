<!DOCTYPE html>
<html lang="zh">
    <head>
        <meta charset="UTF-8">
        <title>个人笔记记录 - phpgeeker.com</title>
        <meta name="keywords" content="导航,PHP极客,phpgeeker,个人网站,个人博客,个人商城,个人导航,php博客,php商城,web前端,php后端" />
        <meta name="description" content="一个分享自己BUG开发、踩坑经历、掉发指南、熬夜心得的地方,与广大程序员同志共勉。" />
        <meta name="referrer" content="no-referrer"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, minimal-ui">
        <link rel="stylesheet" href="{{ asset('/static/font-awesome/css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('/static/bootstrap/css/bootstrap.css') }}">
        <link rel="stylesheet" href="{{ asset('/modules/nav/css/xenon-core.css') }}">
        <link rel="stylesheet" href="{{ asset('/modules/nav/css/nav.css') }}">
        <script type="text/javascript" src="{{ asset('/static/jquery/jquery.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('/static/jquery/jquery.lazyload.min.js') }}"></script>
    </head>
    <body class="page-body">
        <!-- skin-white -->
        <div class="page-container">
            <div class="sidebar-menu toggle-others fixed">
                <div class="sidebar-menu-inner ps-container ps-active-y">
                    <header class="logo-env">
                        <!-- logo -->
                        <div class="logo">
                            <a href="/" class="logo-expanded"><img src="{{ asset('/modules/nav/images/logo.png') }}" width="150px" alt="logo" /></a>
                        </div>
                        <div class="mobile-menu-toggle visible-xs">
                            <a href="javascript:;" data-toggle="mobile-menu-toggle"><i class="fa-bars"></i></a>
                        </div>
                    </header>
                    <ul id="main-menu" class="main-menu">
                        @if(count($FirstCategories))
                            @foreach($FirstCategories as $FirstCategory)
                                @if(count($FirstCategory->lower) == 0)
                                    <li>
                                        <a href="#{{ $FirstCategory->title }}" class="smooth">
                                            <i class="fa {{ $FirstCategory->icon }}"></i>
                                            <span class="title">{{ $FirstCategory->title }}</span>
                                        </a>
                                    </li>
                                @else
                                    <li>
                                        <a>
                                            <i class="fa {{ $FirstCategory->icon }}"></i>
                                            <span class="title">{{ $FirstCategory->title }}</span>
                                        </a>
                                        <ul>
                                            @foreach($FirstCategory->lower as $SecondCategory)
                                                <li>
                                                    <a href="#{{ $SecondCategory->title }}" class="smooth">
                                                       <i class="fa {{ $SecondCategory->icon }}"></i>
                                                       <span class="title">{{ $SecondCategory->title }}</span>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @endif
                            @endforeach
                        @endif
                        <li class="submit-tag">
                            <a href="#关于本站" class="smooth">
                                <i class="fa fa-heart-o i-right"></i>
                                <span class="title">关于本站</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="main-content td-linl-items"  >
                <nav class="navbar user-info-navbar" role="navigation"  style="min-height: 74px;"></nav>
                @if(count($FirstCategories))
                    @foreach($FirstCategories as $FirstCategory)
                        @if(count($FirstCategory->lower) == 0)
                            <!-- {{ $FirstCategory->title }} -->
                            <h4 class="text-gray">
                                <i class="fa {{ $FirstCategory->icon }} i-right" id="{{ $FirstCategory->title }}"></i>
                                {{ $FirstCategory->title }}
                                <i class="fa fa-caret-down i-left"></i>
                            </h4>
                            <div class="row">
                                @foreach($FirstCategory->link as $link)
                                    <div class="col-sm-3 col-xs-3 col-td-square pl-5 pr-5">
                                        <div class="xe-widget xe-conversations box2 label-info" onclick="window.open('{{ $link->url }}', '_blank')" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="{{ $link->url }}">
                                            <div class="xe-user-img">
                                                <div class="xe-comment-entry">
                                                    <a>
                                                        <img data-original="{{ asset($link->favicon) }}" class="img-circle lazy" width="50">
                                                    </a>
                                                    <div class="xe-comment">
                                                        <strong>{{ $link->title }}</strong>
                                                        <p class="overflowClip_2">{{ $link->description }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <br/>
                            <!-- END {{ $FirstCategory->title }} -->
                        @else
                            @foreach($FirstCategory->lower as $SecondCategory)
                                <!-- {{ $SecondCategory->title }} -->
                                <h4 class="text-gray">
                                    <i class="fa {{ $SecondCategory->icon }} i-right" id="{{ $SecondCategory->title }}"></i>
                                    {{ $SecondCategory->title }}
                                    <i class="fa fa-caret-down i-left"></i>
                                </h4>
                                <div class="row">
                                    @foreach($SecondCategory->link as $link)
                                        <div class="col-sm-3 col-xs-3 col-td-square pl-5 pr-5">
                                            <div class="xe-widget xe-conversations box2 label-info" onclick="window.open('{{ $link->url }}', '_blank')" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="{{ $link->url }}">
                                                <div class="xe-user-img">
                                                    <div class="xe-comment-entry">
                                                        <a>
                                                            <img data-original="{{ asset($link->favicon) }}" class="img-circle lazy" width="50">
                                                        </a>
                                                        <div class="xe-comment">
                                                            <strong>{{ $link->title }}</strong>
                                                            <p class="overflowClip_2">{{ $link->description }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <br>
                                <!-- END {{ $SecondCategory->title }} -->
                            @endforeach
                        @endif
                    @endforeach
                @endif
                <h4 class="text-gray"><i class="fa fa-heart-o i-right" id="关于本站"></i>关于本站</h4>
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="xe-widget xe-conversations box2 label-info" onclick="window.open('{{ modules_domain() }}', '_self')" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="">
                                        <div class="xe-comment-entry">
                                            <a class="xe-user-img">
                                                <img src="https://www.phpgeeker.com/favicon.ico" class="img-circle" width="50">
                                            </a>
                                            <div class="xe-comment">
                                                <a class="xe-user-name overflowClip_1" target="_blank">
                                                    <strong>PHP Geeker</strong>
                                                </a>
                                                <p class="overflowClip_2">一个分享自己BUG开发、踩坑经历、掉发指南、熬夜心得的地方,与广大程序员同志共勉。</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br/>
                <!-- footer -->
                <footer class="main-footer sticky footer-type-1">
                    <div class="footer-inner">
                        <div class="footer-text">
                Copyright ©个人笔记记录
                PHPGEEKER.COM
                <a href="http://beian.miit.gov.cn" target="_blank" style="color: #333;">鲁ICP备19032188号</a>
                        </div>
                        <div class="fix-top">
                            <a href="#" id="go-top"  class="go-up unvisible fl-row-center">
                                <i class="fa fa-arrow-up" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                </footer>
                <!-- end footer -->
            </div>
        </div>
        <script type="text/javascript" src="{{ asset('/static/bootstrap/js/bootstrap.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('/static/jquery/tweenmax.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('/static/jquery/resizeable.js') }}"></script>
        <script type="text/javascript" src="{{ asset('/modules/nav/js/joinable.js') }}"></script>
        <script type="text/javascript" src="{{ asset('/modules/nav/js/xenon-custom.js') }}"></script>
        <script type="text/javascript" src="{{ asset('/modules/nav/js/nav.js') }}"></script>
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