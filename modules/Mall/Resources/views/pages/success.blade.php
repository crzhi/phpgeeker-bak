@extends('mall::layouts.app')
@section('title', '成功')

@section('content')
<div class="layui-fluid layui-container house-list">
	<div class="layui-row layui-col-space15">
		<div class="layui-col-sm2"></div>
		<div class="layui-col-sm8">
			<div class="layui-card">
				<div class="layui-card-header">成功</div>
				<div class="layui-card-body">
					<div class="layui-row">
						<div class="layui-col-sm12" align="center">
							<div class="layui-carousel" style="width: 100%; height: 280px;line-height: 150px;font-size: 22px">
								<span>{{ $msg }}</span>
								<a href="{{ route('mall') }}" style="display: block">
									<button class="layui-btn layui-btn-primary">返回首页</button>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
