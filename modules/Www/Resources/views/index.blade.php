<!doctype html>
<html lang="en">
	<head>
    	<meta charset="UTF-8">
		<title>个人笔记记录 - phpgeeker.com</title>
		<meta name="keywords" content="PHP极客,phpgeeker,个人网站,个人博客,个人商城,个人导航,php博客,php商城,web前端,php后端">
		<meta name="description" content="PHP极客,一个分享自己BUG开发、踩坑经历、掉发指南、熬夜心得的地方,与广大程序员同志共勉。">
		<meta http-equiv="Cache-Control" content="no-siteapp" />
    	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    	<meta name="baidu-site-verification" content="WfpgWLYRyc" />
		<link rel="stylesheet" type="text/css" href="{{ asset('/modules/www/css/app.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ asset('/modules/www/css/style.css') }}">
		<script data-ad-client="ca-pub-7028245214128878" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
	</head>
	<body>
		<div id="app">
			<div class="loader">
				<div class="loader-content">
					<div class="loader-range"></div>
				</div>
			</div>
			<div class="maincontent">
				<div class="fixedbg" style="background-image: url({{ $image['url'] }})">
					<div class="mask-fixedbg"></div>
				</div>
			</div>
			<section class="div_content">
				<ul class="ul-header border-1px">
					<div class="left-menu" id="menu">
						<div class="left-menu-content" id="content">
							<a href="{{ modules_domain('www') }}"><li class="active">WWW</li></a>
							<a href="{{ modules_domain('blog') }}" target="_blank"><li>BLOG</li></a>
							<a href="{{ modules_domain('mall') }}" target="_blank"><li>MALL</li></a>
							<a href="{{ modules_domain('nav') }}" target="_blank"><li>NAV</li></a>
						</div>
					</div>
					<div class="fixed-menu" id="button">
						<i class="icon-menu"></i>
					</div>
					<div class="right-menu">
		                @auth
		                	<img src="{{ Auth::user()->avatar}}" class="avatar">
		                    <a href="javascript:;">{{ Auth::user()->nickname}}</a>
		                    <a href="{{ route('logout') }}">EXIT</a>
		                @else
							<a href="{{ route('login') }}" class="listmenu">LOGIN</a>
							<a href="{{ route('register') }}" class="listmenu">REGISTER</a>
						@endauth
					</div>
				</ul>
				<div class="home li_list">
					<div class="home_center">
						<div class="home_content">
							<h1 class="title"><span class="date">{{ $image['date'] }}</span></h1>
							<p class="disc">{{ $image['disc'] }}</p>
						</div>
						<div class="home_set">
							{{ csrf_field() }}
							<input type="hidden" name="url" value="{{ route('www.image') }}">
							<div title="上一张壁纸" class="set_list" data-idx="1"><i class="icon-left"></i></div>
							<div title="下一张壁纸" class="set_list disabled" data-idx="0"><i class="icon-right"></i></div>
							<div title="Follow me on github" class="github">
								<a href="https://github.com/cuuuuuirz" target="_blank"><i class="icon-github"></i></a>
							</div>
						</div>
						<span class="tips">
							<span>
								Copyright &copy;个人笔记记录
								{{ strtoupper(config('phpgeeker.domain')) }}
								<a href="http://beian.miit.gov.cn" target="_blank">{{ config('phpgeeker.icp') }}</a>
							</span>
						</span>
					</div>
				</div>
			</section>
		</div>
		<script src="{{ asset('/modules/www/js/index.js') }}"></script>

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