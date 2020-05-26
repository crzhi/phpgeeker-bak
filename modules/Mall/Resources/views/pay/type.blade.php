@extends('mall::layouts.app')
@section('title', '收银台')

@section('content')	
	<div class="layui-container">
	    <div class="layui-row">
			<div class="layui-col-md12" style="height: 300px">
		      <div class="layui-card">
		        <div class="layui-card-header">选择付款方式</div>
		        <div class="layui-card-body">
		          <div class="layuiadmin-card-link" style="margin: 10px 20px">
		            <a href="javascript:;" style="margin: 0 20px">
		            	<div class="layui-unselect layui-form-radio layui-form-radioed"  data-url="{{ route('mall.pay.alipay', ['order' => $order->id]) }}">
		            		<i class="layui-anim layui-icon"></i>
		            		<img src="/modules/mall/images/alipay.png" width="200px">
		            	</div>
		            </a>
		            <a href="javascript:;" style="margin: 0 20px">
		            	<div class="layui-unselect layui-form-radio layui-radio-disbaled layui-disabled">
		            		<i class="layui-anim layui-icon"></i>
		            		<img src="/modules/mall/images/wechatPay.png" width="200px">
		            	</div>
		            </a>
		          </div>
		          <button class="layui-btn layui-pay-type-btn" data-order="http://mall.demo.test/orders/orders" data-pay="http://mall.demo.test/pay/type">支付</button>       
		        </div>
		      </div>
		    </div>
		</div>
	</div>
@endsection
@section('script')
	<script type="text/javascript">
		$('.layui-pay-type-btn').on('click', function(){
			var url = $('.layui-form-radioed').data('url');
			window.location.href = url;
		})
	</script>
@stop