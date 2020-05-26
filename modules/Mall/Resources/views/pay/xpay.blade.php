@extends('mall::layouts.app')
@section('title', '收银台')

@section('content')
<style>.house-banner {display: none}</style>
<link rel="stylesheet" type="text/css" href="/modules/mall/css/pay.css">
<div class="layui-fluid" id="component-tabs" style="margin-top: 10px">
    <div class="layui-row">
	  	<div class="layui-col-md2" style="height: 10px"></div>
	    <div class="layui-col-md8">
	        <div class="layui-card">
	        	<div class="layui-card-header">收银台</div>
		        <div class="layui-card-body">
		            <div class="layui-tab layui-tab-brief" lay-filter="component-tabs-brief">
			            <ul class="layui-tab-title">
							<li class="layui-this"><img src="/modules/mall/images/aliPay.png" style="width: 100px;"></li>
							<!-- <li><img src="/modules/mall/images/wechatPay.png" style="width: 100px;"></li> -->
			            </ul>
			            <div class="layui-tab-content" style="height: 500px;">
							<div class="layui-tab-item layui-show" >
								<div class="cashier-center-view view-qrcode">
									<div class="qrcode-integration qrcode-area">
										<div class="qrcode-header">
											<div class="ft-center">扫一扫付款（元）</div>
											<div class="ft-center qrcode-header-money">{{ $order->total_amount }}</div>
										</div>
										<div class="qrcode-img-wrapper">
											<div class="qrcode-img-area">
												<div class="qrcode-box">
													{!! QrCode::encoding('UTF-8')->size(168)->margin(0)->generate($url); !!}
												</div>
											</div>
											<div class="qrcode-img-explain fn-clear" >
												<img class="fn-left-img" src="https://t.alipayobjects.com/images/T1bdtfXfdiXXXXXXXX.png" alt="扫一扫标识" seed="qrcodeImgExplain-tImagesT1bdtfXfdiXXXXXXXX">
												<div class="open-tips">打开手机支付宝<br>扫一扫继续付款</div>
											</div>
										</div>
										<div class="qrcode-foot block">
											<div class="qrcode-explain block">
												<a href="https://mobile.alipay.com/index.htm" class="qrcode-downloadApp" data-boxurl="https://cmspromo.alipay.com/down/new.htm" target="_blank" seed="NewQr_qr-pay-download">首次使用请下载手机支付宝</a>
											</div>
										</div>						
									</div>
									<div class="qrguide-area" id="J_qrguideArea" seed="NewQr_animationClick">
										<img src="https://t.alipayobjects.com/images/rmsweb/T13CpgXf8mXXXXXXXX.png" class="qrguide-area-img background" seed="J_qrguideArea-qrguideAreaImg">
										<img src="https://t.alipayobjects.com/images/rmsweb/T1ASFgXdtnXXXXXXXX.png" class="qrguide-area-img active block" seed="J_qrguideArea-qrguideAreaImgT1">
									</div>
								</div>
							</div>
							<!-- <div class="layui-tab-item"></div> -->
			            </div>
		            </div>
		        </div>
	        </div>
		</div>
    </div>
</div>
@endsection