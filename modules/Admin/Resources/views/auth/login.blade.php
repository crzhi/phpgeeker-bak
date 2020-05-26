<html>
	<head>
		<meta charset="utf-8">
        <title>个人笔记记录 - phpgeeker.com</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
		<link rel="stylesheet" type="text/css" href="{{ asset('/modules/admin/css/login.css') }}">
	</head>
	<body>
		<div class="login-box">
			<div class="login-logo"><a href="javascript:;"><b>极客后台</b></a></div>
			<div class="login-box-body">
				<p class="login-box-msg">登录</p>
				<form action="{{ route('admin.login.do') }}" method="post" id="form">
					{{ csrf_field() }}
					<div class="form-group has-feedback">
						<input type="input" class="form-control" placeholder="管理员账号" name="username">
					</div>
					<div class="form-group has-feedback">
						<input type="password" class="form-control" placeholder="密码" name="password" autocomplete="off">
					</div>
					<div class="row">
						<div class="col-xs-4 col-md-offset-4">
							<button type="submit" class="btn btn-primary btn-block btn-flat" id="login-btn">登录</button>
						</div>
					</div>
				</form>
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
        </script>
	</body>
</html>