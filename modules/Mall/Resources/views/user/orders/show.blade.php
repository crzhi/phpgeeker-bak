@extends('mall::layouts.app')

@section('title', '订单详情')

@section('content')
	<div class="layui-container userpublic useradd">
		<div class="layui-row layui-col-space20">
			<p class="layui-hide-xs title">首页 &gt;<span>个人中心</span></p>	
			@include('mall::layouts.lib._userSider')
			<div class="layui-col-md10">
			      <div class="layui-card">
			        <div class="layui-card-header">订单详情</div>
			        <div class="layui-card-body layui-text">
			        	<div class="address-box address-active">
		                	<p class="contact_name"><span class="title">联系人</span>：{{ ($order->address)['contact_name'] }}</p>
		                	<p class="contact_phone"><span class="title">联系电话</span>：{{ ($order->address)['contact_phone'] }}</p>
		                	<p class="address"><span class="title">收货地址</span>：{{ ($order->address)['address'] }}</p>
		                </div>
			        </div>
			      </div>
		    </div>
			<div class="layui-col-sm10">
				<div class="layui-show">
					<table id="house-user-order" lay-filter="house-user-order"></table>
					<div class="layui-form layui-border-box layui-table-view" lay-filter="LAY-table-2" lay-id="house-user-order" style=" ">
						<div class="layui-table-box">
							<div class="layui-table-body">
								<table cellspacing="0" cellpadding="0" border="0" class="layui-table" lay-skin="line">
									<thead>
										<tr>
											<th><div class="layui-table-cell" align="center"><span>订购商品</span></div></th>
											<th><div class="layui-table-cell" align="center"><span>单价</span></div></th>
											<th><div class="layui-table-cell" align="center"><span>件数</span></div></th>
											<th><div class="layui-table-cell" align="center"><span>小计</span></div></th>
										</tr>
									</thead>
									<tbody>
										@foreach($order->items as $index => $item)
											<tr>
												<td align="center">
													<div class="layui-table-cell" style="text-align: center;">
														<a href="{{ route('mall.products.show', [$item->product_id]) }}" target="_blank">
															<img src="{{ $item->productSku->product->image }}">
															<div class="attribute" style="display: inline-block;text-align: left;vertical-align: top;">
																<p class="title">{{ $item->product->title }}</p>
																<p class="attr">{!! $item->productSku->attrValue() !!}</p>
															</div>
														</a>
													</div>
												</td>
												<td align="center"><div class="layui-table-cell">￥{{ $item->price }}</div></td>
												<td align="center"><div class="layui-table-cell">{{ $item->amount }}</div></td>
												<td align="center"><div class="layui-table-cell">￥{{ $item->price * $item->amount }}</div></td>
											</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div style="background-color: #f2f2f2;height: 100px">
					<div style="float: right">
						<p style="margin: 10px 20px;height: 20px;line-height: 20px">商品合计：<span style="float: right">￥{{ $order->total_amount }}</span></p>
						<p style="margin: 10px 20px;height: 20px;line-height: 20px">运费：<span style="float: right">￥0.00</span></p>
						<p style="margin: 10px 20px;height: 20px;line-height: 20px">商品合计：<span style="float: right;color: #cd2d15;font-size: 20px;">￥{{ $order->total_amount }}</span></p>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop